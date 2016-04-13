<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tags;
use Input, Validator, Session, Redirect, DB, Response;

class TagsController extends Controller {

  /**
   * @return $this
   */
  public function index() {
    //$tags = Tags::all();
    $tags = Tags::orderBy('name')->get();
    //return view('tags.index')->with('tags', $tags);
    return $tags;
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function create() {
    return view('tags.create');
  }

  /**
   * @return mixed
   */
  public function store() {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) {
      //return Redirect::to('tags/create')->withErrors($validator)->withInput(Input::all());
      return $tag;
    } else {
      $tag = new Tags;
      $tag->name = Input::get('name');
      $tag->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $tag->name);
      $tag->slug = preg_replace("/\s\s+/", " ", $tag->slug);
      $tag->slug = preg_replace("/\s/", "-", $tag->slug);
      $tag->slug = preg_replace("/\-\-+/", "-", $tag->slug);
      $tag->slug = trim($tag->slug, "-");
      $tag->slug = strtolower($tag->slug);
      $tag->description = Input::get('description');
      $tag->save();

      //return Redirect::to('tags');
      return $tag;
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
      //return Redirect::to('tags/' . $id . '/edit')->withErrors($validator)->withInput(Input::all);
      return $tag;
    } else {
      $tag = Tags::find($id);
      $tag->name = Input::get('name');
      $tag->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $tag->name);
      $tag->slug = preg_replace("/\s\s+/", " ", $tag->slug);
      $tag->slug = preg_replace("/\s/", "-", $tag->slug);
      $tag->slug = preg_replace("/\-\-+/", "-", $tag->slug);
      $tag->slug = trim($tag->slug, "-");
      $tag->slug = strtolower($tag->slug);
      $tag->description = Input::get('description');
      $tag->save();

      //return Redirect::to('tags');
      return $tag;
    }
  }

  /**
   * @param $id
   * @return mixed
   */
  public function destroy($id) {
    $tag = Tags::find($id);
    $tag->delete();
    //return Redirect::to('tags');
  }

  /**
   * @param $id
   * @return $this
   */
  public function show($id) {
    $tag = Tags::find($id);
    //return view('tags.show')->with('tag', $tag);
    return $tag;
  }

  /**
   * @param $id
   * @return $this
   */
  public function edit($id) {
    $tag = Tags::find($id);
    //return view('tags.edit')->with('tag', $tag);
    return $tag;
  }

  public function search() {
    $term = Input::get('term');
    $results = array();
    $queries = DB::table('tags')
      ->where('name', 'LIKE', '%' . $term . '%')
      ->take(5)
      ->get();
    foreach($queries as $query) {
      $results[] = ['label' => $query->name];
    }
    return Response::json($results);
  }

}
