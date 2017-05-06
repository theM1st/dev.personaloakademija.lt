<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvStudy extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['institution_id', 'institution_name', 'study_scope_id', 'study_scope', 'specialty', 'study_grade_id', 'study_course',
                           'study_form_id', 'study_from_year', 'study_to_year', 'study_tags'];

    public function cv()
    {
        return $this->belongsTo('App\Cv');
    }

    public function institution()
    {
        return $this->belongsTo('App\Institution', 'institution_id');
    }

    public function scope()
    {
        return $this->belongsTo('App\WorkScope', 'study_scope_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\StudyGrade', 'study_grade_id');
    }

    public function saveCv($cv, $request)
    {
        $data = $request->all();

        if (!isset($data['institution_id'])) {
            $data['institution_id'] = 0;
        }

        if (!isset($data['institution_name'])) {
            $data['institution_name'] = '';
        }

        if ($request->get('id'))
        {
            $item = self::find($request->get('id'));
            $item->fill($data)->save();
        }
        else
        {
            $class = get_class($this);
            $item = new $class($data);
            $item = $cv->studies()->save($item);
        }

        return $item->id;
    }

    public static function getCourses()
    {
        $courses = [1 => 'I kursas',
                    2 => 'II kursas',
                    3 => 'III kursas',
                    4 => 'IV kursas',
                    5 => 'V kursas',
                    6 => 'VI kursas'];

        return $courses;
    }

    public static function getFilterCourses()
    {
        $courses = [
            '1_1_2' => 'I k. bakalaurantūra',
            '2_1_2' => 'II k. bakalaurantūra',
            '3_1_2' => 'III k. bakalaurantūra',
            '4_1_2' => 'IV k. bakalaurantūra',
            '5_1_2' => 'V k. bakalaurantūra',
            '6_1_2' => 'VI k. bakalaurantūra',
            '1_3' => 'I magistrantūra',
            '2_3' => 'II magistrantūra',
            '0_4_11_12' => 'Doktorantūra',
            '0_5' => 'Internatūra',
            '0_6' => 'Rezidentūra',
        ];

        return $courses;
    }

    public static function getForms()
    {
        $forms = [1 => 'Nuolatinės',
                  2 => 'Neakivaizdinės',
                  4 => 'Vakarinės',
                  5 => 'Ištęstinės',
                  6 => 'Sustabdytos'];

        return $forms;
    }

    public static function getCoursesList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getCourses();

        return $data;
    }

    public static function getFormsList($prepend = array(null=>'-- Pasirinkti --'))
    {
        $data = $prepend;
        $data += self::getForms();

        return $data;
    }

    public static function getStudyYearsFromList($prepend = array(null=>'-- Pradžia --'))
    {
        $data = $prepend;

        $from = (new \Carbon('-67 year'))->year;
        $to = \Carbon::now()->year;

        $years = array();
        for ($i = $from; $i <= $to; $i++)
        {
            $years[$i] = $i;
        }

        return $data + $years;
    }

    public static function getStudyYearsToList($prepend = array(null=>'-- Pabaiga --'))
    {
        $data = $prepend;

        $from = (new \Carbon('-67 year'))->year;
        $to = (new \Carbon('+8 year'))->year;


        $years = array();
        for ($i = $from; $i <= $to; $i++)
        {
            $years[$i] = $i;
        }

        return $data + $years;
    }

    public function getCourseNameAttribute()
    {
        if ($this->study_course)
        {
            $courses = self::getCourses();
            return isset($courses[$this->study_course]) ? $courses[$this->study_course] : '';
        }

        return '';
    }

    public function getFormNameAttribute()
    {
        if ($this->study_form_id)
        {
            $forms = self::getForms();
            return isset($forms[$this->study_form_id]) ? $forms[$this->study_form_id] : '';
        }

        return '';
    }
}
