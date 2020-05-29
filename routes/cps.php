<?php

/**
 * cps 系统
 */
Route::group(['namespace' => 'Cps'], function () {
  Route::post('login', 'CpsController@login');
  Route::post('logout', 'CpsController@logout');
  Route::post('test_create', 'CpsController@test_create');
  Route::get('user_info', 'CpsController@user_info');
});

Route::group(['namespace' => 'Cps', 'middleware' => ['auth:cps']], function() {
  Route::apiResource('cps_user_codes', 'CpsUserCodeController');
  Route::apiResource('cps_bring_users', 'CpsBringUserController');
});