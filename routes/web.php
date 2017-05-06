<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::auth();

Route::group(['prefix' => 'darbo-pasiulymai'], function () {
    Route::get('/{offer_type?}',  ['as' => 'offers_index', 'uses' => 'OffersController@index']);
});

Route::group(['prefix' => 'darbo-pasiulymas'], function () {

    Route::get('{id}', ['as' => 'offers_show', 'uses' => 'OffersController@show']);
    Route::match(['put', 'post'], 'perziura', ['uses' => 'OffersController@preview']);

    Route::get('{offerId}/kandidatavimas', ['uses' => 'CandidatesController@apply']);
    Route::post('{offerId}/kandidatuoti', ['uses' => 'CandidatesController@postApply']);
    Route::get('{offerId}/kandidatuoti', ['uses' => 'CandidatesController@store', 'middleware' => ['auth']]);
    Route::get('{offerId}/kandidatai', ['uses' => 'CandidatesController@index', 'middleware' => ['auth', 'admin']]);
});

Route::get('cv-katalogas', ['as' => 'cv_index', 'uses' => 'CvController@index', 'middleware' => ['auth', 'worker']]);

Route::group(['prefix' => 'cv', 'middleware' => 'auth'], function () {
    Route::get('kurimas', ['as' => 'cv_create', 'uses' => 'CvController@create', 'middleware' => ['cvActive']]);
    Route::post('kurimas', ['uses' => 'CvController@store', 'middleware' => 'cvActive']);

    Route::get('{id}/edit/{state?}', ['as' => 'cv_edit', 'uses' => 'CvController@edit']);
    Route::post('{id}/edit/{state?}', ['uses' => 'CvController@update']);

    Route::get('{id}', ['as' => 'cv_show', 'uses' => 'CvController@show']);

    Route::get('{id}/perziura', ['as' => 'cv_preview', 'uses' => 'CvController@preview']);

    Route::get('{id}/skipState/{state}', ['uses' => 'CvController@skipState']);
    Route::get('deletePhoto/{cvId}', ['middleware' => 'auth', 'uses' => 'CvController@deletePhoto'])->where('cvId', '[0-9]+');
    Route::post('saveDocument/{cvId}', ['middleware' => 'auth', 'uses' => 'CvController@saveDocument'])->where('cvId', '[0-9]+');
    Route::delete('deleteDocument/{id}', ['middleware' => 'auth', 'uses' => 'CvController@deleteDocument']);
    Route::post('{id}/saveComment', ['middleware' => 'auth', 'uses' => 'CvController@saveComment']);
    Route::get('{id}/delete', ['uses' => 'CvController@delete']);
    Route::delete('{id}', ['uses' => 'CvController@destroy']);
});

Route::group(['prefix' => 'kandidatai', 'middleware' => ['auth', 'admin']], function () {
    Route::get('deleteCandidate/{id}/{token}', ['uses' => 'CandidatesController@destroy']);
    Route::delete('deleteCandidates', ['uses' => 'CandidatesController@destroyAll']);
    Route::get('setRating/{id}/{rating}', ['uses' => 'CandidatesController@setRating']);
    Route::get('setComment/{id}/{comment?}', ['uses' => 'CandidatesController@setComment']);
});

// Auth
Route::get('prisijungimas', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::get('registracija', ['as' => 'auth.register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);

/* Users Controller */
//Route::get('registracija', ['as' => 'user_register', 'middleware' => 'guest', 'uses' => 'UsersController@register']);
Route::get('profilis/{id?}', ['as' => 'user_profile', 'middleware' => ['auth'], 'uses' => 'UsersController@profile']);

Route::get('users/{id}/delete', ['middleware' => ['auth', 'admin'], 'uses' => 'UsersController@delete']);
Route::post('users/auth', ['middleware' => 'guest', 'uses' => 'UsersController@auth']);
Route::get('users/logout', ['middleware' => 'auth', 'uses' => 'UsersController@logout']);
Route::post('users/{id}/changePassword', ['middleware' => 'auth', 'uses' => 'UsersController@changePassword']);
Route::resource('users', 'UsersController');

Route::resource('cvComments', 'CvCommentsController');

Route::group(['prefix' => 'administration', 'middleware' => 'worker'], function () {
    Route::get('/', 'AdminController@index');
    Route::group(['prefix' => 'workers', 'middleware' => 'admin'], function () {
        Route::get('/', 'AdminController@workers');
        Route::get('{id}/edit', 'AdminController@workerEdit');
        Route::post('create', 'AdminController@workerStore');
        Route::post('{id}/edit', 'AdminController@workerUpdate');
        Route::get('{id}/destroy', 'AdminController@workerDestroy');
    });

    Route::resource('offers', 'OffersAdminController');
    Route::match(['get', 'post'], '{id}/activate', ['uses' => 'OffersAdminController@activate']);
    Route::match(['get', 'post'], '{id}/deactivate', ['uses' => 'OffersAdminController@deactivate']);
    Route::get('{id}/delete', ['uses' => 'OffersAdminController@delete']);
    Route::get('deleteLogo/{logoId}', ['uses' => 'OffersAdminController@deleteLogo']);

    Route::resource('banners', 'BannersController');
    Route::get('{id}/move/{direction}', 'BannersController@move');

    Route::get('topCvs/getScopeCategories', 'TopCvsAdminController@getScopeCategories');
    Route::get('topCvs/{cvId}/language/{language}/remove', 'TopCvsAdminController@removeLanguage')
        ->name('topCvs.removeLanguage');
    Route::resource('topCvs', 'TopCvsAdminController');
});

Route::get('/', 'PageController@index');
Route::get('p/{pageSlug}', ['as' => 'page.show', 'uses' => 'PageController@show']);
Route::post('requestForm', ['as' => 'page.requestForm', 'uses' => 'PageController@postRequestForm']);
Route::post('contactForm', ['as' => 'page.contactForm', 'uses' => 'PageController@postContactForm']);
