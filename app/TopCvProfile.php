<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCvProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'age', 'city_id', 'telephone',
        'email', 'scope_id', 'scope_category_id',
        'cv_status', 'cv_name', 'about', 'cv_tags', 'cv_skills',
        'cv_trainings', 'cv_certificates', 'cv_info',
        'driving_license', 'driving_license_year',
        'salary_trial', 'salary', 'active'
    ];

    public function languages()
    {
        return $this->hasMany('App\TopCvLanguage', 'cv_id');
    }

    public function studies()
    {
        return $this->hasMany('App\TopCvStudy', 'cv_id');
    }

    public function works()
    {
        return $this->hasMany('App\TopCvWork', 'cv_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function scope()
    {
        return $this->belongsTo('App\TopCvScope');
    }

    public function category()
    {
        return $this->belongsTo('App\TopCvScopeCategory', 'scope_category_id');
    }

    public function scopeActive($query)
    {
        if (auth()->check() && auth()->user()->isAdminWorker()) {
            return $query;
        } else {
            return $query->where('active', 1);
        }
    }

    public function scopeOfCities($query, $cities)
    {
        foreach ($cities as $k => $c) {
            if ($c == '') unset($cities[$k]);
        }

        return $query->where(function ($query) use ($cities) {
            $query->whereIn('city_id', $cities);
        });
    }

    public static function getStatuses()
    {
        $statuses = [
            'active' => 'CV aktyvus',
            'passive' => 'CV pasyvus'
        ];

        return $statuses;
    }

    public function getGenderNameAttribute()
    {
        if ($this->gender)
        {
            $genders = Gender::getGendersList();
            return isset($genders[$this->gender]) ? $genders[$this->gender] : '';
        }

        return '';
    }

    public function getDrivingLicenseYearAttribute($value)
    {
        return ($value) ? $value : null;
    }
}
