<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Page;
use App\Slideshow;

class NavigationComposer
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
        /*$data['navigation'] = \Cache::remember('navigation', 60, function() {
            $pages = \DB::table('pardavim_pus.dizark_pages')->where('language', 'lt')
                ->orderBy('sort_order', 'desc')
                ->get();

            return $this->getNavigation(0, 0, $pages, '', array(1), true, 'nav');
        });*/

        $pages = \Cache::remember('navigation', 60, function() {
            return Page::active()->menu()->get()->toHierarchy();
        });
/*
        $pages = \DB::table('pardavim_pus.dizark_pages')->where('language', 'lt')
            ->orderBy('sort_order', 'desc')
            ->get();
*/

        //$data['navigation'] =  $this->getNavigation(0, 0, $pages, '', array(1), true, 'nav');

        $navigation = '<ul class="nav navbar-nav">';
        foreach ($pages as $node) {
            $navigation .= $this->getNavigation2($node);
        }
        $navigation .= '</ul>';

        $data['navigation'] = $navigation;

        $data['slideshow'] = $this->getSlideshow();

        $view->with($data);
    }

    private function getNavigation2($node)
    {
        $link = ($node->link ? $node->link : route('page.show', $node->slug));

        if ( $node->isLeaf() ) {
            return '<li><a href="'.$link.'">'.$node->title.'</a></li>';
        } else {
            $html = '<li>';
            $html .= '<a href="'.$link.'"'.($node->children ? ' class="dropdown-toggle" data-toggle="dropdown"' : '').'>'.$node->title.'</a>';
            if ($node->children) {
                $html .= '<ul class="dropdown-menu">';

                foreach ($node->children as $child) {
                    $html .= $this->getNavigation2($child);
                }
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
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

    private function getSlideshow()
    {
        $slides = \Cache::remember('slideshow', 60, function() {
            return Slideshow::all();
        });

        return $slides;
    }
}