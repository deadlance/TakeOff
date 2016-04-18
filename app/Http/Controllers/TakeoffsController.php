<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\BuildingMaterial;
use App\Takeoff;

use Input, Validator, Session, Redirect;


class TakeoffsController extends Controller {

  public function index() {
    return Takeoff::all();
  }

  public function show($id) {
    return Takeoff::orderBy('name')->with('building_materials')->get();
  }

  public function destroy($id) {
  }

  public function store() {
    $takeoff = new Takeoff;
    $takeoff->name = Input::get('name');
    $takeoff->description = Input::get('description');
    $takeoff->magento_product_id = Input::get('magento_product_id');
    $takeoff->magento_option_id = Input::get('magento_option_id');
    $takeoff->save();
    return redirect('/takeoffs/edit/' . $takeoff->id);
  }

  public function update($id) {
    $takeoff = Takeoff::find($id);
    $takeoff->name = Input::get('name');
    $takeoff->description = Input::get('description');
    $takeoff->magento_product_id = Input::get('magento_product_id');
    $takeoff->magento_option_id = Input::get('magento_option_id');
    $takeoff->save();
    return 1;
  }


  // This is a web create form, we may not need this.
  public function create() {
    return view('takeoffs.create');
  }

  // This is a web edit form, we may not need this.
  public function edit() {
  }

  public function addBuildingMaterial($takeoff_id, $building_material_id) {
    $takeoff = Takeoff::find($takeoff_id);
    if ($takeoff->building_materials()->attach($building_material_id,['qty' => 0, 'notes' => ''])) {
      return 1;
    }
    else {
      return 0;
    }

  }

  public function removeBuildingMaterial($takeoff_id, $building_material_id) {
    $takeoff = Takeoff::find($takeoff_id);
    if ($takeoff->building_materials()->detach($building_material_id)) {
      return 1;
    }
    else {
      return 0;
    }

  }

  public function updateBuildingMaterial($takeoff_id, $building_material_id) {
    $takeoff = Takeoff::find($takeoff_id);
    $takeoff->building_materials()->detach($building_material_id);
    $takeoff->building_materials()->attach($building_material_id,['qty' => Input::get('qty'), 'notes' => Input::get('notes')]);
    //echo Input::get("qty") . "<br />" . Input::get("notes");
    return 1;
  }


  public function webIndex() {
    return view('takeoffs.index');
  }

  public function webEdit($id) {
    $takeoff = Takeoff::findOrFail($id)->with('building_materials')->where('id', $id)->first();
    //echo "<pre>" . json_encode($takeoff, JSON_PRETTY_PRINT) . "</pre>";
    //exit;
    return view('takeoffs.edit')->with('takeoff', $takeoff);
  }

}
