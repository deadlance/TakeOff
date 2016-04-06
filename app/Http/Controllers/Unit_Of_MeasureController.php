<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Unit_Of_Measure;
use Input, Validator, Session, Redirect;

class Unit_Of_MeasureController extends Controller {

  public function index() {
    $units_of_measure = Unit_Of_Measure::all();
    //return $units_of_measure;
    return view('Unit_Of_Measure.index')->with('units_of_measure', $units_of_measure);
  }

  public function create() {
    return view('Unit_Of_Measure.create');
  }

  public function store() {
    $rules = array(
      'name'       => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('unit_of_measure/create')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      // store
      $unit_of_measure = new Unit_Of_Measure;

      $unit_of_measure->name = Input::get('name');

      // Convert the name to a slug
      // Remove any character that is not alphanumeric, white-space, or a hyphen
      $unit_of_measure->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $unit_of_measure->name);
      // Replace multiple instances of white-space with a single space
      $unit_of_measure->slug = preg_replace("/\s\s+/", " ", $unit_of_measure->slug);
      // Replace all spaces with hyphens
      $unit_of_measure->slug = preg_replace("/\s/", "-", $unit_of_measure->slug);
      // Replace multiple hyphens with a single hyphen
      $unit_of_measure->slug = preg_replace("/\-\-+/", "-", $unit_of_measure->slug);
      // Remove leading and trailing hyphens
      $unit_of_measure->slug = trim($unit_of_measure->slug, "-");
      // Lowercase the URL
      $unit_of_measure->slug = strtolower($unit_of_measure->slug);


      $unit_of_measure->description = Input::get('description');
      $unit_of_measure->save();

      // redirect
      flash('message', 'Successfully created Unit_Of_Measure!');
      return Redirect::to('unit_of_measure');
    }
  }

  public function update($id) {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('unit_of_measure/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      // store
      $unit_of_measure = Unit_Of_Measure::find($id);
      $unit_of_measure->name = Input::get('name');

      // Convert the name to a slug
      // Remove any character that is not alphanumeric, white-space, or a hyphen
      $unit_of_measure->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $unit_of_measure->name);
      // Replace multiple instances of white-space with a single space
      $unit_of_measure->slug = preg_replace("/\s\s+/", " ", $unit_of_measure->slug);
      // Replace all spaces with hyphens
      $unit_of_measure->slug = preg_replace("/\s/", "-", $unit_of_measure->slug);
      // Replace multiple hyphens with a single hyphen
      $unit_of_measure->slug = preg_replace("/\-\-+/", "-", $unit_of_measure->slug);
      // Remove leading and trailing hyphens
      $unit_of_measure->slug = trim($unit_of_measure->slug, "-");
      // Lowercase the URL
      $unit_of_measure->slug = strtolower($unit_of_measure->slug);

      $unit_of_measure->description = Input::get('description');
      $unit_of_measure->save();

      // redirect
      flash('message', 'Successfully updated Unit_Of_Measure!');
      return Redirect::to('unit_of_measure');
    }
  }

  public function destroy($id) {
    $unit_of_measure = Unit_Of_Measure::find($id);
    $unit_of_measure->delete();

    // redirect
    flash('message', 'Successfully deleted the Unit_Of_Measure!');
    return Redirect::to('unit_of_measure');
  }

  public function show($id) {
    // get the Unit_Of_Measure
    $unit_of_measure = Unit_Of_Measure::find($id);

    // show the view and pass the nerd to it
    return view('Unit_Of_Measure.show')
      ->with('unit_of_measure', $unit_of_measure);
  }

  public function edit($id) {
    // get the Unit_Of_Measure
    $unit_of_measure = Unit_Of_Measure::find($id);

    // show the edit form and pass the nerd
    return view('Unit_Of_Measure.edit')
      ->with('unit_of_measure', $unit_of_measure);
  }

}
