<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Route;
use Illuminate\Support\Facades\Input;

class Cv extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cv_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'birthday', 'gender', 'email', 'telephone',
                           'practice_city_id', 'job_city_id', 'cv_status',
                           'cv_name', 'cv_file', 'description', 'cv_tag', 'photo', 'state'];

    protected $dates = ['birthday'];

    public static $cvStates = [
        1 => array('name' => 'Asmeniniai duomenys'),
        2 => array('name' => 'CV pavadinimas, trumpas prisistatymas'),
        3 => array('name' => 'Išsilavinimas'),
        4 => array('name' => 'Pageidaujamas darbas ir darbo patirtis'),
        5 => array('name' => 'Kalbų mokėjimas'),
        6 => array('name' => 'Kompiuterinis raštingumas'),
        7 => array('name' => 'Asmeninės savybės, pomėgiai'),
        8 => array('name' => 'Kursai, seminarai, tobulėjimas'),
        9 => array('name' => 'Pagyrimai, apdovanojimai, rekomendacijos'),
        10 => array('name' => 'Finansiniai lūkesčiai, kita informacija'),
        11 => array()
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function studies()
    {
        return $this->hasMany('App\CvStudy');
    }

    public function practices()
    {
        return $this->hasMany('App\CvPractice');
    }

    public function works()
    {
        return $this->hasMany('App\CvWork');
    }

    public function experiences()
    {
        return $this->hasMany('App\CvExperience');
    }

    public function languages()
    {
        return $this->hasMany('App\CvLanguage');
    }

    public function itknowledges()
    {
        return $this->hasMany('App\CvItKnowledge');
    }

    public function characteristics()
    {
        return $this->hasMany('App\CvCharacteristic');
    }

    public function interests()
    {
        return $this->hasMany('App\CvInterest');
    }

    public function socactivities()
    {
        return $this->hasMany('App\CvSocactivity');
    }

    public function participations()
    {
        return $this->hasMany('App\CvParticipation');
    }

    public function recomendations()
    {
        return $this->hasMany('App\CvRecomendation');
    }

    public function extrainfos()
    {
        return $this->hasMany('App\CvExtraInfo');

    }

    public function documents()
    {
        return $this->hasMany('App\CvDocument');

    }

    public function comments()
    {
        return $this->hasMany('App\CvComment')->latest();

    }

    public function saves()
    {
        return $this->hasMany('App\CvSave');
    }

    public static function getValidCvs($filter=null, $limit=50)
    {
        $cvs = Cv::valid();

        if (isset($filter['cvOrder']) && $filter['cvOrder'] == 'oldest') {
            $cvs->orderBy('updated_at', 'asc');
        } else {
            $cvs->orderBy('updated_at', 'desc');
        }

        if (!empty($filter['cities'][0]))
        {
            $cvs->ofCities($filter['cities']);
        }

        if (!empty($filter['scopes'][0]))
        {
            $cvs->ofScopes($filter['scopes']);
        }

        if (!empty($filter['institutions'][0]))
        {
            $cvs->ofInstitutions($filter['institutions']);
        }

        if (!empty($filter['courses'][0]))
        {
            $cvs->ofCourses($filter['courses']);
        }

        if (!empty($filter['age']))
        {
            $cvs->ofAge($filter['age_from'], $filter['age_to']);
        }

        if (!empty($filter['gender']))
        {
            $cvs->ofGender($filter['gender']);
        }

        if (!empty($filter['tag']))
        {
            $cvs->ofTag($filter['tag']);
        }

        return $cvs->paginate($limit);
    }

    public static function getInactiveCvs($filter=null, $limit=50)
    {
        $cvs = Cv::inactive()->orderBy('created_at', 'desc');

        return $cvs->paginate($limit);
    }

    public function scopeValid($query)
    {
        return $query->where('state', 0)->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('state', 0)->where('active', 0);
    }

    public function scopeOfScopes($query, $scopes)
    {
        return $query->whereHas('studies', function($q) use ($scopes) {
            $q->whereIn('study_scope_id', $scopes);
        });
    }

    public function scopeOfInstitutions($query, $institutions)
    {
        return $query->whereHas('studies', function($q) use ($institutions) {
            $q->whereIn('institution_id', $institutions);
        });
    }

    public function scopeOfCourses($query, $courses)
    {
        return $query->whereHas('studies', function($q) use ($courses) {
            $q->where(function ($q) use ($courses) {
                foreach ($courses as $c) {
                    $q->orWhere(function ($q) use ($c) {
                        $data = explode('_', $c);
                        $courseId = array_shift($data);
                        $q->whereIn('study_grade_id', $data);
                        $q->where('study_course', $courseId);
                    });
                }
            });
        });
    }

    public function scopeOfCities($query, $cities)
    {
        foreach ($cities as $k => $c) {
            if ($c == '') unset($cities[$k]);
        }

        return $query->where(function ($query) use ($cities) {
            $query->whereIn('practice_city_id', $cities)->orWhereIn('job_city_id', $cities);
        });
    }

    public function scopeOfAge($query, $from, $to)
    {
        return $query->whereBetween(\DB::raw('TIMESTAMPDIFF(YEAR,birthday,CURDATE())'),array($from, $to));
    }

    public function scopeOfGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeOfTag($query, $tag)
    {
        if (strpos($tag, ',') !== false) {
           $tags = explode(',', $tag);
        } else {
            $tags = explode(' ', $tag);
        }

        for ($i = 0; $i < 3; ++$i) {
            if (isset($tags[$i])) {
                if ($i == 0)
                    $query->where('cv_tag', 'like', trim($tags[$i]).'%');
                else
                    $query->orWhere('cv_tag', 'like', trim($tags[$i]).'%');
            }
        }

        return $query;
    }

    public function scopeSaved($query, $userId)
    {
        return $query->whereHas('saves', function($q) use ($userId)
        {
            $q->where('user_id', $userId);
        });
    }

    public static function getUserCv($cvId, $state = null)
    {
        $cv = CV::findOrFail($cvId);

        if (!$cv) {
            abort(404);
        }

        if ($cv->user_id == \Auth::user()->id || \Auth::user()->isAdmin() || \Auth::user()->isWorker()) {

            if ($state !== null) {
                if ($cv->state != $state) {
                    abort(404);
                }
            }

            return $cv;
        }

        abort(404);
    }

    public static function filter()
    {
        $filterItems = array('cvType', 'cities', 'scopes', 'institutions', 'courses', 'age', 'gender', 'tag', 'cvOrder');
        $filter = array();

        $session = session('cvFilter');

        foreach ($filterItems as $item)
        {
            //$val = (Input::exists($item)) ? Input::get($item) : (!empty($session[$item]) ? $session[$item] : null);
            $val = (request()->has($item)) ? request()->get($item) :  null;

            if ($val)
            {
                $filter[$item] = $val;
                if ($item == 'age') {
                    list($filter['age_from'], $filter['age_to']) = explode('-', $val);
                }
            }
        }

        //session(['cvFilter' => $filter]);

        return $filter;
    }

    public function Photos()
    {
        return new CvPhoto($this);
    }

    public function cvDocument()
    {
        return new CvDocument($this);
    }

    public function saveCv($cv, $request)
    {
        $data = $request->all();

        if ($request->file('photo') && $request->file('photo')->isValid())
        {
            $photo = new CvPhoto($cv);
            $data['photo'] = $photo->uploadPhoto($request->file('photo'));
        }

        $cv->update($data);

        return true;
    }

    public function updateCv($request)
    {
        $currentState = $this->currentState();

        switch ($currentState) {
            case 2:
                $model = 'App\Cv'; break;
            case 3:
                $model = 'App\CvStudy'; break;
            case 4:
                $model = 'App\CvWork'; break;
            //case 5: $model = 'App\CvExperience'; break;
            case 5:
                $model = 'App\CvLanguage'; break;
            case 6:
                $model = 'App\CvItKnowledge'; break;
            case 7:
                $model = 'App\CvCharacteristic'; break;
            case 8:
                $model = 'App\CvParticipation'; break;
            case 9:
                $model = 'App\CvRecomendation'; break;
            case 10:
                $model = 'App\CvExtraInfo';
                break;
            case 11:
                if ($this->state != 0) {
                    $this->active = 1;
                    $this->state = 0;
                    $this->save();
                    /*
                    $admins = User::workersadmins()->get();
                    foreach ($admins as $a) {
                        \Mail::send('emails.newUser', ['cv' => $this], function ($message) use ($a) {
                            $message->to($a->email)->subject('cv.personaloakademija.lt sukurtas naujas CV');
                        });
                    }*/
                }
                return redirect()->route('cv_show', $this->id);
            default:
                $model = 'App\Cv';
                break;
        }

        if (isset($model)) {
            $obj = new $model;
            $status = $obj->saveCv($this, $request);
        }


        if ($status && $this->state != 0 && $currentState > $this->state) {
            $nextState = $this->nextState();
            $this->state = ($nextState - 1);
            $this->save();
        }

        return $status;
    }

    public function stateHandle()
    {
        $currentState = $this->currentState();
        $states = $this->getStates();
        // leisti redaguoti tik tą stadiją, kuri jau buvo užpildyta (state == 0 - cv užpildytas iki galo)

        if (!$this->isActiveState($currentState)) {
            abort(404);
        }

        if (!isset($states[$currentState])) {
            abort(404);
        }

        switch ($currentState)
        {
            case 2:
                $html = $this->cvInfo(); break;
            case 3:
                $html = $this->cvStudies(); break;
            case 4:
                $html = $this->cvWorks(); break;
            case 5:
                $html = $this->cvLanguages(); break;
            case 6:
                $html = $this->cvItKnowledges(); break;
            case 7:
                $html = $this->cvCharacteristics(); break;
            case 8:
                $html = $this->cvParticipations(); break;
            case 9:
                $html = $this->cvRecomendations(); break;
            case 10:
                $html = $this->cvExtraInfos(); break;
            case 11:
                $html = $this->cvFinish(); break;
            default:
                $html = $this->personal();
        }

        return $html;
    }

    private function personal()
    {
        $genders = Gender::getGendersList();
        $cities = City::getCitiesList();
        $statuses = Cv::getStatusesList();

        return $this->_view('formPersonal', [
            'cv' => $this,
            'genders' => $genders,
            'cities' => $cities,
            'statuses' => $statuses
        ]);
    }

    private function cvInfo()
    {
        return $this->_view('formCvInfo', [
            'cv' => $this,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvStudies()
    {
        if (\Request::input('removeStudy'))
        {
            $item = CvStudy::findOrFail(\Request::input('removeStudy'));
            $item->delete();
        }

        $cvStudies = $this->studies()->get();

        if (!$cvStudies->count())
        {
            $cvStudies[0] = new CvStudy;
        }

        $institutions = InstitutionCategory::getGroupedList();
        //$scopes = WorkScope::getScopesList(array(null=>'-- Pasirinkti --'));
        $grades = StudyGrade::getGradesList();
        $courses = CvStudy::getCoursesList();
        $forms = CvStudy::getFormsList();
        $yearsFrom = CvStudy::getStudyYearsFromList();
        $yearsTo = CvStudy::getStudyYearsToList();

        return $this->_view('formStudies', [
            'cv' => $this,
            'institutions' => $institutions,
            //'scopes' => $scopes,
            'grades' => $grades,
            'courses' => $courses,
            'forms' => $forms,
            'yearsFrom' => $yearsFrom,
            'yearsTo' => $yearsTo,
            'data' => $cvStudies,
            'currentState' => $this->currentState(),
        ]);
    }

    private function cvWorks()
    {
        if (request()->get('removeExperience')) {
            $item = CvExperience::find(request()->get('removeExperience'));
            if ($item) {
                $item->delete();
            }
        }

        $cvWorks = $this->works()->get();

        if (!$cvWorks->count()) {
            $cvWorks[0] = new CvWork;
        }

        $scopes = WorkScope::getScopesList(false);
        $cities = City::getCitiesList(null);

        $cvExperiences = $this->experiences()->get();

        if (!$cvExperiences->count()) {
            $cvExperiences[0] = new CvExperience;
        }

        $workYearsFrom = Year::getYearsList((new \Carbon('-15 year'))->year, \Carbon::now()->year);
        $workYearsTo = Year::getYearsList(\Carbon::now()->year,
            (new \Carbon('-15 year'))->year,
            array(null=>'metai', 0=>'Dabar'));

        $months = Month::getMonthsList();

        return $this->_view('formWorks', [
            'cv' => $this,
            'scopes' => $scopes,
            'cities' => $cities,
            'works' => $cvWorks,
            'workYearsFrom' => $workYearsFrom,
            'workYearsTo' => $workYearsTo,
            'months' => $months,
            'experiences' => $cvExperiences,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvLanguages()
    {
        if (\Request::input('removeLang')) {
            $item = CvLanguage::find(\Request::input('removeLang'));
            if ($item) {
                $item->delete();
            }
        }

        $cvLanguages = $this->languages()->get();

        if (!$cvLanguages->count()) {
            $cvLanguages[0] = new CvLanguage;
        }

        $languages = Language::getLanguagesList();
        $languageLevels = CvLanguage::getLevelsList();

        return $this->_view('formLanguages', [
            'cv' => $this,
            'languageLevels' => $languageLevels,
            'languages' => $languages,
            'data' => $cvLanguages,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvItKnowledges()
    {
        $categories = ItKnowledgeCategory::getCategories();
        $knowledgeLevels = CvItKnowledge::getLevelsList();

        $knowledges = $this->itknowledges()->pluck('knowledge_level', 'knowledge_id');
        $_anothers = $this->itknowledges()->where('knowledge_name', '!=', '')->get();

        $anothers = array();
        foreach ($_anothers as $a)
        {
            $anothers[$a->category_id] = $a;
        }

        return $this->_view('formItKnowledges', [
            'cv' => $this,
            'categories' => $categories,
            'knowledgeLevels' => $knowledgeLevels,
            'knowledges' => $knowledges,
            'anothers' => $anothers,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvCharacteristics()
    {
        $cvCharacteristics = $this->characteristics()->first();
        $data['characteristics'] = ($cvCharacteristics) ? $cvCharacteristics : new CvCharacteristic;

        $cvInterests = $this->interests()->first();
        $data['interests'] = ($cvInterests) ? $cvInterests : new CvInterest;

        $cvSocactivities = $this->socactivities()->first();
        $data['socactivities'] = ($cvSocactivities) ? $cvSocactivities : new CvSocactivity;

        return $this->_view('formCharacteristics', ['cv' => $this,
                                                    'data' => $data,
                                                    'currentState' => $this->currentState()
        ]);
    }

    private function cvParticipations()
    {
        if (\Request::input('removeParticipation'))
        {
            $item = CvParticipation::findOrFail(\Request::input('removeParticipation'));
            $item->delete();
        }

        $cvParticipations = $this->participations()->get();

        if (!$cvParticipations->count())
        {
            $cvParticipations[0] = new CvParticipation;
        }

        $types = CvParticipation::getTypesList();
        $years = CvParticipation::getYearsList();

        return $this->_view('formParticipations', ['cv' => $this,
                                                   'types' => $types,
                                                   'years' => $years,
                                                   'data' => $cvParticipations,
                                                   'currentState' => $this->currentState()
        ]);
    }

    private function cvRecomendations()
    {
        if (\Request::input('removeRecomendation'))
        {
            $item = CvRecomendation::findOrFail(\Request::input('removeRecomendation'));
            $item->delete();
        }

        $cvRecomendations = $this->recomendations()->get();

        if (!$cvRecomendations->count())
        {
            $cvRecomendations[0] = new CvRecomendation;
        }

        $types = CvRecomendation::getTypesList();
        $years = CvRecomendation::getYearsList();

        return $this->_view('formRecomendations', [
            'cv' => $this,
            'types' => $types,
            'years' => $years,
            'data' => $cvRecomendations,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvExtraInfos()
    {
        $extrainfo = $this->extrainfos()->first();

        if (!$extrainfo) {
            $extrainfo = new CvExtraInfo;
        }

        return $this->_view('formExtraInfo', [
            'cv' => $this,
            'extrainfo' => $extrainfo,
            'drivingLicenses' => CvExtraInfo::getDrivingLicenses(),
            'documents' => $this->documents,
            'currentState' => $this->currentState()
        ]);
    }

    private function cvFinish()
    {
        return $this->_view('cvFinish', ['cv' => $this]);
    }

    private function _view($template, $data)
    {
        $data['states'] = $this->getStates();
        $data['state'] = $this->currentState();
        $data['backLink'] = '';
        $data['submitBtnName'] = 'Išsaugoti ir toliau';

        if ($data['cv']->state == 0) {
            $data['backLink'] = '<a href="' . route("cv_show", ['id' => $data['cv']->id]) .'#section'.$this->currentState().'" class="btn btn-default btn-xs">
                                 <span aria-hidden="true" class="glyphicon glyphicon-menu-left"></span> Atgal</a>';

            $data['submitBtnName'] = 'Išsaugoti';
        } elseif (Route::input('state') > 1) {
            $prevState = $this->prevState();

            $data['backLink'] = '<a href="' . route("cv_edit", ['id' => $data['cv']->id, 'state' => $prevState]) .'" class="btn btn-default btn-xs">
                                 <span aria-hidden="true" class="glyphicon glyphicon-menu-left"></span> Atgal</a>';
        }

        return view('cv.partials.'.$template, $data)->render();
    }

    public function currentState()
    {

        $state = Route::input('state') ? Route::input('state') : 1;

        return $state;
    }

    public function getStates()
    {
        $states = self::$cvStates;

        return $states;
    }

    public function nextState()
    {
        $states = array_keys($this->getStates());
        $currentState = $this->currentState();

        $next = array_first($states, function($key, $value) use ($currentState)
        {
            return $value > $currentState;
        });

        return $next;
    }

    public function prevState()
    {
        $states = array_keys($this->getStates());
        $currentState = $this->currentState();

        $state = array_last($states, function($key, $value) use ($currentState)
        {
            return $value < $currentState;
        });

        return $state;
    }

    public function isActiveState($state)
    {
        if ($this->state != 0 && $this->state < ($state-1)) {
            return false;
        }

        return true;
    }

    public static function getStatuses()
    {
        $statuses = ['active' => 'Aktyvus (gauti el. paštu naujus darbo pasiūlymus)',
                     'passive' => 'Pasyvus (negauti el. paštu naujų darbo pasiūlymų)'];

        return $statuses;
    }

    public static function getStatusesList()
    {
        return self::getStatuses();
    }

    public function isPassive()
    {
        if(\Request::get('token') && \Request::get('token') == $this->token) {
            return false;
        }

        if ((\Auth::check() && \Auth::user()->isAdmin()) ||
            (\Auth::check() && $this->user_id == \Auth::user()->id)) {
            return false;
        }

        if (!\Auth::check()) {
            return false;
        }

        if ($this->cv_status == 'passive') {
            return true;
        }

        return false;
    }

    public function getCvFullnameAttribute()
    {
        return ($this->attributes['cv_name']) ? $this->attributes['cv_name'] : 'Be pavadinimo';
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

    public function getPracticeCityAttribute()
    {
        if ($this->practice_city_id)
        {
            $cities = City::getCitiesList();
            return isset($cities[$this->practice_city_id]) ? $cities[$this->practice_city_id] : '';
        }

        return '';
    }

    public function getJobCityAttribute()
    {
        if ($this->job_city_id)
        {
            $cities = City::getCitiesList();
            return isset($cities[$this->job_city_id]) ? $cities[$this->job_city_id] : '';
        }

        return '';
    }

    public function getCityAttribute()
    {
        if ($this->practice_city)
        {
            return $this->practice_city;
        }

        if ($this->job_city)
        {
            return $this->job_city;
        }
    }

    public function getStatusNameAttribute()
    {
        $statuses = Cv::getStatusesList();

        return isset($statuses[$this->cv_status]) ? $statuses[$this->cv_status] : '';
    }

    public function getBirthdayAttribute($date)
    {
        if ($date)
        {
            return \Carbon::parse($date)->format('Y-m-d');
        }
    }

    public function getAgeAttribute()
    {
        return \Carbon::parse($this->birthday)->age;
    }

    public function getTokenAttribute() {
        return md5('cv'.$this->id);
    }
}
