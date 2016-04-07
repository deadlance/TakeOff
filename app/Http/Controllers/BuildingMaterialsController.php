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
}
