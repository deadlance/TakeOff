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
    Route::get('/building_materials', 'BuildingMaterialsController@webIndex');
    Route::get('/takeoffs','TakeoffsController@webIndex');
    Route::get('/takeoffs/create','TakeoffsController@create');
    Route::post('/takeoffs/create','TakeoffsController@store');

    Route::get('/takeoffs/edit/{id}','TakeoffsController@webEdit');


    //******************************************************************************************************************
    // Admin API Routes
    Route::get('/api/tags/search', 'TagsController@search');
    Route::get('/api/building_materials/byTag', 'BuildingMaterialsController@byTag');

    Route::resource('/api/tags', 'TagsController');

    Route::resource('/api/unit_of_measure', 'Unit_Of_MeasureController');

    Route::resource('/api/building_materials', 'BuildingMaterialsController');
    Route::get('/api/building_materials/{id}/tags', 'BuildingMaterialsController@getTags');
    Route::get('/api/building_materials/{buildingMaterialID}/addTag/{tagID}', 'BuildingMaterialsController@addTag');
    Route::get('/api/building_materials/{buildingMaterialID}/removeTag/{tagID}', 'BuildingMaterialsController@removeTag');

    Route::resource('/api/takeoffs', 'TakeoffsController');
    Route::get('/api/takeoffs/addBuildingMaterial/{takeoff_id}/{building_material_id}', 'TakeoffsController@addBuildingMaterial');
    Route::get('/api/takeoffs/removeBuildingMaterial/{takeoff_id}/{building_material_id}', 'TakeoffsController@removeBuildingMaterial');
    Route::get('/api/takeoffs/updateBuildingMaterial/{takeoff_id}/{building_material_id}', 'TakeoffsController@updateBuildingMaterial');
    Route::get('/api/takeoffs/updateTakeoff/{takeoff_id}', 'TakeoffsController@update');

  });


  Route::group(['middlware' => ['sentry.member:CustomerService']], function () {
  });
  Route::group(['middlware' => ['sentry.member:Sales']], function () {
  });
});