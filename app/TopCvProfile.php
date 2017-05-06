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
        'cv_status', 'about', 'cv_tags', 'cv_skills',
        'cv_trainings', 'cv_certificates', 'cv_info',
        'driving_license', 'driving_license_year',
        'salary_trial', 'salary', 'active'
    ];

    public function languages()
    {
        return $this->hasMany('App\TopCvLanguage', 'cv_id');
    }

    public static function getStatuses()
    {
        $statuses = [
            'active' => 'CV aktyvus',
            'passive' => 'CV pasyvus'
        ];

        return $statuses;
    }

    public function getDrivingLicenseYearAttribute($value)
    {
        return ($value) ? $value : null;
    }
}
