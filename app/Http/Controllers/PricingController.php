<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Input, Validator, Session, Redirect, DB, Sentry;

use App\BuildingMaterial;
use App\Tags;
use App\Unit_Of_Measure;
use App\User;

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
    $user = User::find($supplier_id)->where('id', $supplier_id)->orderBy('email')->with('price')->get();
    $pricing = $user[0]['price'];
    $buildingMaterials = BuildingMaterial::orderBy('name')->with('unit_of_measure')->with('tags')->get();
    foreach($buildingMaterials as $bm) {
      $bm['price'] = '';
      $bm['identifying_number'] = '';
      foreach($pricing as $p) {
        if($bm['id'] == $p['building_material_id']) {
          $bm['price'] = $p['price'];
          $bm['identifying_number'] = $p['identifying_number'];
        }
      }
    }
    return $buildingMaterials;
  }


  public function webIndex() {
    return view('pricing.index');
  }


  public function viewSupplierPricing($supplier_id) {
    return view('pricing.bySupplier')->with('supplier_id', $supplier_id);
  }




  public function index() {}
  public function show() {}
  public function create() {}
  public function update() {}
  public function edit() {}
  public function destroy() {}
  public function store() {}


}
