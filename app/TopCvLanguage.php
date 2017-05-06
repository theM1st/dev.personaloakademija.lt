<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCvLanguage extends Model
{
    public $timestamps = false;

    public static function getLevels()
    {
        $data = collect([
            'excellent' => 'Puikiai',
            'good' => 'Gerai',
            'average' => 'Vidutiniškai',
            'bad' => 'Silpnai'
        ]);

        return $data;
    }

    public static function getLanguages($list=false)
    {
        $data = \Cache::remember('TopCvLanguage.getLanguages', 60, function(){
            return Language::whereIn('id', [1,2,3,4,5,6,7,20,9,10])
                ->orderBy('position', 'asc')
                ->get();
        });

        if ($list) {
            return $data->pluck('name_lt', 'id')->prepend('-- Pasirinkti --');
        }

        return $data;
    }
}
