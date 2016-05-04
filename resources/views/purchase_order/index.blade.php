@extends('master.index')

@section('header')
    <script>

    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="col-lg-1"><label>ID</label></div>
                    <div class="col-lg-2"><label>Username</label></div>
                    <div class="col-lg-2"><label>Reference Number</label></div>
                    <div class="col-lg-2"><label>Delivery Name</label></div>
                    <div class="col-lg-2"><label>Created</label></div>
                    <div class="col-lg-2"><label>Updated</label></div>
                    <div class="col-lg-1"><label>Action</label></div>
                </div>
            </div>
        </div>
        @foreach($purchaseOrders as $po)
            <div class="row">
                <div class="panel">
                    <div class="panel-body">

                        <div class="col-lg-1">{{ $po['id'] }}</div>
                        <div class="col-lg-2">{{ Sentry::getUser($po['user_id'])->username }}</div>
                        <div class="col-lg-2">{{ $po['reference_number'] }}</div>
                        <div class="col-lg-2">{{ $po['delivery_name'] }}</div>
                        <div class="col-lg-2">{{ $po['created_at'] }}</div>
                        <div class="col-lg-2">{{ $po['updated_at'] }}</div>
                        <div class="col-lg-1">
                            <button type='button' class='btn btn-success'>View</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection