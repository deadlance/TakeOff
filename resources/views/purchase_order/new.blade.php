@extends('master.index')

@section('header')
    <script>
        var statuses = new Array();

        $(document).ready(function () {
            getStatuses();
        });

        function getStatuses() {
            $.ajax({
                url: '/api/status',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    statuses = data;
                    // this is going to have to do something more intuitive.
                    for (var i = 0, len = statuses.length; i < len; i++) {
                        $("#status").append("<option value='" + statuses[i]['id'] + "'>" + statuses[i]['status'] + "</option>");
                    }
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">

            {!! Form::open() !!}
            {!! Form::token() !!}

            <div class="col-lg-12">
                <div class="panel">
                    <div class="col-lg-12"><div class='form-group'><label for="reference_number">4 Corners Reference Number</label><input type="text" class="form-control" name="reference_number" id="reference_number" /></div></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel">
                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_name">Delivery Name / Project</label>
                            <input type="text" class="form-control" name="delivery_name" id="delivery_name" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_1">Address</label>
                            <input type="text" class="form-control" name="delivery_address_1" id="delivery_address_1" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_2">Address Continued</label>
                            <input type="text" class="form-control" name="delivery_address_2" id="delivery_address_2" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_address_3">Address Extended</label>
                            <input type="text" class="form-control" name="delivery_address_3" id="delivery_address_3" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_city">City</label>
                            <input type="text" class="form-control" name="delivery_city" id="delivery_city" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_state">State</label>
                            <input type="text" class="form-control" name="delivery_state" id="delivery_state" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_zip">Zip Code</label>
                            <input type="text" class="form-control" name="delivery_zip" id="delivery_zip" />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="delivery_phone">Phone</label>
                            <input type="text" class="form-control" name="delivery_phone" id="delivery_phone" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel">
                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel">
                    <div class="col-lg-12">
                        <div class='form-group'>
                            <label for="status">Status</label>
                            <select name="status" id="status">

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel">
                    <div class="col-lg-12">
                <div class='form-group'>

                    <button type='submit' class='btn btn-success' name='save'>Save</button>
                </div>
            </div>
                </div>
            </div>


            {!! Form::close() !!}


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