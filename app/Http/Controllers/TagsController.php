<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tags;
use Input, Validator, Session, Redirect;

class TagsController extends Controller {

  public function index() {
    $tags = Tags::all();
    //return $tags;
    return view('tags.index')->with('tags', $tags);
  }

  public function create() {
    return view('tags.create');
  }

  public function store() {
    $rules = array(
      'name'       => 'required'
    );

    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('tags/create')
        ->withErrors($validator)
        ->withInput(Input::all());
    } else {
      // store
      $tag = new Tags;

      $tag->name = Input::get('name');

      // Convert the name to a slug
      // Remove any character that is not alphanumeric, white-space, or a hyphen
      $tag->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $tag->name);
      // Replace multiple instances of white-space with a single space
      $tag->slug = preg_replace("/\s\s+/", " ", $tag->slug);
      // Replace all spaces with hyphens
      $tag->slug = preg_replace("/\s/", "-", $tag->slug);
      // Replace multiple hyphens with a single hyphen
      $tag->slug = preg_replace("/\-\-+/", "-", $tag->slug);
      // Remove leading and trailing hyphens
      $tag->slug = trim($tag->slug, "-");
      // Lowercase the URL
      $tag->slug = strtolower($tag->slug);

      $tag->description = Input::get('description');
      $tag->save();

      // redirect
      flash('message', 'Successfully created tag!');
      return Redirect::to('tags');
    }
  }

  public function update($id) {
    $rules = array(
      'name'       => 'required'
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return Redirect::to('tags/' . $id . '/edit')
        ->withErrors($validator)
        ->withInput(Input::all);
    } else {
      // store
      $tag = Tags::find($id);
      $tag->name = Input::get('name');

      // Convert the name to a slug
      // Remove any character that is not alphanumeric, white-space, or a hyphen
      $tag->slug = preg_replace("/[^a-z0-9\s\-]/i", "", $tag->name);
      // Replace multiple instances of white-space with a single space
      $tag->slug = preg_replace("/\s\s+/", " ", $tag->slug);
      // Replace all spaces with hyphens
      $tag->slug = preg_replace("/\s/", "-", $tag->slug);
      // Replace multiple hyphens with a single hyphen
      $tag->slug = preg_replace("/\-\-+/", "-", $tag->slug);
      // Remove leading and trailing hyphens
      $tag->slug = trim($tag->slug, "-");
      // Lowercase the URL
      $tag->slug = strtolower($tag->slug);



      $tag->description = Input::get('description');
      $tag->save();

      // redirect
      flash('message', 'Successfully updated tag!');
      return Redirect::to('tags');
    }
  }

  public function destroy($id) {
    $tag = Tags::find($id);
    $tag->delete();

    // redirect
    flash('message', 'Successfully deleted the tag!');
    return Redirect::to('tags');
  }

  public function show($id) {
    // get the tag
    $tag = Tags::find($id);

    // show the view and pass the nerd to it
    return view('tags.show')
      ->with('tag', $tag);
  }

  public function edit($id) {
    // get the tag
    $tag = Tags::find($id);

    // show the edit form and pass the nerd
    return view('tags.edit')
      ->with('tag', $tag);
  }

}
