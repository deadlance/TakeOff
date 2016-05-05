<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Sentry;

class SupplierController extends Controller
{
    public function index() {
        $group = Sentry::findGroupByName('supplier');
        $suppliers = Sentry::findAllUsersInGroup($group);
        return $suppliers;
    }

    public function destroy() {
    }

    public function store() {
    }

    public function update($supplier_id) {
    }

    public function edit() {
    }

    public function show($supplier_id) {
    }

    public function create() {
    }
}
