<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CvItKnowledge extends Model {

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

    public function category()
    {
        return $this->belongsTo('App\ItKnowledgeCategory', 'category_id');
    }

    public function knowledge()
    {
        return $this->belongsTo('App\ItKnowledge', 'knowledge_id');
    }

    public function saveCv($cv, $request)
    {
        $categories = ItKnowledgeCategory::getCategories();

        $cv->itknowledges()->delete();

        foreach ($categories as $c)
        {
            if (!empty($request->get('knowledge')[$c->id]))
            {
                foreach ($request->get('knowledge')[$c->id] as $knowledgeId => $val)
                {
                    $cvItKnowledge = new CvItKnowledge;
                    $cvItKnowledge->cv_id = $cv->id;
                    $cvItKnowledge->category_id = $c->id;
                    $cvItKnowledge->knowledge_id = $knowledgeId;
                    $cvItKnowledge->knowledge_level = $request->get('knowledge_level')[$c->id][$knowledgeId];
                    $cvItKnowledge->save();
                }

                if ($request->get('another')[$c->id])
                {
                    $cvItKnowledge = new CvItKnowledge;
                    $cvItKnowledge->cv_id = $cv->id;
                    $cvItKnowledge->category_id = $c->id;
                    $cvItKnowledge->knowledge_name = $request->get('another')[$c->id];
                    if (isset($request->get('another_level')[$c->id]))
                    {
                        $cvItKnowledge->knowledge_level = $request->get('another_level')[$c->id];
                    }
                    $cvItKnowledge->save();
                }
            }
        }

        return true;
    }

    public static function getLevels()
    {
        $data = [1=>'Pradinis lygis', 2=>'Patenkinamas lygis', 3=>'Vidutinis lygis', 4=>'Specialisto lygis', 5=>'Eksperto lygis'];

        return $data;
    }


    public static function getLevelsList($prepend = array(null=>'-- Lygis --'))
    {
        $data = $prepend;
        $data += self::getLevels();

        return $data;
    }

    public static function groupedItems(CV $cv)
    {
        $data = $cv->itknowledges()->orderBy('category_id')->orderBy('id')->get();

        $knowledges = array();
        foreach ($data as $item)
        {
            $items[$item->category_id][] = $item;

            $knowledges[$item->category_id] = array('category' => $item->category,
                                                    'knowledges' => $items[$item->category_id]);
        }

        return $knowledges;
    }

    public function getLevelNameAttribute()
    {
        if ($this->knowledge_level)
        {
            $data = self::getLevels();
            return isset($data[$this->knowledge_level]) ? $data[$this->knowledge_level] : '';
        }

        return '';
    }
}
