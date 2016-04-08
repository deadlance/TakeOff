<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unit_Of_Measure;
use Input, Validator, Session, Redirect;

class Unit_Of_MeasureController extends Controller {

  public function index() {
    $units_of_measure = Unit_Of_Measure::all();
    //return view('Unit_Of_Measure.index')->with('units_of_measure', $units_of_measure);
    return $units_of_measure;
  }

  public function create() {
    return view('Unit_Of_Measure.create');
  }

  public function store() {
    $rules = array(
      'name'       => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('unit_of_measure/create')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      $unit_of_measure = new Unit_Of_Measure;
      $unit_of_measure->name = Input::get('name');
      $unit_of_measure->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $unit_of_measure->name);
      $unit_of_measure->slug = preg_replace("/\s\s+/", " ", $unit_of_measure->slug);
      $unit_of_measure->slug = preg_replace("/\s/", "-", $unit_of_measure->slug);
      $unit_of_measure->slug = preg_replace("/\-\-+/", "-", $unit_of_measure->slug);
      $unit_of_measure->slug = trim($unit_of_measure->slug, "-");
      $unit_of_measure->slug = strtolower($unit_of_measure->slug);
      $unit_of_measure->description = Input::get('description');
      $unit_of_measure->save();
      //return Redirect::to('unit_of_measure');
      return $unit_of_measure;
    }
  }

  public function update($id) {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      return Redirect::to('unit_of_measure/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      $unit_of_measure = Unit_Of_Measure::find($id);
      $unit_of_measure->name = Input::get('name');
      $unit_of_measure->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $unit_of_measure->name);
      $unit_of_measure->slug = preg_replace("/\s\s+/", " ", $unit_of_measure->slug);
      $unit_of_measure->slug = preg_replace("/\s/", "-", $unit_of_measure->slug);
      $unit_of_measure->slug = preg_replace("/\-\-+/", "-", $unit_of_measure->slug);
      $unit_of_measure->slug = trim($unit_of_measure->slug, "-");
      $unit_of_measure->slug = strtolower($unit_of_measure->slug);
      $unit_of_measure->description = Input::get('description');
      $unit_of_measure->save();
      //return Redirect::to('unit_of_measure');
      return $unit_of_measure;
    }
  }

  public function destroy($id) {
    $unit_of_measure = Unit_Of_Measure::find($id);
    $unit_of_measure->delete();
    //return Redirect::to('unit_of_measure');
  }

  public function show($id) {
    $unit_of_measure = Unit_Of_Measure::find($id);
    //return view('Unit_Of_Measure.show')->with('unit_of_measure', $unit_of_measure);
    return $unit_of_measure;
  }

  public function edit($id) {
    $unit_of_measure = Unit_Of_Measure::find($id);
    //return view('Unit_Of_Measure.edit')->with('unit_of_measure', $unit_of_measure);
    return $unit_of_measure;
  }

}
