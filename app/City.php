<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    public static function getCitiesList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $cities = \Cache::remember('City.getLists' . md5(serialize($prepend)), 60, function(){
            return self::orderBy('position', 'asc')->orderBy(self::getNameField())->get();
        });

        foreach ($cities as $item)
        {
            $data[$item->id] = $item->name;
            if ($item->position == 4) {
                $data['— — — — — —'] = array();
            }
        }

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
