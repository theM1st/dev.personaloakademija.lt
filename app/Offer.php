<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Offer extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    protected $dates = ['offer_valid_from', 'offer_valid_until', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','offer_duration', 'work_position', 'offer_type', 'language', 'offer_valid_from', 'offer_valid_until',
                           'company_name', 'company_description', 'offer_description', 'offer_requirements', 'offer_skills',
                           'company_offers', 'show_company_info', 'recruitment', 'recruitment_days', 'salary_from',
                           'salary_to', 'confidentiality', 'active', 'offer_image', 'offer_form', 'cv_receive_email'];

    public static $languages = [
        'lt' => 'Lietuvių',
        'en' => 'Anglų',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logo()
    {
        return $this->hasOne('App\OfferLogo');
    }

    public function scopes()
    {
        return $this->belongsToMany('App\WorkScope', 'offer_scopes', 'offer_id', 'scope_id');
    }

    public function cities()
    {
        return $this->belongsToMany('App\City', 'offer_cities', 'offer_id', 'city_id');
    }

    public function candidates()
    {
        return $this->hasMany('App\Candidate')->orderBy('updated_at', 'desc');
    }

    public static function getDurations()
    {
        $durations = [7 => '7 d. (iki ' . \Carbon::now()->addDays(7)->format('Y-m-d') . ')',
                      14 => '14 d. (iki ' . \Carbon::now()->addDays(14)->format('Y-m-d') . ')',
                      21 => '21 d. (iki ' . \Carbon::now()->addDays(21)->format('Y-m-d') . ')',
                      30 => '30 d. (iki ' . \Carbon::now()->addDays(30)->format('Y-m-d') . ')'];

        return $durations;
    }

    public static function getDurationsList($prepend = array())
    {
        $data = $prepend;
        $data += self::getDurations();

        return $data;
    }

    public static function getOffers($filter = null, $limit=100)
    {
        $offers = Offer::orderBy('active', 'desc');

        if (!empty($filter['offerOrder'])) {
            if ($filter['offerOrder'] == 'recent') {
                $offers = $offers->orderBy('offer_valid_from', 'desc');
            }

            if ($filter['offerOrder'] == 'oldest') {
                $offers = $offers->orderBy('offer_valid_from', 'asc');
            }
        } else {
            $offers = $offers->orderBy('recruitment', 'desc')->orderBy('offer_valid_from', 'desc');
        }

        if (isset($filter['offerType']) && $filter['offerType'] == 'hot') {
            $offers->where('recruitment', 'soon');
        }

        if (!empty($filter['tag'])) {
            $offers->ofTag($filter['tag']);
        }

        if (!empty($filter['cities'][0])) {
            $offers->ofCities($filter['cities']);
        }

        if (!empty($filter['scopes'][0])) {
            $offers->ofScopes($filter['scopes']);
        }

        return $offers->paginate($limit);
    }

    public static function getValidOffers($filter=null, $limit=50)
    {

        if (!empty($filter['offerOrder'])) {
            if ($filter['offerOrder'] == 'recent') {
                $offers = Offer::valid()->orderBy('offer_valid_from', 'desc');
            }

            if ($filter['offerOrder'] == 'oldest') {
                $offers = Offer::valid()->orderBy('offer_valid_from', 'asc');
            }
        } else {
            $offers = Offer::valid()->orderBy('recruitment', 'desc')->orderBy('offer_valid_from', 'desc');
        }

        if (isset($filter['offerType']) && $filter['offerType'] == 'hot') {
            $offers->where('recruitment', 'soon');
        }

        if (!empty($filter['tag'])) {
            $offers->ofTag($filter['tag']);
        }

        if (!empty($filter['cities'][0])) {
            $offers->ofCities($filter['cities']);
        }

        if (!empty($filter['scopes'][0])) {
            $offers->ofScopes($filter['scopes']);
        }

        //$sql = $offers->toSql();
        //dd($sql);

        return $offers->paginate($limit);
    }
    
    public static function updateOfferToInvalid()
    {
        Offer::invalid()->update(['active' => 0]);
    }

    public static function filter()
    {
        $filterItems = array('offerOrder', 'offerType', 'cities', 'scopes', 'tag');
        $filter = array();

        $session = session('offerFilter');

        foreach ($filterItems as $item) {
            //$val = (Input::exists($item)) ? Input::get($item) : (!empty($session[$item]) ? $session[$item] : null);
            $val = (Input::exists($item)) ? Input::get($item) :  null;

            if ($val) {
                $filter[$item] = $val;
            }
        }

        //session(['offerFilter' => $filter]);

        return $filter;
    }

    public function scopeValid($query)
    {
        return $query->where('offer_valid_until', '>', date('y-m-d'))->where('archived', 0)->where('active', 1);
    }

    public function scopeInvalid($query)
    {
        //return $query->where('offer_valid_until', '<', date('y-m-d'))->orWhere('archived', 1);
        return $query->where(function($query) {
            $query->where('offer_valid_until', '<', date('y-m-d'));
            $query->where('active', 1);
        });
    }

    public function scopeOfCities($query, $cities)
    {
        $query->whereHas('cities', function($q) use($cities) {
            $q->whereIn('city_id', $cities);
        });
    }

    public function scopeOfScopes($query, $scopes)
    {
        $query->whereHas('scopes', function($q) use($scopes) {
            $q->whereIn('scope_id', $scopes);
        });
    }

    public function scopeOfTag($query, $tag)
    {
        return $query->where('work_position', 'like', '%'.$tag.'%')
            ->orWhere('offer_description', 'like', '%'.$tag.'%');
    }

    public function uploadLogo($file)
    {
        $this->logo()->delete();
        $logo = new OfferLogo();
        $this->logo()->save($logo);
        $logo->upload($file);
        return $logo->id;
    }

    public function setOfferDurationAttribute($value)
    {
        if (!$this->id) {
            $this->attributes['offer_valid_from'] = \Carbon::now()->format('Y-m-d H:m:s');
        }
        
        $this->attributes['offer_valid_until'] = \Carbon::now()->addDays($value)->format('Y-m-d 23:59:00');

        $this->attributes['offer_duration'] = $value;
    }

    public function setRecruitmentAttribute($value)
    {
        if ($value == '') {
            $this->attributes['recruitment'] = null;
        } else {
            $this->attributes['recruitment'] = $value;
        }
    }

    public function setSalaryFromAttribute($number)
    {
        $this->attributes['salary_from'] = !empty($number) ? $number : null;
    }

    public function setSalaryToAttribute($number)
    {
        $this->attributes['salary_to'] = !empty($number) ? $number : null;
    }
}
