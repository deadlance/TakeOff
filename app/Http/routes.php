<?php
Route::group(['middleware' => ['web']], function () {
    /*
     * These are the web based routes that do not require authentication.
     */
    Route::get('home', array('as' => 'home', function () {
        //return var_dump(Sentry::check());
        return view('welcome');
    }));


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