@extends('master.index')

@section('header')
    <script>
        $(document).ready(function () {
            var html = '';
            $.ajax({
                url: '/api/pricing/getSuppliers',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    data.forEach(function (u) {
                        html = html + "<div class='row'>";
                        html = html + "<div class='col-lg-1'>" + u['id'] + "</div>";
                        html = html + "<div class='col-lg-4'>" + u['first_name'] + " " + u['last_name'] + "</div>";
                        html = html + "<div class='col-lg-3'>" + u['email'] + "</div>";
                        html = html + "<div class='col-lg-2'>" + u['username'] + "</div>";
                        html = html + "<div class='col-lg-2'><a href='/pricing/" + u['id'] + "'>View Pricing</a></div>";
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