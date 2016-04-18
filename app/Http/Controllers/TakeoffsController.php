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
  }

  public function update($id) {
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


  public function webIndex() {
    return view('takeoffs.index');
  }

  public function webEdit($id) {
    $takeoff = Takeoff::findOrFail($id)->with('building_materials')->where('id', $id)->first();
    return view('takeoffs.edit')->with('takeoff', $takeoff);
  }

}
