<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;

class DashboardController extends AdminController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->model = 'Page';
        return $this->redirectRoutePath('index');
    }
}
