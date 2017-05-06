<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model {

    public static function getMonths()
    {
        $months = array();

        foreach (range(1, 12) as $month)
        {
            //$months[$month] = strftime('%B', mktime(0, 0, 0, $month, 1));
            $months[$month] = (strlen($month) < 2) ? '0'.$month : $month;
        }

        return $months;
    }

    public static function getMonthsList($prepend = array(null=>'mėnuo'))
    {
        $data = $prepend;
        $data += self::getMonths();

        return $data;
    }
} 