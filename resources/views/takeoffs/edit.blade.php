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

        function clearFilters() {
            lastTag = '';
            $("#searchTag").val('');
            getBMS();
        }

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

        function updateTakeoff() {
            var sendName = $("#takeoffName").val();
            var sendDescription = $("#takeoffDescription").val();
            var sendMagentoProductID = $("#takeoffMagento_product_id").val();
            var sendMagentoOptionID = $("#takeoffMagento_option_id").val();

            $("#submit").val('Please Wait');

            $.ajax({
                url: '/api/takeoffs/updateTakeoff/{{ $takeoff["id"] }}',
                type: "get",
                dataType: 'json',
                data: { name: sendName, description: sendDescription, magento_product_id: sendMagentoProductID, magento_option_id: sendMagentoOptionID },
                success: function (data) {
                    setTimeout(function(){
                        $("#submit").val('Update');
                    },2000);
                }
            });
        }

        function updateBM(bmid) {
            var sendqty = $("#" + bmid + "-qty").val();
            var sendnotes = $("#" + bmid + "-notes").val();

            $.ajax({
                url: '/api/takeoffs/updateBuildingMaterial/{{ $takeoff['id'] }}/' + bmid, //{takeoff_id}/{building_material_id}',
                type: "get",
                dataType: 'json',
                data: { qty: sendqty, notes: sendnotes },
                success: function (data) {
                    $("#" + bmid + "-row").css('background-color', '#F0FFF0');

                    setTimeout(function(){
                        $("#" + bmid + "-row").css('background-color', '#FFFFFF');
                    },2000);
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
                            addBM = addBM + "<div class='row' style='margin-bottom: 5px;' id='" + bmid + "-row'>";
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
                            addBM = addBM + "<input type='text' class='form-control' name='qty' id='" + bmid + "-qty' onBlur='updateBM(" + bmid + ");' value=''/>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-3'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<input type='text' class='form-control' name='notes' id='" + bmid + "-notes' onBlur='updateBM(" + bmid + ");' value='' />";
                            addBM = addBM + "</div>";
                            addBM = addBM + "</div>";
                            addBM = addBM + "<div class='col-lg-2'>";
                            addBM = addBM + "<div class='form-group'>";
                            addBM = addBM + "<button class='btn btn-default' onClick='removeBM(\"" + newBM['id'] + "\"); return false;'>X</button> ";
                            addBM = addBM + "<button class='btn btn-default' onClick='updateBM(\"" + newBM['id'] + "\"); return false;'>UPD</button>";
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="takeoffName" value="{{ $takeoff['name'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="takeoffDescription">{{ $takeoff['description'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="magento_product_id">Magento Product ID</label>
                            <input type="text" class="form-control" name="magento_product_id" id="takeoffMagento_product_id" value="{{ $takeoff['magento_product_id'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="magento_option_id">Magento Option ID</label>
                            <input type="text" class="form-control" name="magento_option_id" id="takeoffMagento_option_id" value="{{ $takeoff['magento_option_id'] }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="submit" id="submit" value="Update" onClick="updateTakeoff();" />
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 8px; border: 1px dotted lightgrey;">
                    <div class="col-lg-12">
                        <h3>Building Materials</h3>
                    </div>
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
                        <div class="col-lg-3">
                            Notes
                        </div>
                        <div class="col-lg-2">
                            Actions
                        </div>


                    </form>
                </div>


                <div id="usedBMSBox">

                    @foreach($takeoff['building_materials'] as $bm)
                        <div class="usedBMS" data-id="{{ $bm['id'] }}">
                            <div class="row" style="margin-bottom: 5px;" id="{{ $bm['id'] }}-row">
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
                                            <input type="text" class="form-control" name="qty" id="{{ $bm['id'] }}-qty" value="{{ $bm['pivot']['qty'] }}" onBlur="updateBM('{{ $bm["id"] }}');"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="notes" id="{{ $bm['id'] }}-notes" value="{{ $bm['pivot']['notes'] }}" onBlur="updateBM('{{ $bm["id"] }}');"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <button class="btn btn-default" onClick="removeBM('{{ $bm['id'] }}'); return false;">X</button>
                                            <button class="btn btn-default" onClick="updateBM('{{ $bm["id"] }}'); return false;">UPD</button>
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
                            Available Building Materials
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
                                        <button class="btn btn-default" type="button" id="filterButton"
                                                onClick="clearFilters();">Clear
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