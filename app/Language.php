<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    public static function getLanguages()
    {
        $data = \Cache::remember('Language.getLanguages', 60, function() {
            return self::orderBy('position')->pluck(self::getNameField(), 'id');
        });

        return $data;
    }

    public static function getLanguagesList($prepend = true)
    {
        $data = self::getLanguages();

        if ($prepend) {
            $data->prepend('-- Pasirinkti --', 0);
        }

        $data[100] = 'Kita kalba';

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
