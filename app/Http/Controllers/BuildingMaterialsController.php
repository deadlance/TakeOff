<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\BuildingMaterial;

use App\Http\Requests;
use Input, Validator, Session, Redirect, DB;

class BuildingMaterialsController extends Controller {
  /**
   * @return mixed
   */
  public function index() {
    return BuildingMaterial::orderBy('name')->with('unit_of_measure')->with('tags')->get();
    //Tags::orderBy('name')->get()
  }

  /**
   * @param $id
   */
  public function destroy($id) {
    $buildingMaterial = BuildingMaterial::find($id);
    $buildingMaterial->delete();
  }

  /**
   * @return BuildingMaterial
   */
  public function store() {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return $buildingMaterial;
    } else {
      $buildingMaterial = new BuildingMaterial;
      $buildingMaterial->name = Input::get('name');
      $buildingMaterial->description = Input::get('description');
      $buildingMaterial->unit_of_measure_id = Input::get('unit_of_measure');

      $buildingMaterial->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $buildingMaterial->name . '_' . $buildingMaterial->unit_of_measure_id);
      $buildingMaterial->slug = preg_replace("/\s\s+/", " ", $buildingMaterial->slug);
      $buildingMaterial->slug = preg_replace("/\s/", "-", $buildingMaterial->slug);
      $buildingMaterial->slug = preg_replace("/\-\-+/", "-", $buildingMaterial->slug);
      $buildingMaterial->slug = trim($buildingMaterial->slug, "-");
      $buildingMaterial->slug = strtolower($buildingMaterial->slug);

      $buildingMaterial->save();
      return $buildingMaterial;
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function update($id) {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return $buildingMaterial;
    } else {
      $buildingMaterial = BuildingMaterial::find($id);
      $buildingMaterial->name = Input::get('name');
      $buildingMaterial->description = Input::get('description');
      $buildingMaterial->unit_of_measure_id = Input::get('unit_of_measure');

      $buildingMaterial->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $buildingMaterial->name . '_' . $buildingMaterial->unit_of_measure_id);
      $buildingMaterial->slug = preg_replace("/\s\s+/", " ", $buildingMaterial->slug);
      $buildingMaterial->slug = preg_replace("/\s/", "-", $buildingMaterial->slug);
      $buildingMaterial->slug = preg_replace("/\-\-+/", "-", $buildingMaterial->slug);
      $buildingMaterial->slug = trim($buildingMaterial->slug, "-");
      $buildingMaterial->slug = strtolower($buildingMaterial->slug);

      $buildingMaterial->save();

      return $buildingMaterial;
    }
  }

  /**
   * @param $id
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
  public function show($id) {
    $buildingMaterial = BuildingMaterial::with('unit_of_measure')->with('tags')->where('id', $id)->get();
    return $buildingMaterial;
  }

  /**
   *
   */
  public function create() {
    // web form for creating a building material. I'm not sure we'll need this.
  }

  /**
   *
   */
  public function edit() {
    // web form for updating a building material. I'm not sure we'll need this.
  }


  /**
   * @param $id
   * @return mixed
   */
  public function getTags($id) {
    $buildingMaterial = BuildingMaterial::findOrFail($id)->with('tags')->where('id', $id)->get();
    return $buildingMaterial[0]['tags'];
  }

  /**
   * @param $buildingMaterialID
   * @param $tagID
   * @return int
   */
  public function addTag($buildingMaterialID, $tagID) {
    $buildingMaterial = BuildingMaterial::find($buildingMaterialID);
    if ($buildingMaterial->tags()->attach($tagID)) {
      return 1;
    }
    else {
      return 0;
    }
  }

  /**
   * @param $buildingMaterialID
   * @param $tagID
   * @return int
   */
  public function removeTag($buildingMaterialID, $tagID) {
    $buildingMaterial = BuildingMaterial::find($buildingMaterialID);
    if ($buildingMaterial->tags()->detach($tagID)) {
      return 1;
    }
    else {
      return 0;
    }
  }

  public function byTag() {
    $buildingMaterial = BuildingMaterial::whereHas('tags', function($q) {
      $q->where('name', 'like', '%' . Input::get('tag') . '%');
    })->with('unit_of_measure')->with('tags')->get();

    return $buildingMaterial;
  }


  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function webIndex() {
    return view('building_materials.index');
  }
}
