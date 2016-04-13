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
  }

  // This is a web edit form, we may not need this.
  public function edit() {
  }

  public function webIndex() {
    return view('takeoffs.index');
  }

}
