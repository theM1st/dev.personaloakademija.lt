<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCvScope extends Model
{
    public $timestamps = false;

    public function categories()
    {
        return $this->hasMany('App\TopCvScopeCategory', 'scope_id');
    }

    public static function getScopes($list=false)
    {
        $data = \Cache::remember('TopCvScope.getScopes', 60, function(){
            return self::orderBy('position', 'asc')->orderBy('name')->get();
        });

        if ($list) {
            return $data->pluck('name', 'id')->prepend('-- Pasirinkti --', 0);
        }

        return $data;
    }
}
