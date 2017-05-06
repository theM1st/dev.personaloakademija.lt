<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyGrade extends Model {

    public static function getGradesList($prepend = true)
    {
        $data = \Cache::remember('StudyGrade.getGradesList' . md5($prepend), 60, function(){
            return StudyGrade::orderBy('position')->pluck(self::getNameField(), 'id');
        });

        if ($prepend) {
            $data->prepend('-- Pasirinkti --', 0);
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
