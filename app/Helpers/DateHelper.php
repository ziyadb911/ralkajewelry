<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    protected static $formatTanggal = 'd/m/Y';
    protected static $formatTanggalWaktu = 'Y/m/d H:i:s';
    protected static $defaultSelisihTanggal = 14;

    public static function stringToDate($string)
    {
        return Carbon::createFromFormat(self::$formatTanggal, $string);
    }

    public static function dateToString($date)
    {
        if (isset($date)) {
            return Carbon::parse($date)->format(self::$formatTanggal);
        } else {
            return "";
        }
    }

    public static function dateToStringIndonesia($date)
    {
        if (isset($date)) {
            $month = Carbon::parse($date)->month;
            switch ($month) {
                case '01':
                    $thisMonth = "Januari";
                    break;
                case '02':
                    $thisMonth = "Februari";
                    break;
                case '03':
                    $thisMonth = "Maret";
                    break;
                case '04':
                    $thisMonth = "April";
                    break;
                case '05':
                    $thisMonth = "Mei";
                    break;
                case '06':
                    $thisMonth = "Juni";
                    break;
                case '07':
                    $thisMonth = "Juli";
                    break;
                case '08':
                    $thisMonth = "Agustus";
                    break;
                case '09':
                    $thisMonth = "September";
                    break;
                case '10':
                    $thisMonth = "Oktober";
                    break;
                case '11':
                    $thisMonth = "November";
                    break;
                case '12':
                    $thisMonth = "Desember";
                    break;
                default:
                    $thisMonth = "test";
                    break;
            }
            return Carbon::parse($date)->format('d ') . $thisMonth . Carbon::parse($date)->format(' Y');
        } else {
            return "";
        }
    }

    public static function monthToStringIndonesia($month)
    {
        if (isset($month)) {
            switch ($month) {
                case '01':
                    $thisMonth = "Januari";
                    break;
                case '02':
                    $thisMonth = "Februari";
                    break;
                case '03':
                    $thisMonth = "Maret";
                    break;
                case '04':
                    $thisMonth = "April";
                    break;
                case '05':
                    $thisMonth = "Mei";
                    break;
                case '06':
                    $thisMonth = "Juni";
                    break;
                case '07':
                    $thisMonth = "Juli";
                    break;
                case '08':
                    $thisMonth = "Agustus";
                    break;
                case '09':
                    $thisMonth = "September";
                    break;
                case '10':
                    $thisMonth = "Oktober";
                    break;
                case '11':
                    $thisMonth = "November";
                    break;
                case '12':
                    $thisMonth = "Desember";
                    break;
                default:
                    $thisMonth = "test";
                    break;
            }
            return $thisMonth;
        } else {
            return "";
        }
    }

    public static function dateTimeToString($date)
    {
        $tanggal = Carbon::parse($date)->format('d/m/Y');
        $pukul = Carbon::parse($date)->format('H:i');
        return "$tanggal Jam $pukul";
    }

    public static function stringToDateTime($string)
    {
        return Carbon::createFromFormat(self::$formatTanggalWaktu, $string);
    }

    public static function nowString()
    {
        return Carbon::now()->format(self::$formatTanggal);
    }

    public static function getTglAwalString()
    {
        return self::getTglAwalDefault()->format(self::$formatTanggal);
    }

    public static function getTglAwalDefault()
    {
        return Carbon::now()->subDays(self::$defaultSelisihTanggal);
    }

    public static function now(){
        return Carbon::now();
    }
}
