<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Status;

use App\Http\Requests;

class StatusesController extends Controller
{
    public function index() {
        return Status::all();
    }

    public function destroy() {
    }

    public function store() {
    }

    public function update() {
    }

    public function edit() {
    }

    public function show() {
    }

    public function create() {
    }
}
