<?php

namespace App;

use Baum\Node;


class Page extends Node
{
    /**
     * @var array
     */
    protected $fillable = [
        'title_lt', 'title_en', 'title_ru',
        'content_lt', 'content_en', 'content_ru',
        'description_lt', 'description_en', 'description_ru',
        'link_lt', 'link_en', 'link_ru',
        'active', 'menu', 'main_page'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeMenu($query)
    {
        return $query->where('menu', 1);
    }

    public function getTitleAttribute()
    {
        return $this->{'title_'.\Lang::getLocale()};
    }

    public function getSlugAttribute()
    {
        return $this->{'slug_'.\Lang::getLocale()};
    }

    public function getContentAttribute()
    {
        return $this->{'content_'.\Lang::getLocale()};
    }

    public function getLinkAttribute()
    {
        return $this->{'link_'.\Lang::getLocale()};
    }
}