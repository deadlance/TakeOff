<?php
Route::group(['middleware' => ['web']], function () {
    /*
     * These are the web based routes that do not require authentication.
     */
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('home', array('as' => 'home', function () {
        return view('welcome');
    }));










    Route::resource('tags', 'TagsController');
    Route::resource('unit_of_measure', 'Unit_Of_MeasureController');














    /*
     * This group just requires you to be logged in. Any group.
     */
    Route::group(['middleware' => ['sentry.auth']], function() {

    });
    /*
     * Routes available to defined user groups.
     */
    Route::group(['middleware' => ['sentry.member:Admins']], function () {

    });


    Route::group(['middlware' => ['sentry.member:CustomerService']], function() {
    });
    Route::group(['middlware' => ['sentry.member:Sales']], function() {
    });
});