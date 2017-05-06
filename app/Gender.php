<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model {

    public static function getGenders()
    {
        $genders = ['M' => 'Vyras', 'F' => 'Moteris'];

        return $genders;
    }

    public static function getGendersList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getGenders();

        return $data;
    }
}