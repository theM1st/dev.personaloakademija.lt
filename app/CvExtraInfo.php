<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvExtraInfo extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'cv_document'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function saveCv($cv, $request)
    {
        if (!$request->get('skip')) {
            $data = $request->all();
            if ($request->get('id')) {
                $licenses = CvExtraInfo::getDrivingLicenses();

                foreach ($licenses as $k => $item) {
                    $data["driving_$k"] = ($request->get("driving_$k") ? 1 : 0);
                }

                $item = self::find($request->get('id'));
                $item->fill($data)->save();
            } else {
                $class = get_class($this);
                $item = new $class($data);
                $cv->extrainfos()->save($item);
            }
        }

        return true;
    }

    public static function getDrivingLicenses()
    {
        $data = [
            'a' => 'A',
            'b' => 'B',
            'c' => 'C',
            'd' => 'D',
        ];

        return $data;
    }
}