<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model {

    public static function getYears($from, $to)
    {
        $years = array_combine($range = range($from, $to), $range);

        return $years;
    }

    public static function getYearsList($from, $to, $prepend = array(null=>'metai'))
    {
        $data = $prepend;
        $data += self::getYears($from, $to);

        return $data;
    }
} 