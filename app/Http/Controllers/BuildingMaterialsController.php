<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\BuildingMaterial;

use App\Http\Requests;

class BuildingMaterialsController extends Controller
{
    public function index() {

      /*
      $b = new BUildingMaterial;
      $b->name = 'example';
      $b->slug = 'example-slug';
      $b->description = 'example description';
      $b->unit_of_measure_id = 6;
      $b->save();
      */

      //$b = BuildingMaterial::find(8);
      //$b->tags()->attach([16,17,18]);

      //return "<pre>" .json_encode(BuildingMaterial::with('unit_of_measure')->with('tags')->get(), JSON_PRETTY_PRINT) . "</pre>";
      return BuildingMaterial::with('unit_of_measure')->with('tags')->get();
    }

    public function getTags($id) {
      $buildingMaterial = BuildingMaterial::findOrFail($id)->with('tags')->where('id', $id)->get();
      //return "<pre>" .json_encode($buildingMaterial[0]['tags'], JSON_PRETTY_PRINT) . "</pre>";
      return $buildingMaterial[0]['tags'];
    }

    public function addTag($buildingMaterialID, $tagID) {
      // Here we need to add the tagID to the buildingMaterialID
      $buildingMaterial = BuildingMaterial::find($buildingMaterialID);
      if($buildingMaterial->tags()->attach($tagID)) {
        return 1;
      }
      else {
        return 0;
      }
    }

    public function removeTag($buildingMaterialID, $tagID) {
      // Here we need to add the tagID to the buildingMaterialID
      $buildingMaterial = BuildingMaterial::find($buildingMaterialID);
      if($buildingMaterial->tags()->detach($tagID)) {
        return 1;
      }
      else {
        return 0;
      }
    }

    public function webIndex() {
      return view('building_materials.index');
    }
}
