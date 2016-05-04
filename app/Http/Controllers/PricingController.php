<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input, Validator, Session, Redirect, DB, Sentry;
use App\BuildingMaterial;
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
        foreach ($buildingMaterials as $bm) {
            $bm['price'] = '';
            $bm['identifying_number'] = '';
            foreach ($pricing as $p) {
                if ($bm['id'] == $p['building_material_id']) {
                    $bm['price'] = $p['price'];
                    $bm['identifying_number'] = $p['identifying_number'];
                }
            }
        }
        return $buildingMaterials;
    }

    public function updateSupplierPricing($supplier_id, $buildingMaterialID) {
        $price = (Input::get('price') != '' && Input::get('price') != null) ? Input::get('price') : 0;
        $identifying_number = (Input::get('identifying_number') != '' && Input::get('identifying_number') != null) ? Input::get('identifying_number') : '';

        // TODO - Make sure price is a valid double data type.

        $buildingMaterial = BuildingMaterial::find($buildingMaterialID);
        $buildingMaterial->price()->detach($supplier_id);
        if($price != 0 && $price != null && $price != '') {
            $buildingMaterial->price()->attach($supplier_id, ['price' => $price, 'identifying_number' => $identifying_number]);
        }
        else {
            return 0;
        }
        return 1;
    }


    public function webIndex() {
        return view('pricing.index');
    }


    public function viewSupplierPricing($supplier_id) {
        return view('pricing.bySupplier')->with('supplier_id', $supplier_id);
    }

    public function myPricing() {
        $user = Sentry::getUser();
        return view('pricing.bySupplier')->with('supplier_id', $user['id']);
    }

    public function updateMyPricing($supplier_id, $buildingMaterialID) {
        if (Sentry::check() && Sentry::getUser()->inGroup(Sentry::findGroupByName('Admins'))) {
            $this->updateSupplierPricing($supplier_id, $buildingMaterialID);
             return 1;
        }
        else {

            $user = Sentry::getUser();
            if ($user['id'] != $supplier_id) {
                return 0;
            } else {
                $this->updateSupplierPricing($supplier_id, $buildingMaterialID);
                return 1;
            }
        }
    }


    public function index() {
    }

    public function show() {
    }

    public function create() {
    }

    public function update() {
    }

    public function edit() {
    }

    public function destroy() {
    }

    public function store() {
    }


}
