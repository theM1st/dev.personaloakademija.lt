<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopCvProfile extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gender', 'age', 'city_id', 'telephone',
        'email', 'scope_id', 'scope_category_id',
        'cv_status', 'cv_name', 'about', 'cv_tag', 'cv_skills',
        'cv_trainings', 'cv_certificates', 'cv_info',
        'driving_license', 'driving_license_year',
        'salary_trial', 'salary', 'active'
    ];

    protected $dates = ['deleted_at'];

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

    public function scopeOfGenders($query, $genders)
    {
        return $query->whereIn('gender', $genders);
    }

    public function scopeOfScopes($query, $scopes)
    {
        return $query->whereHas('category', function($q) use ($scopes) {
            $q->whereIn('scope_category_id', $scopes);
        });
    }

    public function scopeOfAge($query, $from, $to)
    {
        if ($from) {
            $query->where('age', '>=', $from);
        }

        if ($to) {
            $query->where('age', '<=', $to);
        }

        return $query;
    }

    public function scopeOfTag($query, $tag)
    {
        if (strpos($tag, ',') !== false) {
            $tags = explode(',', $tag);
        } else {
            $tags = explode(' ', $tag);
        }

        for ($i = 0; $i < count($tags); ++$i) {
            if (isset($tags[$i])) {
                if ($i == 0)
                    $query->where('cv_tag', 'like', trim($tags[$i]).'%');
                else
                    $query->orWhere('cv_tag', 'like', trim($tags[$i]).'%');
            }
        }

        return $query;
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
