<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatGroup;
use App\Models\Formatter;
use App\Models\ParticipantChat;
use App\Models\Setting;
use App\Models\SingleImage;
use App\Models\SocialToken;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use NextApps\VerificationCode\VerificationCode;

class AuthController extends Controller
{

    private $plainToken;

    public function __construct()
    {
        $this->plainToken = env('PLAIN_TOKEN', 'infinity_pham_son');
    }

    public function get(Request $request)
    {
        return response()->json(auth()->user());
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email:rfc,dns|required',
            'password' => 'required',
            'code' => 'required',
        ]);

        $user = User::where([
            'phone' => $request->phone,
            'email' => $request->email,
        ])->first();

        if (!empty($user)) {
            return response()->json([
                'code' => 400,
                'message' => "Email or Phone has used",
            ], 400);
        }

        $isLocal = env('APP_ENV') == "local";
        if (($isLocal && $request->code == "111111")) {
            goto skipOtp;
        }

        if (!(VerificationCode::verify($request->code, $request->email, false) || VerificationCode::verify(strtoupper($request->code), $request->email, false))) {
            return response()->json([
                'code' => 400,
                'message' => "Wrong code",
            ], 400);
        }

        skipOtp:

        $user = User::updateOrCreate([
            'phone' => $request->phone,
            'email' => $request->email,
        ], [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Formatter::hash($request->password),
        ]);

        if ($request->hasFile('front_id_image_path')) {
            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $user->id);
            $user->front_id_image_path = $dataUploadFeatureImage['file_path'];
        }

        if ($request->hasFile('back_id_image_path')) {
            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $user->id);
            $user->back_id_image_path = $dataUploadFeatureImage['file_path'];
        }

        if ($request->hasFile('portrait_image_path')) {
            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $user->id);
            $user->portrait_image_path = $dataUploadFeatureImage['file_path'];
        }

        $user->save();
        $user->refresh();

        $token = $user->createToken($this->plainToken)->plainTextToken;

        if (empty($user->referral_id)) {
            $userRefer = User::find($request->referral_id);

            if (!empty($userRefer)) {
                $setting =  Setting::first();

                $number_point_refer_success = $setting->number_point_refer_success ?? 0;
                $number_point_taken_refer_success = $setting->number_point_taken_refer_success ?? 0;

                if (!empty($number_point_refer_success)) {
                    $userRefer->addPoint($number_point_refer_success, "Giới thiệu thành công: " . $user->name . " #" . $user->id);
                }

                if (!empty($number_point_taken_refer_success)) {
                    $user->addPoint($number_point_refer_success, "Nhập mã giới thiệu thành công: " . $userRefer->name . " #" . $userRefer->id);
                }

                $user->referral_id = $userRefer->id;
                $user->level_number = $userRefer->level_number + 1;
                $user->save();
            }
        }

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        $chatGoup = ChatGroup::create([
            'title' => 'First chat'
        ]);

        ParticipantChat::create(
            [
                'user_id' => $user->id,
                'chat_group_id' => $chatGoup->id,
            ]
        );

        ParticipantChat::create(
            [
                'user_id' => 1,
                'chat_group_id' => $chatGoup->id,
            ]
        );

        Chat::create([
            'content' => 'Chào mừng đến với ' . env('APP_NAME') . '!',
            'user_id' => 1,
            'chat_group_id' => $chatGoup->id,
        ]);

        return response($response);
    }

    public function signIn(Request $request)
    {
        if (!empty($request->provider_token)){
            $user = User::where('provider_token', $request->provider_token)->first();

            if (empty($user)){

                $socialToken = SocialToken::where('token', $request->provider_token)->first();

                if (empty($socialToken)){
                    return response([
                        'message' => "Token không hợp lệ",
                        'code' => 400,
                    ], 400);
                }

                $user = User::create([
                    'name' => $socialToken->name,
                    'email' => $socialToken->email,
                    'password' => $socialToken->token,
                ]);

                $user->refresh();
            }
            goto skipPassword;
        }else{
            $request->validate([
                'user_name' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->user_name)->orWhere('phone', $request->user_name)->first();

        }

        if (empty($user)) {
            return response([
                'message' => "Tài khoản chưa được tạo",
                'code' => 400,
            ], 400);
        }

        if (env('APP_ENV') == "local" && $request->password == "1111") {
            goto skipPassword;
        }

        if (!Hash::check($request->password, $user->password)) {
            return response([
                'message' => "Mật khẩu không đúng",
                'code' => 400,
            ], 400);
        }

        skipPassword:

        if ($user->user_status_id == 2) {
            return response()->json(['error' => 'Tài khoản của bạn đã bị khóa'], 405);
        }

        if (optional(Setting::first())->is_login_only_one_device) {
            $user->logoutAllDevices();
        }

        $token = $user->createToken($this->plainToken)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'success',
            'code' => 200,
        ]);
    }

    public function checkExist(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
        ]);

        if (!empty(User::where('phone', $request->phone)->first())) {
            return response()->json([
                'message' => $request->phone . " is exist",
                'code' => 400,
            ], 400);
        }

        if (!empty(User::where('email', $request->email)->first())) {
            return response()->json([
                'message' => $request->email . " is exist",
                'code' => 400,
            ], 400);
        }

        return response()->json([
            'message' => "You can use this email and phone",
            'code' => 200,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'code' => 'required',
            'password' => 'required',
        ]);

        $user = User::where(['email'=> $request->user_name])->orWhere('phone', $request->phone)->first();

        if (empty($user)) {
            return response()->json([
                'message' => "user_name is not exist",
                'code' => 400,
            ], 400);
        }


        $isLocal = env('APP_ENV') == "local";

        if (($isLocal && $request->code == "111111")) {
            goto skipOtp;
        }

        if (!(VerificationCode::verify($request->code, $request->user_name, true))) {
            return response()->json([
                'code' => 400,
                'message' => "Wrong code",
            ], 400);
        }

        skipOtp:

        $user->update([
            'password' => Formatter::hash($request->password)
        ]);

        $user->refresh();

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'date_of_birth' => 'nullable|date_format:Y-m-d',
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ]);
        $user = auth()->user();

        $dataUpdate = [];

        if (!empty($request->name)) {
            $dataUpdate['name'] = $request->name;
        }

        if (!empty($request->date_of_birth)) {
            $dataUpdate['date_of_birth'] = $request->date_of_birth;
        }

        if (!empty($request->address)) {
            $dataUpdate['address'] = $request->address;
        }

        if (!empty($request->password)) {
            $dataUpdate['password'] = Formatter::hash($request->password);
        }

        $user->update($dataUpdate);

        if ($request->hasFile('image')) {
            $item = SingleImage::firstOrCreate([
                'relate_id' => auth()->id(),
                'table' => auth()->user()->getTableName(),
            ], [
                'relate_id' => auth()->id(),
                'table' => auth()->user()->getTableName(),
                'image_path' => 'waiting_update',
                'image_name' => 'waiting_update',
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, 'image', 'single', $item->id);

            $item->update([
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ]);
            $item->refresh();
        }

        if (!empty($request->referral_id) && $user->referral_id == 0) {
            $userRefer = User::where('id', $request->referral_id)->orWhere('phone', $request->referral_id)->first();

            if (!empty($userRefer)) {
                $referral_id = $userRefer->id;
                $user->update([
                    'referral_id' => $referral_id,
                    'level_number' => $userRefer->level_number,
                ]);

                $setting =  Setting::first();

                $number_point_refer_success = $setting->number_point_refer_success ?? 0;
                $number_point_taken_refer_success = $setting->number_point_taken_refer_success ?? 0;

                if (!empty($number_point_refer_success)) {
                    $userRefer->addPoint($number_point_refer_success, "Giới thiệu thành công: " . auth()->user()->name . " #" . auth()->id());
                }

                if (!empty($number_point_taken_refer_success)) {
                    auth()->user()->addPoint($number_point_refer_success, "Nhập mã giới thiệu thành công: " . $userRefer->name . " #" . $userRefer->id);
                }
            }
        }

        $user->refresh();

        return auth()->user();
    }

    public function delete(Request $request)
    {
        auth()->user()->forcedelete();
        return response()->json([
            'message' => 'deleted!',
            'code' => 200,
        ]);
    }

    public function requestOtpEmail(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns|required',
        ]);

        VerificationCode::send($request->email);
        return response()->json([
            'code' => 200,
            'message' => "Your code is sent",
        ]);
    }

    public function checkCodeOtpEmail(Request $request)
    {
        $request->validate([
            'email' => 'email:rfc,dns|required',
            'code' => 'required',
        ]);

        $isLocal = env('APP_ENV') == "local";

        if (($isLocal && $request->code == "111111") || VerificationCode::verify($request->code, $request->email, false) || VerificationCode::verify(strtoupper($request->code), $request->email, false)) {
            return response()->json([
                'code' => 200,
                'message' => "your code is accept",
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => "Wrong code",
            ], 400);
        }
    }
}
