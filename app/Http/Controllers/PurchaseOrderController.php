<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\PurchaseOrder;

use App\Http\Requests;
use Input, Validator, Session, Redirect, DB, Sentry;



class PurchaseOrderController extends Controller {

    /**
     *
     */
    public function index() {
    }

    /**
     *
     */
    public function destroy() {
    }

    /**
     * @return PurchaseOrder
     */
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
        $purchaseOrder->delivery_state = Input::get('delivery_state');
        $purchaseOrder->delivery_zip = Input::get('delivery_zip');
        $purchaseOrder->delivery_phone = Input::get('delivery_phone');
        $purchaseOrder->description = Input::get('description');
        $purchaseOrder->save();
        return $purchaseOrder;
    }

    /**
     * @param $purchase_order_id
     * @return mixed
     */
    public function update($purchase_order_id) {
        /*
         * TODO: Eventually we need to do some filtering / validation on certain things.
         */
        $purchaseOrder = PurchaseOrder::find($purchase_order_id);
        $purchaseOrder->user_id = (Input::get('user_id') != '' ? Input::get('user_id') : Sentry::getUser()->id);
        $purchaseOrder->status_id = Input::get('status');
        $purchaseOrder->reference_number = Input::get('reference_number');
        $purchaseOrder->delivery_name = Input::get('delivery_name');
        $purchaseOrder->delivery_address_1 = Input::get('delivery_address_1');
        $purchaseOrder->delivery_address_2 = Input::get('delivery_address_2');
        $purchaseOrder->delivery_address_3 = Input::get('delivery_address_3');
        $purchaseOrder->delivery_city = Input::get('delivery_city');
        $purchaseOrder->delivery_state = Input::get('delivery_state');
        $purchaseOrder->delivery_zip = Input::get('delivery_zip');
        $purchaseOrder->delivery_phone = Input::get('delivery_phone');
        $purchaseOrder->description = Input::get('description');
        $purchaseOrder->update();
        return $purchaseOrder;
    }

    /**
     *
     */
    public function edit() {
    }

    /**
     * @param $purchase_order_id
     * @return mixed
     */
    public function show($purchase_order_id) {
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        return $purchase_order;
    }

    /**
     *
     */
    public function create() {
    }

    public function addItem($purchase_order_id) {
        $building_material_id = Input::get('line_item_id');
        $description = Input::get('description');
        $price = Input::get('price');
        $quantity = Input::get('qty');
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        $purchase_order->building_materials()->detach($building_material_id);
        return ($purchase_order->building_materials()->attach($building_material_id, ['description' => $description, 'price' => $price, 'quantity' => $quantity])) ? 0 : 1;
    }

    public function removeItem($purchase_order_id, $building_material_id) {
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        return ($purchase_order->building_materials()->detach($building_material_id)) ? 0 : 1;
    }

    public function removeAll($purchase_order_id) {
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        return ($purchase_order->building_materials()->detach()) ? 0 : 1;
    }

    /**
     * @param $purchase_order_id
     * @return mixed
     */
    public function webEdit($purchase_order_id) {
        $purchase_order = PurchaseOrder::find($purchase_order_id);
        $group = Sentry::findGroupByName('supplier');
        $suppliers = Sentry::findAllUsersInGroup($group);
        return view('purchase_order.edit')->with('purchaseOrder', $purchase_order)->with('suppliers', $suppliers);
    }

    /**
     * @return $this
     */
    public function webIndex() {
        $purchaseOrders = PurchaseOrder::all();
        return view('purchase_order.index')->with('purchaseOrders', $purchaseOrders);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function webNewPurchaseOrder() {
        return view('purchase_order.new');
    }

    /**
     *
     */
    public function webSavePurchaseOrder() {
        echo $this->store();

    }

}
