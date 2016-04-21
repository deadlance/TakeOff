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
                        html = html + "<div class='row' id='" + this['id']+ "-row'>";
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
                        html = html + "<input type='text' name='price' class='form-control' id='" + this['id'] + "-price' value='" + this['price'] + "'/>";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + "<div class='form-group'>";
                        html = html + "<input type='text' name='identifying_number' class='form-control' id='" + this['id'] + "-identifying_number' value='" + this['identifying_number'] + "' />";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "<div class='col-lg-2'>";
                        html = html + "<div class='form-group'>";
                        html = html + "<button class='btn btn-success' name='save' onClick='saveBM(" + this['id'] + "); return false;'>Save</button>";
                        html = html + "</div>";
                        html = html + "</div>";

                        html = html + "</form>";
                        html = html + "</div>";

                    })
                    $("#suppliers").html(html);
                }
            });
        });

        function saveBM(bmid) {
            var Sprice              = $("#" + bmid + "-price").val();
            var Sidentifying_number = $("#" + bmid + "-identifying_number").val();

            $.ajax({
                url: '/api/pricing/{{ $supplier_id }}/' + bmid,
                type: "get",
                dataType: 'json',
                data: { price: Sprice, identifying_number: Sidentifying_number },
                success: function (data) {
                    if(data == 1) {
                        $("#" + bmid + "-row").css('background-color', '#F0FFF0');

                        setTimeout(function () {
                            $("#" + bmid + "-row").css('background-color', '#FFFFFF');
                        }, 2000);
                    }
                    else {
                        $("#" + bmid + "-row").css('background-color', '#FFD9D7');

                        setTimeout(function () {
                            $("#" + bmid + "-row").css('background-color', '#FFFFFF');
                        }, 2000);
                    }
                }
            });
        }
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