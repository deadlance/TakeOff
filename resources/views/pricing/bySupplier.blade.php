@extends('master.index')

@section('header')
    <script>
        $(document).ready(function () {
            var html = '';
            $.ajax({
                url: '/api/pricing/{{ $supplier_id }}',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    $.each(data, function(idx, obj) {
                        html = html + "<div class='row'>";
                        html = html + "<form>";

                        html = html + "<div class='col-lg-1'>";
                        html = html + this['id'];
                        html = html + "</div>";

                        html = html + "<div class='col-lg-3'>";
                        html = html + this['name'];
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + this['unit_of_measure']['name'];
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + "<div class='form-group'>";
                        html = html + "<input type='text' name='price' class='form-control' value='" + this['price'] + "'/>";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + "<div class='form-group'>";
                        html = html + "<input type='text' name='identifying_number' class='form-control' value='" + this['identifying_number'] + "' />";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + "<div class='form-group'>";
                        html = html + "<button class='btn btn-success' name='save'>Save</button>";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "</form>";
                        html = html + "</div>";

                    })
                    $("#suppliers").html(html);
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div id="suppliers">
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