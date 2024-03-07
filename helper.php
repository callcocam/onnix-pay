<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
use Carbon\Carbon;

// translatedFormatShort
if (!function_exists('translatedFormatShort')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function translatedFormatShort($date)
    {
        if ($date)
            return date_carbom_format($date)->translatedFormat('D, d \d\e M \d\e Y');
        return null;
    }
}

//translatedFormatLong
if (!function_exists('translatedFormatLong')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function translatedFormatLong($date)
    {
        if ($date)
            return date_carbom_format($date)->translatedFormat('l, d \d\e F \d\e Y');
        return null;
    }
}

//translatedFormat
if (!function_exists('translatedFormat')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function translatedFormat($date, $format = "d/m/Y H:i:s")
    {
        if ($date)
            return date_carbom_format($date)->translatedFormat($format);
        return null;
    }
}

if (!function_exists('date_carbom_format')) {

    function date_carbom_format($date, $format = "d/m/Y H:i:s")
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

        $carbon =  Carbon::now();
        // $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->setLocale('pt_BR');
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
}

//money
if (!function_exists('money')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function money($value, $symbol = "BRL")
    {
        return \App\Core\Helpers\Helpers::money($value, $symbol);
    }
}
