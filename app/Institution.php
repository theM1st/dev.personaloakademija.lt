<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

    public function category()
    {
        return $this->hasOne('InstitutionCategory');
    }

    public static function getNameField()
    {
        return 'name_'.\Lang::getLocale();
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.\Lang::getLocale()};
    }
}
