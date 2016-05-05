@extends('master.index')

@section('header')
    <script>

    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
                <button type="button" class="btn btn-link btn-xs" data-toggle="collapse" data-target="#header_row">
                    Collapse
                </button>
            </div>
        </div>
        <div id="header_row" class="collapse in well">
            <div class="row">
                <div class="col-lg-6">


                    {{ $purchaseOrder['id'] }}
                    {{ $purchaseOrder['user_id'] }}
                    {{ $purchaseOrder['status_id'] }}
                    {{ $purchaseOrder['reference_number'] }}
                    {{ $purchaseOrder['description'] }}
                    {{ $purchaseOrder['created_at'] }}
                    {{ $purchaseOrder['updated_at'] }}


                </div>
                <div class="col-lg-6">

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_name">Delivery Name / Project</label>
                            <input type="text" class="form-control" name="delivery_name" id="delivery_name"
                                   value="{{ $purchaseOrder['delivery_name'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_1">Address</label>
                            <input type="text" class="form-control" name="delivery_address_1"
                                   id="delivery_address_1"
                                   value="{{ $purchaseOrder['delivery_address_1'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_2">Address Continued</label>
                            <input type="text" class="form-control" name="delivery_address_2"
                                   id="delivery_address_2"
                                   value="{{ $purchaseOrder['delivery_address_2'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_3">Address Extended</label>
                            <input type="text" class="form-control" name="delivery_address_3"
                                   id="delivery_address_3"
                                   value="{{ $purchaseOrder['delivery_address_3'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_city">City</label>
                            <input type="text" class="form-control" name="delivery_city" id="delivery_city"
                                   value="{{ $purchaseOrder['delivery_city'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_state">State</label>
                            <input type="text" class="form-control" name="delivery_state" id="delivery_state"
                                   value="{{ $purchaseOrder['delivery_state'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_zip">Zip Code</label>
                            <input type="text" class="form-control" name="delivery_zip" id="delivery_zip"
                                   value="{{ $purchaseOrder['delivery_zip'] }}"/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_phone">Phone</label>
                            <input type="text" class="form-control" name="delivery_phone" id="delivery_phone"
                                   value="{{ $purchaseOrder['delivery_phone'] }}"/>
                        </div>
                    </div>

                </div>
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