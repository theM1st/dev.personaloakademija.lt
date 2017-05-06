<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvLanguage extends Model {

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
        if (!$request->get('skip')) {
            $data = $request->all();

            foreach ($data['foreign_language_id'] as $k => $langId) {
                if (!empty($data['id'][$k])) {
                    $item = self::find($data['id'][$k]);
                } else {
                    $item = new CvLanguage;
                }

                if ($k == 0) {
                    $item->first_language_id = $data['first_language_id'];

                    if ($item->first_language_id == 100) {
                        $item->first_language_value = $data['first_language_value'];
                    } else {
                        $item->first_language_value = null;
                    }
                }

                $item->foreign_language_id = $data['foreign_language_id'][$k];

                if ($item->foreign_language_id == 100) {
                    $item->foreign_language_value = $data['foreign_language_value'][$k];
                } else {
                    $item->foreign_language_value = null;
                }

                $item->understanding_level = $data['understanding_level'][$k];
                $item->speaking_level = $data['speaking_level'][$k];
                $item->reading_level = $data['reading_level'][$k];
                $item->writing_level = $data['writing_level'][$k];

                $cv->languages()->save($item);
            }
        }

        return true;
    }

    public static function getLevels()
    {
        $data = ['A1'=>'A1', 'A2'=>'A2', 'B1'=>'B1', 'B2'=>'B2', 'C1'=>'C1', 'C2'=>'C2'];

        return $data;
    }

    public static function getLevelsList($prepend = array(null=>'Lygis'))
    {
        $data = $prepend;
        $data += self::getLevels();

        return $data;
    }

    public function getFirstLanguageNameAttribute()
    {
        if ($this->first_language_id)
        {
            $data = Language::getLanguages();
            return isset($data[$this->first_language_id]) ? $data[$this->first_language_id] : '';
        }

        return '';
    }

    public function getForeignLanguageNameAttribute()
    {
        if ($this->foreign_language_id)
        {
            $data = Language::getLanguages();
            return isset($data[$this->foreign_language_id]) ? $data[$this->foreign_language_id] : '';
        }

        return '';
    }
}
