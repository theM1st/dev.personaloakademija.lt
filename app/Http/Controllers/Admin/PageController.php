<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;
use App\Http\Requests\Admin\PageRequest;
use App\Page;

class PageController extends AdminController
{
    public function index()
    {
        $pages = Page::all()->toHierarchy();

        return $this->viewPath('index', [ 'pages' => $pages ]);
    }

    public function create()
    {
        return $this->viewPath('create', [
            'pages' => Page::getNestedList('title_lt', null, '- ')
        ]);
    }

    public function store(PageRequest $request)
    {
        $page = Page::find($request->get('parent_id'));

        if ($model = $this->createFlash(Page::class, $request)) {
            if ($page) {
                $model->makeChildOf($page);
            }
        }
        return $this->redirectRoutePath();
    }

    public function edit(Page $page)
    {
        return $this->viewPath('edit', [
            'page' => $page,
            'pages' => Page::getNestedList('title_lt', null, '- ')
        ]);
    }

    public function update(Page $page, PageRequest $request)
    {
        $parent = Page::find($request->get('parent_id'));

        $this->saveFlash($page, $request);

        if (!$parent && !$page->isRoot()) {
            $page->makeRoot();
        } elseif ($parent) {
            $page->makeChildOf($parent);
        }

        return $this->redirectRoutePath();
    }

    public function destroy(Page $page)
    {
        return $this->destroyFlashRedirect($page);
    }

    public function move(Page $page, $position)
    {
        $siblings = $page->getSiblingsAndSelf();

        if (!isset($siblings[$position])) {
            abort(404);
        }

        if ($page->lft > $siblings[$position]->lft) {
            return $page->moveToLeftOf($siblings[$position]);
        } else {
            return $page->moveToRightOf($siblings[$position]);
        }
    }
}
