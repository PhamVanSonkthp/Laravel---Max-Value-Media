<?php

namespace App\Models;

use App\Notifications\Notifications;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;
use DateTime;
use Google\Auth\CredentialsLoader;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class Helper extends Model
{
    use HasFactory;

    use DeleteModelTrait;
    use StorageImageTrait;

    public static function getNextIdTable($table)
    {

        try {
            $item = DB::table($table)->orderBy('id', 'DESC')->first();

            if (empty($item)) {
                return 1;
            }

            return $item->id + 1;
//            $statement = DB::select("SHOW TABLE STATUS LIKE '$table'");
//            return $statement[0]->Auto_increment;
        } catch (\Exception $exception) {
            return 0;
        }
    }

    public static function getTableName($object)
    {
        return $object->getTable();
    }

    public static function getDefaultIcon($object, $size = "100x100", $path_default = null)
    {
        $image = $object->image;

        if (!empty($image)) {
            return Formatter::getThumbnailImage($image->image_path, $size);
        }

        if (!empty($object->feature_image_path)) {
            return $object->feature_image_path;
        }

        return $path_default ?? config('_my_config.default_avatar');
    }

    public static function image($object)
    {
        $item = $object->hasOne(SingleImage::class, 'relate_id', 'id')->where('table', $object->getTable());

        $isSingle = SingleImage::where('relate_id', $object->id)->where('table', $object->getTable())->first();

        if (!empty($isSingle)) {
            return $item;
        }

        return $object->hasOne(Image::class, 'relate_id', 'id')->where('table', $object->getTable())->orderBy('index');
    }

    public static function images($object)
    {

        $images = $object->hasMany(Image::class, 'relate_id', 'id')->where('table', $object->getTable())->orderBy('index');

        if (!empty($images) && $images->count()) {
            return $images;
        }

        $item = $object->hasMany(SingleImage::class, 'relate_id', 'id')->where('table', $object->getTable());

        if (!empty($isSingle)) {
            return $item;
        }

        return $item;
    }

    public static function getAllColumsOfTable($object)
    {
        return Schema::getColumnListing($object->getTableName());
    }

    public static function searchByQuery($object, $request, $queries = [], $random_record = null, $make_hiddens = null, $is_custom = false)
    {
        $columns = Schema::getColumnListing($object->getTableName());
        $query = $object->query();

        $searchLikeColumns = ['name', 'title', 'search_query', 'id', 'sku', 'phone', 'email', 'code', 'short_name'];
        $searchColumnBanned = ['limit', 'page', 'with_trashed'];

        foreach ($request->all() as $key => $item) {
            if (is_string($item)) {
                $item = trim($item);
            }

            if (in_array($key, $searchColumnBanned)) {
                continue;
            }

            if (in_array($key, $searchLikeColumns)) {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns, $object) {
                        foreach ($searchLikeColumns as $searchColumn) {
                            if (in_array($searchColumn, $columns)) {
                                $query->orWhere(self::getTableName($object) . '.' . $searchColumn, 'LIKE', "%{$item}%");
                            }
                        }
                    });
                }
            } else if ($key == "start" || $key == "from" || $key == "begin") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate($object->getTableName() . '.created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate($object->getTableName() . '.created_at', '<=', $item);
                }
            } else {
                if (!in_array($key, $columns)) {
                    continue;
                }
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where($object->getTableName() . "." . $key, $item);
                }
            }
        }

        if (is_array($queries)) {
            foreach ($queries as $key => $item) {
                if (is_string($item)) {
                    $item = trim($item);
                }

                if (in_array($key, $searchColumnBanned)) {
                    continue;
                }

                if (in_array($key, $searchLikeColumns)) {
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns) {
                            foreach ($searchLikeColumns as $searchColumn) {
                                if (in_array($searchColumn, $columns)) {
                                    $query->orWhere($searchColumn, 'LIKE', "%{$item}%");
                                }
                            }
                        });
                    }
                } else if ($key == "start" || $key == "from") {
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->whereDate('created_at', '>=', $item);
                    }
                } else if ($key == "end" || $key == "to") {
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->whereDate('created_at', '<=', $item);
                    }
                } else {
                    if (!in_array($key, $columns)) {
                        continue;
                    }
                    if (!empty($item) || strlen($item) > 0) {
                        $query = $query->where($key, $item);
                    }
                }
            }

            foreach ($queries as $key => $item) {
                if (is_string($item)) {
                    $item = trim($item);
                }

                if ($key == 'with_trashed' && $item == true) {
                    $query = $query->withTrashed();
                    break;
                }
            }
        }

        if (isset($request->filter) && !empty($request->filter)) {
            $filter = $request->filter;

            $filter = str_replace("[", "", $filter);
            $filter = str_replace("]", "", $filter);

            $values = explode(",", $filter);

            foreach ($values as $value) {
                if (count(explode("=", $value)) > 1) {
                    $key = explode("=", $value)[0];
                    $val = explode("=", $value)[1];

                    if (in_array($key, $columns) && !empty($val)) {
                        $query->orderBy($key, $val);
                    }
                }
            }
        }

        if ($random_record) {
            $query = $query->inRandomOrder();
        }

        if ($request->trash) {
            if (in_array('deleted_at', $columns)) {
                $query = $query->onlyTrashed();
            } else {
                $query = $query->where('id', -1);
            }
        }

        if ($is_custom) {
            return $query;
        }

        if (in_array("priority", $columns)) {
            $query = $query->orderBy('priority', 'DESC');
        }

        $items = $query->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->paginate(Formatter::getLimitRequest($request->limit))->appends(request()->query());

        if (!empty($make_hiddens) && is_array($make_hiddens)) {
            foreach ($items as $item) {
                $item->makeHidden($make_hiddens)->toArray();
            }
        }
        return $items;
    }

    public static function getValueInFilterReuquest($key_request)
    {

        $request = request();
        if (isset($request->filter) && !empty($request->filter)) {
            $filter = $request->filter;

            $filter = str_replace("[", "", $filter);
            $filter = str_replace("]", "", $filter);

            $values = explode(",", $filter);

            foreach ($values as $value) {
                if (count(explode("=", $value)) > 1) {
                    $key = explode("=", $value)[0];
                    $val = explode("=", $value)[1];

                    if ($key == $key_request) {
                        return $val;
                    }
                }
            }
        }

        return "";
    }

    public static function searchAllByQuery($object, $request, $queries = [])
    {
        $columns = Schema::getColumnListing($object->getTableName());
        $query = $object->query();

        $searchLikeColumns = ['name', 'title'];
        $searchColumnBanned = ['limit', 'page', 'with_trashed'];

        foreach ($request->all() as $key => $item) {
            if (is_string($item)) {
                $item = trim($item);
            }
            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function ($query) use ($item, $columns, $searchLikeColumns) {
                        foreach ($searchLikeColumns as $searchColumn) {
                            if (in_array($searchColumn, $columns)) {
                                $query->orWhere($searchColumn, 'LIKE', "%{$item}%");
                            }
                        }
                    });
                }
            } else if ($key == "gender_id") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where('gender_id', $item);
                }
            } else if ($key == "start" || $key == "from") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '<=', $item);
                }
            }
        }

        foreach ($queries as $key => $item) {
            if (is_string($item)) {
                $item = trim($item);
            }

            if (in_array($key, $searchColumnBanned)) {
                continue;
            }

            if ($key == "search_query") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where(function ($query) use ($item) {
                        $query->orWhere('name', 'LIKE', "%{$item}%");
                    });
                }
            } else if ($key == "gender_id") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where('gender_id', $item);
                }
            } else if ($key == "start" || $key == "from") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '>=', $item);
                }
            } else if ($key == "end" || $key == "to") {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->whereDate('created_at', '<=', $item);
                }
            } else {
                if (!empty($item) || strlen($item) > 0) {
                    $query = $query->where($key, $item);
                }
            }
        }

        foreach ($queries as $key => $item) {
            if (is_string($item)) {
                $item = trim($item);
            }

            if ($key == 'with_trashed' && $item == true) {
                $query = $query->withTrashed();
                break;
            }
        }

        return $query->latest()->get();
    }

    public static function storeByQuery($object, $request, $data_create)
    {
        $item = $object->create($data_create);
        return $item;
    }

    public static function updateByQuery($object, $request, $id, $data_update)
    {
        $object->find($id)->update($data_update);
        $item = $object->find($id);
        return $item;
    }

    public static function deleteByQuery($object, $request, $id, $force_delete = false)
    {
        return $object->deleteModelTrait($id, $object, $force_delete);
    }

    public static function deleteManyByIds($object, $request, $force_delete = false)
    {
        $items = [];
        foreach ($request->ids as $id) {
            $item = $object->deleteModelTrait($id, $object, $force_delete, $request);
            $items[] = $item;
        }

        return $items;
    }

    public static function addSlug($object, $key, $value, $id = null)
    {

        $slug = Str::slug($value);

        if (!empty($id)) {
            $itemUpdate = $object->find($id);

            if (!empty($itemUpdate)) {
                if ($itemUpdate->$key == $slug) {
                    return $slug;
                }
            }
        }

        if (empty($slug)) {
            $slug = $object->latest()->first() ? optional($object->latest()->first())->id + 1 : 1;
        }

        $item = $object->where($key, $slug)->first();

        if (empty($item)) {
            return $slug;
        }

        for ($i = 1; $i < 100000; $i++) {
            $item = $object->where($key, Str::slug($value) . '-' . $i)->first();
            if (empty($item)) {
                return Str::slug($value) . '-' . $i;
            }
        }
        return Str::random(40);
    }

    public static function logoImagePath()
    {
        $logo = Logo::first();
        if (empty($logo)) {
            $table = 'logos';
        } else {
            $table = $logo->getTableName();
        }

        return optional(SingleImage::where('relate_id', !empty($logo) ? $logo->id : Helper::getNextIdTable($table))->where('table', $table)->first())->image_path;
    }


    static function getTokenFirebase()
    {
        try {
            $file = File::get(base_path() . env('FIREBASE_FILE_JSON_PATH'));
            $scope = 'https://www.googleapis.com/auth/firebase.messaging';
            $credentials = CredentialsLoader::makeCredentials($scope, json_decode($file, true));
            $credentials = $credentials->fetchAuthToken();

            return $credentials;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return null;
    }

    static function refreshTokenFirebase()
    {

        $setting = Setting::first();

        if (!empty($setting)) {
            $token_firebase_expired_at = $setting->token_firebase_expired_at;


            if (empty($setting->token_firebase) || empty($token_firebase_expired_at) || self::compareTwoDate(now(), $setting->token_firebase_expired_at)) {
                $credentials = self::getTokenFirebase();

                if (!empty($credentials)) {
                    $setting->update([
                        'token_firebase' => $credentials['access_token'],
                        'token_firebase_expired_at' => Carbon::now()->addSeconds($credentials['expires_in']),
                    ]);
                }
            }
        }
    }

    public static function sendNotificationToTopic($topic_name, $title, $body, $save = false, $user_id = null, $image_path = null, $activity = null)
    {
        if ($save && !empty($user_id)) {
            UserNotification::create([
                'user_id' => $user_id,
                'title' => $title,
                'content' => $body,
                'image_path' => $image_path ?? Helper::logoImagePath(),
                'activity' => $activity,
            ]);
        }

        if (env('FIREBASE_SERVER_NOTIFIABLE', true)) {
            self::refreshTokenFirebase();

            $token = optional(Setting::first())->token_firebase;

            try {
                $client = new Client();
                $client->post(
                    'https://fcm.googleapis.com/v1/projects/' . env('FIREBASE_PROJECT_NAME') . '/messages:send',
                    [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => "Bearer " . $token,
                            'priority' => 'high',
                        ],
                        'json' => [
                            'message' => [
                                'topic' => $topic_name . "",
                                'notification' => [
                                    'title' => $title,
                                    'body' => $body,
                                ],
                                'data' => [
                                    'title' => $title,
                                    'body' => $body,
                                    'activity' => $activity,
                                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                                ],
                                'apns' => [
                                    'headers' => [
                                        'apns-priority' => '10'
                                    ],
                                    'payload' => [
                                        'aps' => [
                                            'sound' => 'default'
                                        ]
                                    ],
                                ],
                                'android' => [
                                    'priority' => 'high',
                                    'notification' => [
                                        'sound' => 'default',
                                    ],
                                ],
                            ],
                        ],
                        'timeout' => 50, // Response timeout
                        'connect_timeout' => 50, // Connection timeout
                    ]
                );
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    public static function errorAPI($code, $data, $message)
    {
        DB::rollBack();
        return [
            'success' => false,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ];
    }

    public static function randomString($length = 10)
    {
        return Str::random($length);
    }

    public static function sendEmailToShop($subject, $body)
    {
        $email = env('EMAIL_SHOP');

        $user = (new User([
            'email' => $email,
            'name' => substr($email, 0, strpos($email, '@')), // here we take the name form email (string before "@")
        ]));

        $user->notify(new Notifications($subject, $body));
    }

    public static function sendEmail($subject, $body, $email)
    {
        $user = (new User([
            'email' => $email,
            'name' => substr($email, 0, strpos($email, '@')), // here we take the name form email (string before "@")
        ]));

        $user->notify(new Notifications($subject, $body));
    }

    public static function addZero($input)
    {
        $input = $input . "";

        if (strlen($input) <= 1) {
            return "0" . $input;
        }

        return $input;
    }

    public static function randomNumber($length = 6)
    {
        $key = "";
        for ($i = 0; $i < $length; $i++) {
            $key .= random_int(0, 9);
        }

        return $key;
    }


    public static function convertDateVNToEng($input)
    {
        $str = explode(" ", $input);

        $input = $str[0];
        $input = str_replace("/", "-", $input);
        $values = explode("-", $input);
        return $values[2] . "-" . $values['1'] . "-" . $values[0] . " " . $str[1];
    }

    public static function daysBetweenTwoDates($begin, $end)
    {

        $fdate = $begin;
        $tdate = $end;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        return (int)$days;
    }

    public static function hoursBetweenTwoDates($begin, $end)
    {
        return round((strtotime($begin) - strtotime($end))/3600, 1);
    }

    public static function getUUID()
    {
        return Str::uuid();
    }

    public static function diskUsed()
    {
        $disktotal = disk_total_space('/'); //DISK usage
        $disktotalsize = $disktotal / 1073741824;

        $diskfree = disk_free_space('/');
        $used = $disktotal - $diskfree;

        $diskusedize = $used / 1073741824;
        $diskuse1 = round(100 - (($diskusedize / $disktotalsize) * 100));
        $diskuse = round(100 - ($diskuse1)) . '%';

        return $diskuse;
    }

    public static function diskUsedSize()
    {
        $disktotal = disk_total_space('/'); //DISK usage
        $disktotalsize = $disktotal / 1073741824;

        $diskfree = disk_free_space('/');
        $used = $disktotal - $diskfree;

        $diskusedize = $used / 1073741824;
        return $diskusedize;
    }

    public static function diskTotalSize()
    {
        $disktotal = disk_total_space('/'); //DISK usage
        $disktotalsize = $disktotal / 1073741824;

        return $disktotalsize;
    }

    public static function callGetHTTP($url, $params = [])
    {
        $params = [
            'query' => $params
        ];

        try {
            $headers = [
                'Content-Type' => 'application/json',
            ];

            $client = new Client([
                'headers' => $headers
            ]);

            $response = $client->request('GET', $url, $params);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return null;
        }
    }

    public static function callPostHTTP($url, $params = [], $request = null)
    {
        $raw = [];

        $raw['Data'] = $params;

        try {
            $headers = [
                'Content-Type' => 'application/json',
            ];

            $response = Http::withHeaders($headers)->timeout(300)
                ->send('POST', $url, [
                    'body' => json_encode($raw)
                ])->json();

            return $response;
        } catch (\Exception $exception) {
            if ($exception->getCode() == 429) {
                return self::callPostHTTP($url, $params, $request);
            }

            return $exception->getMessage();
        }
    }

    public static function compareTwoDate($date1, $date2)
    {

        $date1 = Carbon::parse($date1);
        $date2 = Carbon::parse($date2);

        return $date1->greaterThan($date2);
    }

    public static function successAPI($code, $data, $message)
    {
        return [
            'success' => true,
            'code' => $code,
            'data' => $data,
            'message' => $message
        ];
    }

    public static function sortTwoModel($model, $old_id, $new_ids)
    {
        $maxPriority = max($new_ids);

        foreach ($new_ids as $new_id) {
            $item = $model->findOrFail($new_id);
            $item->priority = $maxPriority--;
            $item->save();
        }
    }

    public static function addItemToPositionArray(&$array, $position, $insert)
    {
        if (is_int($position)) {
            array_splice($array, $position, 0, $insert);
        } else {
            $pos = array_search($position, array_keys($array));
            $array = array_merge(
                array_slice($array, 0, $pos),
                $insert,
                array_slice($array, $pos)
            );
        }
    }

    public static function convertVariableToModelName($modelName = '', $nameSpace = '')
    {
        //if the given name space iin array the implode to string with \\
        if (is_array($nameSpace)) {
            $nameSpace = implode('\\', $nameSpace);
        }
        //by default laravel ships with name space App so while is $nameSpace is not passed considering the
        // model namespace as App
        if (empty($nameSpace) || is_null($nameSpace) || $nameSpace === "") {
            $modelNameWithNameSpace = "App" . '\\' . $modelName;
        }
        //if you are using custom name space such as App\Models\Base\Country.php
        //$namespce must be ['App','Models','Base']
        if (is_array($nameSpace)) {
            $modelNameWithNameSpace = $nameSpace . '\\' . $modelName;
        } //if you are passing Such as App in name space
        elseif (!is_array($nameSpace) && !empty($nameSpace) && !is_null($nameSpace) && $nameSpace !== "") {
            $modelNameWithNameSpace = $nameSpace . '\\' . $modelName;
        }
        //if the class exist with current namespace convert to container instance.
        if (class_exists($modelNameWithNameSpace)) {
            // $currentModelWithNameSpace = Container::getInstance()->make($modelNameWithNameSpace);
            // use Illuminate\Container\Container;
            $currentModelWithNameSpace = app($modelNameWithNameSpace);
        } //else throw the class not found exception
        else {
            return null;
//            throw new \Exception("Unable to find Model : $modelName With NameSpace $nameSpace", E_USER_ERROR);
        }

        return $currentModelWithNameSpace;
    }

    public static function prefixToClassName($prefix)
    {
        $values = explode("_", $prefix);


        $str = "";

        foreach ($values as $index => $value) {
            if (count($values) - 1 == $index) {
                $str .= ucwords(substr($value, 0, -1));
            } else {
                $str .= ucwords($value);
            }
        }

        return $str;
    }


    public static function metToKm($input)
    {
        return $input / 1000;
    }

    public static function timeIsBetweenTwoTimes($sunset, $sunrise, $current_time)
    {
        $start = new DateTime($sunset);
        $end = new DateTime($sunrise);
        $current = new DateTime($current_time);

        return $current >= $start && $current <= $end;
    }

    public static function distanceTwoCoordinates($lat1, $lon1, $lat2, $lon2, $unit = "M") {

        $lat1 = (float) $lat1;
        $lon1 = (float) $lon1;
        $lat2 = (float) $lat2;
        $lon2 = (float) $lon2;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return round($miles * 1.609344) * 1000 ;
        }
    }
}
