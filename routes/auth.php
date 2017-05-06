<?php

//Route::get('login', ['as' => 'auth.login', 'uses' => 'LoginController@showLoginForm']);
Route::post('login', ['as' => 'auth.login.post', 'uses' => 'LoginController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'LoginController@logout']);

Route::post('register', ['as' => 'auth.register.post', 'uses' => 'RegisterController@register']);

Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'ResetPasswordController@reset']);