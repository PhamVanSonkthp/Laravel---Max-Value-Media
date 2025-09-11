<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Formatter extends Model
{
    use HasFactory;

    public static function getLimitRequest($limit)
    {
        if (!empty($limit)) {
            return (int)$limit;
        }
        return config('_my_config.items_show_in_table')[0];
    }

    public static function formatTimeToNow($input)
    {
        $date = new DateTime($input);
        $date = $date->getTimestamp();

        $now = new DateTime();
        $now = $now->getTimestamp();

        $a = $now - $date;
        $a *= 1000;

        if ($a < 60000) {
            return floor($a / 1000) . ' giây trước';
        } else if ($a < 3600000) {
            return floor($a / 60000) . ' phút trước';
        } else if ($a >= 3600000 && $a < 86400000) {
            return floor($a / 3600000) . ' giờ trước';
        } else if ($a >= 86400000 && $a < 2592000000) {
            return floor($a / 86400000) . ' ngày trước';
        } else if ($a >= 2592000000 && $a < 31104000000) {
            return floor($a / 2592000000) . ' tháng trước';
        } else {
            return floor($a / 31104000000) . ' năm trước';
        }
    }

    public static function getOnlyDate($input, $format = null)
    {
        $user = auth()->user();
        return Carbon::parse($input)->timezone(optional($user)->timezone ?? config('_my_config.timezone'))->format($format ?? config('_my_config.type_date'));
    }

    public static function getDateTime($input, $format = null)
    {
        $user = auth()->user();
        return Carbon::parse($input)->timezone(optional($user)->timezone ?? config('_my_config.timezone'))->format($format ?? config('_my_config.type_date_time'));
    }

    public static function getOnlyTime($input)
    {
        $user = auth()->user();
        return Carbon::parse($input)->timezone(optional($user)->timezone ?? config('_my_config.timezone'))->format($format ?? config('_my_config.type_time_no_second'));
    }

    public static function paginator(Request $request, $data)
    {

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = $request->limit ?? 10;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());

        // add in view
        // {!! $items->links() !!}

        return $items;
    }

    public static function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public static function maxLengthString($input, $max = 20)
    {
        $input = $input . "";

        if (mb_strlen($input) > ($max + 3)) {
            return mb_substr($input, 0, $max) . "...";
        }
        return $input;
    }

    public static function getThumbnailImage($input, $format = "100x100")
    {
        return str_replace("original", $format, $input);
    }

    public static function convertTypeTime($value, $inputType = "dd/mm/yyyy", $outputType = "yyyy/mm/dd")
    {

        if (empty($value)) {
            return date('Y-m-d');
        }

        $value = str_replace("-", "/", $value);

        $value = explode("/", $value);

        if (count($value) < 3) {
            return date('Y-m-d');
        }

        if ($outputType == "yyyy/mm/dd" && strlen($value[0]) <= 2) {
            return $value[2] . '/' . $value[1] . '/' . $value[0];
        }
        return $value[0] . '/' . $value[1] . '/' . $value[2];
    }

    public static function getShortDescriptionAttribute($description, $numberWord = 20)
    {
        $taglessDescription = strip_tags($description);
        return html_entity_decode(Str::words($taglessDescription, $numberWord, '....'));
    }

    public static function toUnderline($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    public static function convertNumberToMoney($input)
    {
        if (empty($input)) {
            return 0;
        }
        return number_format($input, 0, ".", ".");
    }

    public static function formatMoney($input, $decima = 0)
    {
        if (empty($input)) {
            return 0;
        }
        return number_format($input, $decima);
    }

    public static function formatNumber($input, $decima = 0)
    {
        if (empty($input)) {
            return 0;
        }
        return number_format($input, $decima);
    }

    public static function formatNumberToDatabase($input)
    {
        if (empty($input)) {
            return 0;
        }
        return (int)filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function formatMoneyToDatabase($input)
    {
        if (empty($input)) {
            return 0;
        }
        return (int)filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function hash($input)
    {
        return Hash::make($input);
    }

    public static function trimer($input)
    {
        return trim($input);
    }

    public static function convertDateVNToEng($input)
    {
        $input = str_replace("/", "-", $input);
        $values = explode("-", $input);
        return $values[2] . "-" . $values['1'] . "-" . $values[0];
    }

    public static function getOnlyNumber($input)
    {
        if (empty($input)) {
            return 0;
        }
        return (int)filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function slug($input)
    {
        return Str::slug($input);
    }

    public static function tryParseInt($input)
    {
        if (empty($input)) {
            return 0;
        }

        return (int)$input;
    }

    public static function toTimestamp($input)
    {
        return Carbon::parse($input)->format('Uu') / pow(10, 6 - 3);
    }

    public static function isEmail($input)
    {
        return !empty($input) && filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    public static function hiddenPhone($number)
    {
        $middle_string = "";
        $length = strlen($number);

        if ($length < 3) {
            return $length == 1 ? "*" : "*" . substr($number, -1);
        } else {
            $part_size = floor($length / 3);
            $middle_part_size = $length - ($part_size * 2);
            for ($i = 0; $i < $middle_part_size; $i++) {
                $middle_string .= "*";
            }

            return substr($number, 0, $part_size) . $middle_string . substr($number, -$part_size);
        }
    }

    public static function addHttps($url)
    {
        if (!Str::startsWith($url, ['http://', 'https://'])) {
            $url = "https://" . $url;
        }
        return $url;
    }

    public static function removeHttps($url)
    {
        return trim(preg_replace("~^(?:https?://)~i", '', $url), '/');
    }

    public static function isDomain($domain)
    {
        $domain = self::removeHttps($domain);

        return preg_match('/^(?!:\/\/)([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/i', $domain);

    }

    public static function estimateTimePayment($date)
    {
        return Carbon::parse($date)->addMonth()->addDays(14)->toDateString();

    }
}
