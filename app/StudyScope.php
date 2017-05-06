<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyScope extends Model {

    public static function getScopesList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += \Cache::remember('StudyScope.getScopesList' . md5(serialize($prepend)), 60, function()
        {
            return self::orderBy(self::getNameField())->pluck(self::getNameField(), 'id');
        });

        return $data;
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
