<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvCharacteristic extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function saveCv($cv, $request)
    {
        if (!$request->get('skip'))
        {
            $item = self::firstOrNew(array('id' => $request->get('characteristic_id')));
            $item->characteristic_name = $request->get('characteristic_name');
            $cv->characteristics()->save($item);

            $item = CvInterest::firstOrNew(array('id' => $request->get('interest_id')));
            $item->interest_name = $request->get('interest_name');
            $cv->interests()->save($item);

            $item = CvSocactivity::firstOrNew(array('id' => $request->get('socactivity_id')));
            $item->socactivity_name = $request->get('socactivity_name');
            $cv->socactivities()->save($item);

        }

        return true;
    }

    public function scopeNotEmpty($query)
    {
        return $query->where('characteristic_name', '!=', '');
    }
}
