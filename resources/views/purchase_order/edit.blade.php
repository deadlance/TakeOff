@extends('master.index')

@section('header')
    <script>
        var id = {{ $purchaseOrder['id'] }};
        var statuses = new Array();
        var suppliers = new Array();
        var statusID = '';
        var supplierID = '';


        $(document).ready(function () {
            getStatuses();
            getSuppliers();
            loadPurchaseOrder();

        });

        function addItem(itemID) {
            var description = $("#line_item_" + itemID + " input[name=description]").val();
            var price = $("#line_item_" + itemID + " input[name=price]").val();
            var qty = $("#line_item_" + itemID + " input[name=qty]").val();
            var line_item_id = $("#line_item_" + itemID + " input[name=line_item_id]").val();
            var csrf = $("#line_item_" + itemID + " input[name=csrf]").val();

            if(qty < 0) {
                $.ajax({
                    url: '/api/purchase_order/addItem/' + id,
                    type: "get",
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        description: description,
                        price: price,
                        qty: qty,
                        line_item_id: line_item_id
                    },
                    success: function (data) {

                    }
                });
            }
        }

        function getPricing() {
            var items = 0;
            var html = ''
            $("#line_items").html('');
            $.ajax({
                url: '/api/pricing/' + supplierID,
                type: "get",
                dataType: 'json',
                success: function (data) {

                    for (var i = 0, len = data.length; i < len; i++) {
                        if (data[i]['price'] != '') {
                            // These are the only items we want to allow the user to add to the purchase order.

                            html = html + '<form id="line_item_' + data[i]['id'] + '" onFocusOut="addItem(' + data[i]['id'] + ');">';
                            html = html + '<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>';
                            html = html + '<div class="col-lg-1"><input type="hidden" name="line_item_id" value="' + data[i]['id'] + '">' + data[i]['id'] + '</div>';
                            html = html + '<div class="col-lg-2">' + data[i]['name'] + '</div>';
                            html = html + '<div class="col-lg-2"><input type="hidden" name="price" value="' + data[i]['price'] + '">' + data[i]['price'] + '</div>';
                            html = html + '<div class="col-lg-2">' + data[i]['unit_of_measure']['name'] + '</div>';
                            html = html + '<div class="col-lg-2"><input type="text" name="qty" class="form-control" /></div>';
                            html = html + '<div class="col-lg-3"><input type="text" name="description" class="form-control" /></div>';
                            html = html + '</form>';
                            $("#line_items").append(html);
                            //console.log(data[i]);
                            items++;
                        }
                    }
                    if (items == 0) {
                        $("#line_items").html("<div class='col-lg-12'><h6 style='color: red'>The selected supplier has no items priced.</h6></div>");
                    }
                }
            });

        }

        function getSuppliers() {
            $.ajax({
                url: '/api/supplier',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    suppliers = data;
                    $("#user_id").html('');
                    for (var i = 0, len = suppliers.length; i < len; i++) {
                        if (suppliers[i]['id'] == supplierID) {
                            $("#user_id").append("<option value='" + suppliers[i]['id'] + "' selected>" + suppliers[i]['username'] + "</option>");
                        }
                        else {
                            $("#user_id").append("<option value='" + suppliers[i]['id'] + "'>" + suppliers[i]['username'] + "</option>");
                        }
                    }
                }
            });
        }

        function getStatuses() {
            $.ajax({
                url: '/api/status',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    statuses = data;
                    $("#status").html('');
                    // this is going to have to do something more intuitive.
                    for (var i = 0, len = statuses.length; i < len; i++) {
                        if (statuses[i]['id'] == statusID) {
                            $("#status").append("<option value='" + statuses[i]['id'] + "' selected>" + statuses[i]['status'] + "</option>");
                        }
                        else {
                            $("#status").append("<option value='" + statuses[i]['id'] + "'>" + statuses[i]['status'] + "</option>");
                        }
                    }
                }
            });
        }

        function loadPurchaseOrder() {

            $.ajax({
                url: '/api/purchase_order/' + id,
                type: "get",
                dataType: 'json',
                success: function (data) {
                    supplierID = data['user_id'];
                    statusID = data['status_id'];

                    $("#created_at").html(data['created_at']);
                    $("#updated_at").html(data['updated_at']);

                    $("#reference_number").val(data['reference_number']);
                    $("#description").val(data['description']);
                    $("#delivery_name").val(data['delivery_name']);
                    $("#delivery_address_1").val(data['delivery_address_1']);
                    $("#delivery_address_2").val(data['delivery_address_2']);
                    $("#delivery_address_3").val(data['delivery_address_3']);
                    $("#delivery_city").val(data['delivery_city']);
                    $("#delivery_state").val(data['delivery_state']);
                    $("#delivery_zip").val(data['delivery_zip']);
                    $("#delivery_phone").val(data['delivery_phone']);

                    getStatuses();
                    getSuppliers();
                    getPricing();
                }
            });

        } // End loadPurchaseOrder()

        function updatePurchaseOrder() {
            $("#updateButton").html('Saving, please wait...');
            $("#updateButton").addClass("disabled");

            var reference_number = $("#reference_number").val();
            var description = $("#description").val();
            var delivery_name = $("#delivery_name").val();
            var delivery_address_1 = $("#delivery_address_1").val();
            var delivery_address_2 = $("#delivery_address_2").val();
            var delivery_address_3 = $("#delivery_address_3").val();
            var delivery_city = $("#delivery_city").val();
            var delivery_state = $("#delivery_state").val();
            var delivery_zip = $("#delivery_zip").val();
            var delivery_phone = $("#delivery_phone").val();
            var status_id = $("#status").val();
            var user_id = $("#user_id").val();
            var csrf = $("#token").val();
            $.ajax({
                url: '/api/purchase_order/' + id,
                type: 'PUT',
                data: {
                    _method: 'PUT',
                    id: id,
                    _token: csrf,
                    reference_number: reference_number,
                    description: description,
                    delivery_name: delivery_name,
                    delivery_address_1: delivery_address_1,
                    delivery_address_2: delivery_address_2,
                    delivery_address_3: delivery_address_3,
                    delivery_city: delivery_city,
                    delivery_state: delivery_state,
                    delivery_zip: delivery_zip,
                    delivery_phone: delivery_phone,
                    status: status_id,
                    user_id: user_id
                },
                dataType: 'JSON',
                success: function (data) {
                    $("#updateButton").html('Updated Successfully!');
                    setTimeout(function () {
                        $("#updateButton").html('Update');
                        $("#updateButton").removeClass("disabled");
                    }, 2000);
                    loadPurchaseOrder();
                }
            });
        } // end of updatePurchaseOrder()


        function changeSupplier() {
            if (confirm('This will delete all items from the purchase order.')) {

                // first we need to delete all the line items for the PO
                updatePurchaseOrder();
            }
            else {
                $('#user_id').val(supplierID);
            }
        } // End of changeSupplier


    </script>
@endsection

@section('content')
    <div class="container">
        <form onSubmit="return false;" id="poForm">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-link btn-xs" data-toggle="collapse" data-target="#header_row">
                        Header - Collapse
                    </button>
                </div>
            </div>
            <div id="header_row" class="collapse in well">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_name">Purchase Order ID : </label>
                                <input type="hidden" name="id" id="id" value="{{ $purchaseOrder['id'] }}"/>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"/>
                                {{ $purchaseOrder['id'] }}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label>Created Date : </label>
                                <div id="created_at"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label>Updated Date : </label>
                                <div id="updated_at"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="user_id">Assigned To : </label>
                                <select name="user_id" class="form-control" id="user_id" onChange="changeSupplier()">
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="reference_number">Reference Number</label>
                                <input type="text" class="form-control" name="reference_number"
                                       id="reference_number"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="description">Description</label>
                                <textarea type="text" rows="8" class="form-control" name="description"
                                          id="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_name">Delivery Name / Project</label>
                                <input type="text" class="form-control" name="delivery_name" id="delivery_name"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_address_1">Address</label>
                                <input type="text" class="form-control" name="delivery_address_1"
                                       id="delivery_address_1"/>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_address_2">Address Continued</label>
                                <input type="text" class="form-control" name="delivery_address_2"
                                       id="delivery_address_2"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_address_3">Address Extended</label>
                                <input type="text" class="form-control" name="delivery_address_3"
                                       id="delivery_address_3"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_city">City</label>
                                <input type="text" class="form-control" name="delivery_city" id="delivery_city"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_state">State</label>
                                <input type="text" class="form-control" name="delivery_state" id="delivery_state"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_zip">Zip Code</label>
                                <input type="text" class="form-control" name="delivery_zip" id="delivery_zip"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class='form-group'>
                                <label for="delivery_phone">Phone</label>
                                <input type="text" class="form-control" name="delivery_phone" id="delivery_phone"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-success" type="button" id="updateButton" onclick="updatePurchaseOrder()">
                            Update
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-right">
                <button type="button" class="btn btn-link btn-xs" data-toggle="collapse"
                        data-target="#line_items_block">
                    Line Items - Collapse
                </button>
            </div>
        </div>
        <div id="line_items_block" class="collapse in well">
            <div class="row">
                <div class="col-lg-12"><h6>If you change suppliers, all the items will be removed from this purchase
                        order.</h6></div>
            </div>
            <div class="row">
                <div class="col-lg-1">ID</div>
                <div class="col-lg-2">Name</div>
                <div class="col-lg-2">Price</div>
                <div class="col-lg-2">Units</div>
                <div class="col-lg-2">QTY</div>
                <div class="col-lg-3">Description</div>
            </div>
            <div class="row">
                <div id="line_items"></div>
            </div>
            <div class="row">
                <div class="col-lg-12"><h6>Totals</h6></div>
                <div id="totals"></div>
            </div>

        </div>
    </div>

@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection