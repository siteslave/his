<?php

Route::get('/', ['before' => 'auth', 'uses' => 'HomeController@showWelcome']);

//Route::controller('users', 'UserController');
Route::get('login',  ['as'  => 'users.login', 'uses'   => 'UserController@login']);
Route::post('login', ['as'  => 'users.dologin', 'uses' => 'UserController@checkLogin']);
Route::get('logout', ['as'  => 'users.logout', 'uses'  => 'UserController@logout']);

Route::controller('services', 'ServicesController');
Route::controller('service-anc', 'ServiceAncController');
Route::controller('service-fp', 'ServiceFpController');
Route::controller('service-appoint', 'ServiceAppointController');
Route::controller('service-diag', 'ServiceDiagnosisController');
Route::controller('service-procedure', 'ServiceProcedureController');
Route::controller('service-income', 'ServiceIncomeController');
Route::controller('service-drug', 'ServiceDrugController');
Route::controller('service-accident', 'ServiceAccidentController');
Route::controller('service-vaccine', 'ServiceVaccineController');
Route::controller('service-postnatal', 'ServicePostnatalController');

Route::controller('settings', 'SettingsController');
/**
 * url    /apis
 */

Route::controller('apis', 'ApisController');

/**
 * URL    /pages/*
 */

Route::controller('pages', 'PagesController');
/**
 * URL    /pregnancies/*
 */

Route::controller('pregnancies', 'PregnanciesController');
Route::controller('person', 'PersonController');
Route::controller('villages', 'VillagesController');
//Route::get('villages/house',    ['uses' => 'VillageController@getHome']);
Route::get('house/person',      ['uses' => 'VillageController@getPerson']);
#Route::get('people/edit/{pid}', ['uses' => 'PersonController@showEdit']);

App::missing(function () {
    if (Request::ajax()) {
        return Response::json(['ok' => 0, 'error' => 'Page not found']);
    } else {
        return Response::view('errors.404', [], 404);
    }
});


