<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;
use App\Http\Requests\Admin\SlideshowRequest;
use App\Slideshow;

class SlideshowController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $slideshows = Slideshow::all();

        return $this->viewPath('index', [ 'slideshows' => $slideshows ]);
    }

    public function create()
    {
        return $this->viewPath('create', []);
    }

    public function store(SlideshowRequest $request)
    {
        return $this->createFlashRedirect(Slideshow::class, $request, 'image');
    }

    public function edit(Slideshow $slideshow)
    {
        return $this->viewPath('edit', [
            'slideshow' => $slideshow,
        ]);
    }

    public function update(Slideshow $slideshow, SlideshowRequest $request)
    {
        return $this->saveFlashRedirect($slideshow, $request, 'image');
    }

    public function destroy(Slideshow $slideshow)
    {
        return $this->destroyFlashRedirect($slideshow);
    }
}

