<?php

namespace App\Models;

use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use App\Traits\UserTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements MustVerifyEmail, Auditable
{
    use \OwenIt\Auditing\Auditable;
    use UserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \Awobaz\Compoships\Compoships;
    use DeleteModelTrait;
    use StorageImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // begin

    public function parent(){
        return $this->hasOne(User::class, 'id', 'referral_id');
    }

    public function renderChildrenTreeView($parent_id, $old_html = "", $first = false, $end = false, $is_parent = false)
    {


        $item = User::find($parent_id);

        if ($is_parent) {
            $old_html .= '<div class="tf-tree"><ul>';
        }

        $children = User::where('referral_id', $parent_id)->get();

        if ($first) {
            $old_html .= '<ul><li>';
        } else {
            $old_html .= '<li>';
        }


        $old_html .= '<a href="'.route('administrator.affiliates.index', ['user_id' => $item->id]).'" title="F '.$item->level_number.'" style="color:black;" class="tf-nc">'.$item->name. '</a>';


        foreach ($children as $index => $child) {
            $old_html .= $this->renderChildrenTreeView($child->id, "", $index == 0, count($children) - 1 == $index);
        }
        if ($end) {
            $old_html .= '</li></ul>';
        } else {
            $old_html .= '</li>';
        }

        if ($is_parent) {
            $old_html .= '</ul></div>';
        }

        return $old_html;
    }

    public function logoutAllDevices()
    {
        DB::table('sessions')->where('user_id', $this->id)->delete();
        $this->tokens()->delete();
    }

    public function textTimeOnline()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return "Online";
        }

        return $this->last_seen;
    }

    public function textStatusOnline()
    {
        if (Cache::has('user-is-online-' . $this->id)) {
            return "Online";
        }

        return "Offline";
    }

    public static function htmlStatus($input)
    {
        if ($input == "Đang giữ chỗ") {
            return "<span style=\"display: flex;align-items: center;background-color: #fffcf9;padding: 5px;border-radius: 15px;color: #ffc500;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        } else if ($input == "Thành công") {
            return "<span style=\"display: flex;align-items: center;background-color: #d0ffef;padding: 5px;border-radius: 15px;color: #03a900;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        } else {
            return "<span style=\"display: flex;align-items: center;background-color: #ffdbdb;padding: 5px;border-radius: 15px;color: #ff0000;\"><a class='ms-1 me-1'>{$input}</a><i class=\"fa-solid fa-rotate\"></i></span>";
        }
    }

    public function exchangePointToAmount($point)
    {

        $point = Formatter::getOnlyNumber($point);

        $item = Setting::first();

        $pointSetting = $item->point;
        $amountSetting = $item->amount;

        $exchanged = round(($point / $pointSetting) * $amountSetting);

        $this->addPoint(-$point, "Đổi " . $point . " điểm thành " . $exchanged . " vnđ");

        $this->addAmount($exchanged, "Đổi " . $point . " điểm thành " . $exchanged . " vnđ");
    }

    public function addPoint($point, $description)
    {
        $point = Formatter::getOnlyNumber($point);

        UserPoint::create([
            'user_id' => $this->id,
            'point' => $point,
            'description' => $description,
        ]);

        $this->increment('point', $point);
    }

    public function addAmount($amount, $description)
    {

        $amount = Formatter::getOnlyNumber($amount);
        $amountNow = $this->amount + ($amount);

        UserTransaction::create([
            'user_id' => $this->id,
            'amount' => $amount,
            'description' => $description,
            'amount_now' => $amountNow,
        ]);

        $this->increment('amount', $amount);
    }

    // số lượng người giới thiệu
    public function numberInvited()
    {
        return User::where('referral_id', $this->id)->count();
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referral_id', 'id');
    }

    public function referralIDs()
    {
        return User::where('referral_id', $this->id)->pluck('id');
    }

    public function status()
    {
        return $this->hasOne(UserStatus::class, 'id', 'user_status_id');
    }

    public function userType()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }

    public function membership()
    {

        $from = Carbon::parse($this->created_at)->toDateString();
        $to = Carbon::parse($this->created_at)->addYear()->toDateString();

        $numberTicketSuccess = 0;

        $memberships = Membership::orderBy('require_number_ticket', 'DESC')->get();

        foreach ($memberships as $membership) {
            if ($numberTicketSuccess >= $membership->require_number_ticket) {
                return $membership;
            }
        }

        return [
            "id" => 0,
            "name" => "Chưa có",
            "require_number_ticket" => 0,
            "created_at" => "2023-08-04T08:20:22.000000Z",
            "updated_at" => "2023-10-21T02:52:55.000000Z",
            "image_path_avatar" => "/assets/multiple/1/36/100x100/LOTcD7WmeqBiYMG0Tbtx.png",
            "path_images" => [
                [
                    "id" => 36,
                    "uuid" => "75b1309d-d783-492f-b970-075ce49a3faf",
                    "image_path" => "/assets/multiple/1/36/original/LOTcD7WmeqBiYMG0Tbtx.png",
                    "image_name" => "rank-dong-doan.png",
                    "table" => "memberships",
                    "relate_id" => 1,
                    "index" => 0,
                    "status_image_id" => 0,
                    "created_at" => "2023-08-04T08:28:33.000000Z",
                    "updated_at" => "2023-08-04T08:28:34.000000Z"
                ]
            ]
        ];
    }

    public function city()
    {
        return $this->belongsTo(RegisterCity::class);
    }

    public function district()
    {
        return $this->belongsTo(RegisterDistrict::class);
    }

    public function ward()
    {
        return $this->belongsTo(RegisterWard::class);
    }

    public function bankDefault()
    {
        return UserBank::where(['user_id' => $this->id, 'is_default' => 1])->first();
    }

    // end

    public function getTableName()
    {
        return Helper::getTableName($this);
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['image_path_avatar'] = $this->avatar();
        $array['path_images'] = $this->images;
        $array['user_type'] = $this->userType;
        $array['status'] = $this->status;
        $array['membership'] = $this->membership();
        $array['city'] = $this->city;
        $array['district'] = $this->district;
        $array['ward'] = $this->ward;
        $array['text_status_online'] = $this->textStatusOnline();
        $array['bank_default'] = $this->bankDefault();

        return $array;
    }

    public function avatar($size = "100x100")
    {
        $image = $this->image;
        if (!empty($image)) {
            return Formatter::getThumbnailImage($image->image_path, $size);
        }

        return config('_my_config.default_avatar') ?? $this->front_id_image_path;
    }

    public function image()
    {
        return $this->hasOne(SingleImage::class, 'relate_id', 'id')->where('table', $this->getTable());
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'relate_id', 'id')->where('table', $this->getTable())->orderBy('index');
    }

    public function gender()
    {
        return $this->belongsTo(GenderUser::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function checkPermissionAccess($permissionCheck)
    {
        if (optional(auth()->user())->is_admin == 2) {
            return true;
        }

        $roles = optional(auth()->user())->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }

    public function isAdmin()
    {
        return auth()->check() && optional(auth()->user())->is_admin == 2;
    }

    public function isEmployee()
    {
        return auth()->check() && optional(auth()->user())->is_admin != 0;
    }

    public function searchByQuery($request, $queries = [], $randomRecord = null, $makeHiddens = null, $isCustom = false)
    {
        return Helper::searchByQuery($this, $request, $queries, $randomRecord, $makeHiddens, $isCustom);
    }

    public function storeByQuery(Request $request)
    {
        if (!empty($request->email)) {
            if (!empty(User::where('email', $request->email)->first())) {
                return back();
            }
        }

        if (!empty($request->phone)) {
            if (!empty(User::where('phone', $request->phone)->first())) {
                return back();
            }
        }

        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_type_id' => $request->user_type_id ?? 1,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id ?? 1,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ];

        if ($this->isAdmin()) {
            $dataInsert['role_id'] = $request->role_id ?? 0;
            $dataInsert['is_admin'] = $request->is_admin ?? 0;
        }

        $user = Helper::storeByQuery($this, $request, $dataInsert);

        if (!empty($request->is_admin && $request->is_admin == 1 && isset($request->role_ids))) {
            $user->roles()->attach($request->role_ids);
        }

        if (isset($request->front_id_image_path)) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('front_id_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'front_id_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }

        if (isset($request->back_id_image_path)) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('back_id_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'back_id_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }


        if (isset($request->back_id_image_path)) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('portrait_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'portrait_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }

        return $this->findById($user->id);
    }

    public function updateByQuery(Request $request, $id)
    {
        $dataUpdate = [
            'name' => $request->name,
        ];

        if (!empty($request->date_of_birth)) {
            $dataUpdate['date_of_birth'] = $request->date_of_birth;
        }

        if (!empty($request->email)) {
            if (empty(User::where('email', $request->email)->first())) {
                $dataUpdate['email'] = $request->email;
            }
        }

        if (!empty($request->phone)) {
            if (empty(User::where('phone', $request->phone)->first())) {
                $dataUpdate['phone'] = $request->phone;
            }
        }

        if (!empty($request->gender_id)) {
            $dataUpdate['gender_id'] = $request->gender_id;
        }

        if (!empty($request->password)) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $user = Helper::updateByQuery($this, $request, $id, $dataUpdate);

        if ($user->is_admin != 0 && isset($request->role_ids)) {
            $user->roles()->sync($request->role_ids);
        }

        if ($request->hasFile('front_id_image_path')) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('front_id_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'front_id_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }

        if ($request->hasFile('back_id_image_path')) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('back_id_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'back_id_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }


        if ($request->hasFile('portrait_image_path')) {
            $item = Image::create([
                'uuid' => Helper::randomString(),
                'table' => $user->getTableName(),
                'image_path' => "waiting",
                'image_name' => "waiting",
                'relate_id' => $user->id,
            ]);

            $dataUploadFeatureImage = StorageImageTrait::storageTraitUpload($request, $request->file('portrait_image_path'), 'multiple', $item->id);

            $dataUpdate = [
                'image_path' => $dataUploadFeatureImage['file_path'],
                'image_name' => $dataUploadFeatureImage['file_name'],
            ];

            $item->update($dataUpdate);

            $user->update([
                'portrait_image_path' => $dataUploadFeatureImage['file_path']
            ]);
        }

        return $user;
    }

    public function deleteByQuery($request, $id, $forceDelete = false)
    {
        return Helper::deleteByQuery($this, $request, $id, $forceDelete);
    }

    public function deleteManyByIds($request, $forceDelete = false)
    {
        return Helper::deleteManyByIds($this, $request, $forceDelete);
    }

    public function findById($id)
    {
        $item = $this->find($id);
        $item->gender;
        $item->role;
        return $item;
    }
}
