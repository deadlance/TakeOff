<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Input, Validator, Session, Redirect, DB, Sentry;

use App\BuildingMaterial;
use App\Tags;
use App\Unit_Of_Measure;

class PricingController extends Controller {

  public function getSuppliers() {
    $userArray = array();
    $group = Sentry::findGroupByName('Supplier');
    $users = Sentry::findAllUsersInGroup($group);
    foreach ($users as $u) {
      $userArray[] = array('id' => $u['id'], 'first_name' => $u['first_name'], 'last_name' => $u['last_name'], 'email' => $u['email'], 'username' => $u['username']);
    }
    return $userArray;
  }

  public function getSupplierPricing($supplier_id) {
    //$user = Sentry::findUserById($supplier_id);

    // Need to get all the building materials and all pricing and identifying numbers for this user

    return BuildingMaterial::orderBy('name')->with('unit_of_measure')->with('tags')->get();

  }


  public function webIndex() {
    return view('pricing.index');
  }


  public function viewSupplierPricing($supplier_id) {
    return view('pricing.bySupplier');
  }




  public function index() {}
  public function show() {}
  public function create() {}
  public function update() {}
  public function edit() {}
  public function destroy() {}
  public function store() {}


}
