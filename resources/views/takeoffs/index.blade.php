@extends('master.index')

@section('header')
    <script>
        var takeoffsList = "";
        $(document).ready(function () {
            $.ajax({
                url: '/api/takeoffs',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    takeoffsList = data;
                },
                complete: function(data) {
                    loadInitial();
                }
            });

            function loadInitial() {
                $('#takeoffListBox').html('');
                var listBoxHtml = '';

                takeoffsList.forEach(function (TakeOff) {

                    listBoxHtml = listBoxHtml + "<div class='panel' data-toggle='tooltip' data-placement='bottom' title='" + TakeOff['description'] + "'>";
                    listBoxHtml = listBoxHtml + "<div class='panel-body'>";
                    listBoxHtml = listBoxHtml + "<div class='col-lg-1'><div class='form-group'><input type='hidden' name='id' value='" + TakeOff['id'] + "' />" + TakeOff['id'] + "</div></div>";
                    listBoxHtml = listBoxHtml + "<div class='col-lg-4'><div class='form-group'><input type='hidden' name='id' value='" + TakeOff['name'] + "' />" + TakeOff['name'] + "</div></div>";

                    listBoxHtml = listBoxHtml + "<div class='col-lg-2'><div class='form-group'><input type='hidden' name='id' value='" + TakeOff['magento_product_id'] + "' />" + TakeOff['magento_product_id'] + "</div></div>";
                    listBoxHtml = listBoxHtml + "<div class='col-lg-2'><div class='form-group'><input type='hidden' name='id' value='" + TakeOff['magento_option_id'] + "' />" + TakeOff['magento_option_id'] + "</div></div>";

                    listBoxHtml = listBoxHtml + "<div class='col-lg-3'><div class='btn-group'>" +
                            "<a href='/takeoffs/edit/" + TakeOff['id'] + "' class='btn btn-success'>Edit</a>" +
                            "<!-- <button type='button' class='btn btn-warning'>Save</button> -->" +
                            "<button type='button' class='btn btn-danger'>Delete</button>" +
                            "</div></div>";

                    listBoxHtml = listBoxHtml + "</div>";
                    listBoxHtml = listBoxHtml + "</div>";

                });

                $('#takeoffListBox').html(listBoxHtml);

            }

        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div class="col-lg-1">ID</div>
                        <div class="col-lg-4">Name</div>
                        <div class="col-lg-2">Product ID</div>
                        <div class="col-lg-2">Option ID</div>
                        <div class="col-lg-3">Actions</div>
                    </div>
                </div>

                <div id="takeoffListBox"></div>

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