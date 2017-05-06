<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvRecomendation extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'save'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
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
                $cv->recomendations()->save($item);
            }
        }

        return true;
    }

    public static function getTypes()
    {
        $data = [1 => 'Rekomendacija',
                 2 => 'Pagyrimas',
                 3 => 'Apdovanojimas',
                 4 => 'Rekomendacija'];

        return $data;
    }

    public static function getTypesList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getTypes();

        return $data;
    }

    public static function getYearsList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;

        $from = \Carbon::now()->year;
        $to = (new \Carbon('-20 year'))->year;


        $years = array();
        for ($i = $from; $i >= $to; $i--)
        {
            $years[$i] = $i;
        }

        return $data + $years;
    }

    public function getTypeNameAttribute()
    {
        if ($this->recomendation_type_id)
        {
            $data = self::getTypes();
            return isset($data[$this->recomendation_type_id]) ? $data[$this->recomendation_type_id] : '';
        }

        return '';
    }
}
