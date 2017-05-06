<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitutionCategory extends Model {

    public function institutions()
    {
        return $this->hasMany('App\Institution', 'category_id');
    }

	public static function getGroupedList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;

        $data += \Cache::remember('InstitutionCategory.getGroupedList' . md5(serialize($prepend)), 60, function(){
            $categories = self::orderBy('position', 'asc')->orderBy(self::getNameField())->get();

            $list = array();
            foreach ($categories as $c)
            {
                $list[$c->name] = $c->institutions()->orderBy('position')->pluck(self::getNameField(), 'id');
            }

            return $list;
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
