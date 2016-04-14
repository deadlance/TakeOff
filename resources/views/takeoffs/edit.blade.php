@extends('master.index')

@section('header')
    <script>
        var buildingMaterials = "";
        var usedBMs = "";
        var lastTag = "";

        var tmp = "";

        $(document).ready(function () {
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
            if (lastTag != '') {
                getBMSbyTag();
            }
            else {
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
        }

        function getBMSbyTag() {
            var tagSearch = $('#searchTag').val();
            lastTag = tagSearch;
            $.ajax({
                url: '/api/building_materials/byTag',
                type: "get",
                dataType: 'json',
                data: {tag: tagSearch},
                success: function (data) {
                    buildingMaterials = data;
                },
                complete: function (data) {
                    initBMS();
                }
            });
        }

        function initBMS() {
            usedBMs = $("#usedBMSBox .usedBMS").map(function () {
                return $(this).data('id');
            }).get().join();

            $('#BMS').html('');
            var bms = '';
            buildingMaterials.forEach(function (BM) {
                if (usedBMs.indexOf(BM['id']) == -1) {
                    bms = bms + '<div class="panel panel-default">';
                    bms = bms + '<div class="panel-body">';
                    bms = bms + '<div class="row">';
                    bms = bms + '<div class="col-lg-2">';
                    bms = bms + '<a href="#" onClick="addBM(' + BM['id'] + ');"><span class="glyphicon glyphicon-chevron-left" ></span></a>';
                    bms = bms + '</div>';
                    bms = bms + '<div class="col-lg-6">';
                    bms = bms + BM['name'];
                    bms = bms + '</div>';
                    bms = bms + '<div class="col-lg-4">';
                    bms = bms + BM['unit_of_measure']['name'];
                    bms = bms + '</div></div></div></div>';
                }
            })
            $('#BMS').html(bms);
        }

        function getBM(bmid) {
            tmp = "";
            $.ajax({
                url: '/api/building_materials/' + bmid,
                type: "get",
                dataType: 'json',
                success: function (data) {
                    tmp = data;
                }
            });
        }

        function addBM(bmid) {

            var addBM = "";
            var newBM = "";

            $.ajax({
                url: '/api/takeoffs/addBuildingMaterial/{{ $takeoff['id'] }}/' + bmid, //{takeoff_id}/{building_material_id}',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    $.ajax({
                        url: '/api/building_materials/' + bmid,
                        type: "get",
                        dataType: 'json',
                        success: function (data) {
                            newBM = data[0];

                            // I need to get the newly added building material...
                            addBM = addBM + "<div class='usedBMS' data-id='" + bmid + "'>";
                            addBM = addBM + "<div class='row' style='margin-bottom: 5px;'>";
                            addBM = addBM + "<form class='form-inline' role='form'>";
                            addBM = addBM + "<div class='col-lg-1'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<label>" + bmid + "</label>";
                            addBM = addBM + "<input type='hidden' name='id' value='" + bmid + "'/>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-3'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<label>" + newBM['name'] + "</label>";
                            addBM = addBM + "<input type='hidden' name='bmname' value='" + newBM['name'] + "'/>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-3'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<input type='text' class='form-control' name='qty' value=''/>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-4'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<input type='text' class='form-control' name='notes' value='' />";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-1'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<button class='btn btn-default' onClick='removeBM(\"" + newBM['id'] + "\"); return false;'>X</button>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</form>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            $("#usedBMSBox").append(addBM);
                            getBMS();

                        }
                    });
                }
            });


        }

        function removeBM(bmid) {

            $.ajax({
                url: '/api/takeoffs/removeBuildingMaterial/{{ $takeoff['id'] }}/' + bmid, //{takeoff_id}/{building_material_id}',
                type: "get",
                dataType: 'json',
                success: function (data) {

                },
                complete: function (data) {

                }
            });

            $(".usedBMS").each(function () {
                if ($(this).data('id') == bmid) {
                    $(this).remove();
                }
            });
            getBMS();
        }

    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row" style="margin-bottom: 5px;">
                    <form class="form-inline" role="form">

                        <div class="col-lg-1">
                            ID
                        </div>
                        <div class="col-lg-3">
                            Building Material
                        </div>
                        <div class="col-lg-3">
                            Quantity
                        </div>
                        <div class="col-lg-4">
                            Notes
                        </div>
                        <div class="col-lg-1">
                            Actions
                        </div>


                    </form>
                </div>


                <div id="usedBMSBox">

                    @foreach($takeoff['building_materials'] as $bm)
                        <div class="usedBMS" data-id="{{ $bm['id'] }}">
                            <div class="row" style="margin-bottom: 5px;">
                                <form class="form-inline" role="form">

                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>{{ $bm['id'] }}</label>
                                            <input type="hidden" name="id" value="{{ $bm['id'] }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>{{ $bm['name'] }}</label>
                                            <input type="hidden" name="bmname" value="{{ $bm['name'] }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="qty"
                                                   value="{{ $bm['qty'] }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="notes"
                                                   value="{{ $bm['notes'] }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <button class="btn btn-default"
                                                    onClick="removeBM('{{ $bm['id'] }}'); return false;">X
                                            </button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    @endforeach


                </div>
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
                                        <button class="btn btn-default" type="button" id="filterButton"
                                                onClick="getBMSbyTag();">Filter
                                        </button>
                                    </span>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div id="BMS" style="margin-top: 5px;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-lg-2">
                                        <!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
                                    </div>
                                    <div class="col-lg-10">
                                        <!-- building materials go here -->
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