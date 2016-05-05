<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input, Validator, Session, Redirect, DB, Sentry;
use App\PurchaseOrder;

class PurchaseOrderController extends Controller {

    public function index() {
    }

    public function destroy() {
    }

    public function store() {
        /*
         * TODO: Eventually we need to do some filtering / validation on certain things.
         */
        $purchaseOrder = new PurchaseOrder;
        $purchaseOrder->user_id = (Input::get('user_id') != '' ? Input::get('user_id') : Sentry::getUser()->id);
        $purchaseOrder->status_id = Input::get('status');
        $purchaseOrder->reference_number = Input::get('reference_number');
        $purchaseOrder->delivery_name = Input::get('delivery_name');
        $purchaseOrder->delivery_address_1 = Input::get('delivery_address_1');
        $purchaseOrder->delivery_address_2 = Input::get('delivery_address_2');
        $purchaseOrder->delivery_address_3 = Input::get('delivery_address_3');
        $purchaseOrder->delivery_city = Input::get('delivery_city');
        $purchaseOrder->delivery_state = Input::get('delivery_phone');
        $purchaseOrder->delivery_zip = Input::get('delivery_zip');
        $purchaseOrder->delivery_phone = Input::get('delivery_phone');
        $purchaseOrder->description = Input::get('description');
        $purchaseOrder->save();
        return $purchaseOrder;
    }

    public function update() {
    }

    public function edit() {
    }

    public function show() {
    }

    public function create() {
    }


    public function webEdit($purchase_order_id) {
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        return view('purchase_order.edit')->with('purchaseOrder', $purchase_order);
    }

    public function webIndex() {
        $purchaseOrders = PurchaseOrder::all();
        return view('purchase_order.index')->with('purchaseOrders', $purchaseOrders);
    }

    public function webNewPurchaseOrder() {
        return view('purchase_order.new');
    }

    public function webSavePurchaseOrder() {
        echo $this->store();

    }

}
