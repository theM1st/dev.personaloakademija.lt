<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CvWorkCity;

class CvWork extends Model {

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['interested_work_position', 'interested_work_description'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function scope()
    {
        return $this->belongsTo('App\WorkScope', 'work_scope_id');
    }

    public function cities()
    {
        return $this->belongsToMany('App\City', 'cv_work_cities', 'cv_work_id', 'city_id');
    }

    public function workScopes()
    {
        return $this->belongsToMany('App\WorkScope', 'cv_work_scopes', 'cv_work_id', 'work_scope_id');
    }

    public function saveCv($cv, $request)
    {
        if ($request->get('form_type') == 'works') {
            if (!$request->get('skip')) {
                if ($request->get('id')) {
                    $item = self::find($request->get('id'));
                    $item->fill($request->all())->save();
                } else {
                    $class = get_class($this);
                    $item = $cv->works()->save(new $class($request->all()));
                }

                //$item->cities()->delete();
                //$item->workScopes()->delete();

                if ($request->get('interested_work_city_id')) {
                    $item->cities()->sync($request->get('interested_work_city_id'));
                }

                if ($request->get('work_scope_id')) {
                    $item->workScopes()->sync($request->get('work_scope_id'));
                }

                if ($item->id) {
                    return $item->id;
                }
            }
        }

        if ($request->get('form_type') == 'experiences') {
            $cvExperience = new CvExperience;
            return $cvExperience->saveCv($cv, $request);
        }

        return true;
    }

    public function getCitiesNameAttribute()
    {
        if ($this->cities()->count()) {
            return $this->cities->pluck('name');
        }

        return null;
    }

    public function getWorkScopesNameAttribute()
    {
        if ($this->workScopes()->count()) {
            return $this->workScopes->pluck('name');
        }

        return null;
    }
}
