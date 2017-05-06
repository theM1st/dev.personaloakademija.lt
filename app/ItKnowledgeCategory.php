<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ItKnowledgeCategory extends Model {

    public function knowledges()
    {
        return $this->hasMany('App\ItKnowledge', 'category_id')->orderBy('position', 'asc')->get();
    }

    public static function getCategories()
    {
        $data = \Cache::remember('ItKnowledgeCategory.getCategories', 60, function(){
            return self::orderBy('position', 'asc')->orderBy(self::getNameField())->get();
        });

        return $data;
    }

    public static function getNameField()
    {
        return 'name_'.\Lang::getLocale();
    }

    public function getNameAttribute()
    {
        return $this->{'name_'.\Lang::getLocale()};
    }
}
