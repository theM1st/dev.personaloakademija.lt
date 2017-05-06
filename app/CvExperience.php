<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvExperience extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_name', 'work_position', 'main_tasks', 'achievements', 'reason_go_out', 'work_from', 'work_to'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function saveCv($cv, $request)
    {
        if (!$request->get('skip')) {
            $data = $request->all();

            if ($data['work_from_year'] && $data['work_to_year']) {

                $data['work_from_month'] = (strlen($data['work_from_month']) < 2 ? '0' . $data['work_from_month'] : $data['work_from_month']);
                $data['work_to_month'] = (strlen($data['work_to_month']) < 2 ? '0' . $data['work_to_month'] : $data['work_to_month']);

                // Dabar
                if ($data['work_to_year'] == 0) {
                    $data['work_to_month'] = '';
                }

                $data['work_from'] = trim($data['work_from_year'] . '-' . $data['work_from_month'], '-');
                $data['work_to'] = trim($data['work_to_year'] . '-' . $data['work_to_month'], '-');

                if ($request->get('id')) {
                    $item = self::find($request->get('id'));
                    $item->fill($data)->save();
                } else {

                    $class = get_class($this);
                    $item = new $class($data);
                    $item = $cv->experiences()->save($item);

                }

                return $item->id;
            }
        }

        return true;
    }

    public function getWorkFromYearAttribute()
    {
        $data = explode('-', $this->work_from);

        if (isset($data[0]))
        {
            return $data[0];
        }
    }

    public function getWorkFromMonthAttribute()
    {
        $data = explode('-', $this->work_from);

        if (isset($data[1]))
        {
            return $data[1];
        }
    }

    public function getWorkFromMonthNameAttribute()
    {
        return ($this->workFromMonth) ? strftime('%B', mktime(0, 0, 0, $this->workFromMonth, 1)) : '';
    }

    public function getWorkToYearAttribute()
    {
        $data = explode('-', $this->work_to);

        if (isset($data[0]))
        {
            return $data[0];
        }
    }

    public function getWorkToMonthAttribute()
    {
        $data = explode('-', $this->work_to);

        if (isset($data[1]))
        {
            return $data[1];
        }
    }

    public function getWorkToMonthNameAttribute()
    {
        return ($this->workToMonth) ? strftime('%B', mktime(0, 0, 0, $this->workToMonth, 1)) : '';
    }

    public function getWorkToNameAttribute()
    {

        $y = $this->getWorkToYearAttribute();
        $m = $this->getWorkToMonthAttribute();

        if ($y == 0) {
            return 'Dabar';
        } else {
            return $y.'-'.$m;
        }
    }
}
