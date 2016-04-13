<?php
Route::group(['middleware' => ['web']], function () {

  Route::group(['middleware' => ['sentry.guest']], function () {
    return Redirect::to('/login');
  });

  /*
   * This group just requires you to be logged in. Any group.
   */
  Route::group(['middleware' => ['sentry.auth']], function () {

    /*
     * These are the web based routes that do not require authentication.
     */
    Route::get('/', function () {
      return view('welcome');
    });
    Route::get('home', array('as' => 'home', function () {
      return view('welcome');
    }));


  });
  /*
   * Routes available to defined user groups.
   */
  Route::group(['middleware' => ['sentry.member:Admins']], function () {

    // Non API Routes
    Route::get('building_materials', 'BuildingMaterialsController@webIndex');
    Route::get('takeoffs','TakeoffsController@webIndex');
    Route::get('takeoffs/edit/{id}','TakeoffsController@webEdit');


    //******************************************************************************************************************
    // Admin API Routes
    Route::resource('api/tags', 'TagsController');

    Route::resource('api/unit_of_measure', 'Unit_Of_MeasureController');

    Route::resource('api/building_materials', 'BuildingMaterialsController');
    Route::get('api/building_materials/{id}/tags', 'BuildingMaterialsController@getTags');
    Route::get('api/building_materials/{buildingMaterialID}/addTag/{tagID}', 'BuildingMaterialsController@addTag');
    Route::get('api/building_materials/{buildingMaterialID}/removeTag/{tagID}', 'BuildingMaterialsController@removeTag');

    Route::resource('api/takeoffs', 'TakeoffsController');


  });


  Route::group(['middlware' => ['sentry.member:CustomerService']], function () {
  });
  Route::group(['middlware' => ['sentry.member:Sales']], function () {
  });
});