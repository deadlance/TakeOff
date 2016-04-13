@extends('master.index')

@section('header')
    <script>
        var buildingMaterials = "";

        $(document).ready(function() {
           getBMS();
        });

        $(function () {
            $("#searchTag").autocomplete({
                source: "{{ url('/api/tags/search') }}",
                minLength: 3,
                select: function (event, ui) {
                    $("#searchTag").val(ui.item.value);
                },
                messages: {
                    noResults: '',
                    results: function () {
                    }
                }

            });
        });


        function getBMS() {
            $.ajax({
                url: '/api/building_materials',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    buildingMaterials = data;
                },
                complete: function (data) {
                    initBMS();
                }
            });
        }

        function getBMSbyTag() {
            var tagSearch = $('#searchTag').val();
            
            $.ajax({
                url: '/api/building_materials/byTag',
                type: "get",
                dataType: 'json',
                data: { tag: tagSearch },
                success: function (data) {
                    buildingMaterials = data;
                },
                complete: function (data) {
                    initBMS();
                }
            });
        }

        function initBMS() {
            $('#BMS').html('');
            var bms = '';

            buildingMaterials.forEach(function (BM) {
                bms = bms + '<div class="panel panel-default">';
                bms = bms + '<div class="panel-body">';
                bms = bms + '<div class="row">';
                bms = bms + '<div class="col-lg-2">';
                bms = bms + '<span class="glyphicon glyphicon-chevron-left"></span>';
                bms = bms + '</div>';
                bms = bms + '<div class="col-lg-6">';
                bms = bms + BM['name'];
                bms = bms + '</div>';
                bms = bms + '<div class="col-lg-4">';
                bms = bms + BM['unit_of_measure']['name'];
                bms = bms + '</div></div></div></div>';

            })

            $('#BMS').html(bms);
        }


    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <pre>{{ $takeoff }}</pre>
                <hr>
                {{ $takeoff['name'] }}
                <hr>

                @foreach($takeoff['building_materials'] as $bm)

                    {{ $bm['name'] }}<br/>

                @endforeach

            </div>

            <div class="col-lg-4">


                <div class="panel-group">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Building Materials
                        </div>
                        <div class="panel-body">
                            <form method="GET" action="" onSubmit="getBMSbyTag(); return false;">

                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchTag" name="searchTag"
                                           placeholder="Filter Tag" aria-describedby="filterButton" value=''>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="filterButton" onClick="getBMSbyTag();">Filter</button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div id="BMS">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-lg-2">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </div>
                                    <div class="col-lg-10">
                                        This is a building name.
                                    </div>
                                </div>
                            </div>
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