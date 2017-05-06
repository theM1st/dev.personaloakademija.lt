<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvPractice extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['work_scope_id', 'city_id', 'spend_time_per_day', 'duration', 'start_date', 'practice_description'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function scope()
    {
        return $this->belongsTo('App\WorkScope', 'work_scope_id');
    }

    public function saveCv($cv, $request)
    {
        if (!$request->get('skip'))
        {
            if ($request->get('id'))
            {
                $item = self::find($request->get('id'));
                $item->fill($request->all())->save();
            }
            else
            {
                $class = get_class($this);
                $item = new $class($request->all());
                $cv->practices()->save($item);
            }
        }

        return true;
    }

    public static function getSpendTimePerDay()
    {
        $data = [3 => '3 valandos',
                 4 => '4 valandos',
                 5 => '5 valandos',
                 6 => '6 valandos',
                 8 => 'visą darbo dieną'];


        return $data;
    }

    public static function getSpendTimePerDayList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getSpendTimePerDay();

        return $data;
    }

    public static function getDuration()
    {
        $data = [1 => '2-3 sav.',
                2 => '1 mėn.',
                3 => '2 mėn.',
                4 => '3 mėn.',
                5 => '4 mėn.',
                6 => '5 mėn.',
                7 => '6 mėn.'];

        return $data;
    }

    public static function getDurationList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getDuration();

        return $data;
    }

    public function getCityAttribute()
    {
        if ($this->city_id)
        {
            $data = City::getCitiesList();
            return isset($data[$this->city_id]) ? $data[$this->city_id] : '';
        }

        return '';
    }

    public function getTimePerDayAttribute()
    {
        if ($this->spend_time_per_day)
        {
            $data = self::getSpendTimePerDay();
            return isset($data[$this->spend_time_per_day]) ? $data[$this->spend_time_per_day] : '';
        }

        return '';
    }

    public function getDurationNameAttribute()
    {
        if ($this->duration)
        {
            $data = self::getDuration();
            return isset($data[$this->duration]) ? $data[$this->duration] : '';
        }

        return '';
    }
}
