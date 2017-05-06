<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkScope extends Model {

    public function offers()
    {
        return $this->belongsToMany('App\Offer', 'offer_scopes', 'scope_id', 'offer_id')->valid();
    }

    public static function getScopesList($prepend = true, $offerCounter = false)
    {
        $data = \Cache::remember('WorkScope.getScopesList' . md5($prepend.$offerCounter), 60, function() use ($offerCounter)
        {
            $list = array();
            $items = self::orderBy('position')->get();
            foreach ($items as $item) {
                if ($offerCounter) {
                    $c = $item->offers()->count();
                }

                $list[$item->id] = $item->name . (!empty($c) ? " ($c)" : '');

                if ($item->position == 64) {
                    $list['— — — — — —'] = array();
                }
            }

            return $list;
        });

        if ($prepend) {
            $data->prepend('-- Pasirinkti --', null);
        }

        return $data;
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.\Lang::getLocale()};
    }

}
