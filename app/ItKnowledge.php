<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ItKnowledge extends Model {



    public static function getNameField()
    {
        return 'name_'.\Lang::getLocale();
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.\Lang::getLocale()};
    }
}
