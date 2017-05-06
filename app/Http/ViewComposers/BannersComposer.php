<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Banner;

class BannersComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data['leftBanners'] = \Cache::rememberForever('leftBanners', function() {
            return Banner::where('banner_zone', 'left')->orderBy('banner_order')->get();
        });

        $data['rightBanners'] = \Cache::rememberForever('rightBanners', function() {
            return Banner::where('banner_zone', 'right')->orderBy('banner_order')->get();
        });

        $view->with($data);
    }

    private function getNavigation($parent, $level=0, $pages, $pageUrl, $places, $ifLangauges, $ulclass)
    {
        $ul = '<ul class="'.$ulclass.'">';
        $return = null;
        $n = 1;
        foreach ($pages as $page) {
            if ($parent == $page->parent_id && in_array($page->position, $places) && $page->active == 1) {

                $link = 'http://www.personaloakademija.lt/' . $page->language . '/' . $page->url;

                $submenu = $this->getNavigation($page->id, ($level + 1), $pages, $pageUrl, $places, $ifLangauges, $ulclass='dropdown-menu');

                $return .= '<li>';
                $return .= '<a href="'.$link.'"'.($submenu ? ' class="dropdown-toggle" data-toggle="dropdown"' : '').'>'.$page->name.'</a>';
                $return .= $submenu;
                $return .= '</li>';
                ++$n;
            }
        }

        if ($return != null) {
            $ul .= $return;
            $ul .= '</ul>';
            return $ul;
        } else {
            return null;
        }
    }

    private function getSlideshow($language='lt')
    {
        $slides = \DB::table('pardavim_pus.dizark_slideshow')->where('language', $language)
            ->orderBy('sort_order', 'desc')
            ->get();

        return $slides;
    }
}