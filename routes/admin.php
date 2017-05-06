<?php

Route::get('/', ['as' => 'root', 'uses' => 'DashboardController@index']);
Route::resource('page', 'PageController');
Route::get('page/{page}/move/{position}', 'PageController@move')
    ->name('page.move')->where(['position' => '[0-9]+']);
Route::resource('slideshow', 'SlideshowController');