<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use NumberFormatter;

class Helpers
{
    //translatedFormatLong
    public static function translatedFormatLong($date, $format = "l, d \\d\\e F \\d\\e Y H:i:s")
    {
        if ($date) {
            return static::date_carbom_format($date)->translatedFormat($format);
        }
        return null;
    }

    //translatedFormatShort
    public static function translatedFormatShort($date, $format = "D M d H:i:s T Y")
    {
        if ($date) {
            return static::date_carbom_format($date)->translatedFormat($format);
        }
        return null;
    }

    public static function translatedFormat($date, $format = "d/m/Y H:i:s")
    {
        if ($date) {
            return static::date_carbom_format($date)->translatedFormat($format);
        }
        return null;
    }

    public static function date_carbom_format($date, $format = "d/m/Y H:i:s")
    {

        $date = explode(" ", str_replace(["-", "/", ":"], " ", $date));

        if (!isset($date[0])) {
            $date[0] = null;
        }
        if (!isset($date[1])) {
            $date[1] = null;
        }
        if (!isset($date[2])) {
            $date[2] = null;
        }
        if (!isset($date[3])) {
            $date[3] = null;
        }
        if (!isset($date[4])) {
            $date[4] = null;
        }
        if (!isset($date[5])) {
            $date[5] = null;
        }
        list($y, $m, $d, $h, $i, $s) = $date;

        $carbon = Carbon::now();
        // $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->setLocale('pt-br');
        if (strlen($date[0]) == 4) {
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDateTimeLocalString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDayDateTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDateString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDateString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullTimeString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDatetimeString().PHP_EOL;
            return $carbon->create($y, $m, $d, $h, $i, $s);
        }
        if ($y && $m && $d) {
            return $carbon->create($d, $m, $y, $h, $i, $s);
        }
        return $carbon->create(null, null, null, null, null, null);
    }

    public static function money($money, string $currency = 'BRL', int $divideBy = 0)
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        if ($divideBy) {
            $money /= $divideBy;
        }

        return $formatter->formatCurrency($money, $currency);
    }
}
