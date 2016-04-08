@extends('master.index')

@section('header')

    <style type="text/css">
        #building_materials_list div {
            /*border-right: 1px dotted lightgray;*/
        }
    </style>
    <script>
        var allTags = '';
        $(document).ready(function () {
            $.ajax({
                url: '/api/building_materials',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    loadBuildingMaterials(data);
                }
            });
            $.ajax({
                url: '/api/tags',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    allTags = data;
                }
            });
        });

        function loadBuildingMaterials(buildingMaterials) {
            var fullList = "";
            buildingMaterials.forEach(function (BM) {
                fullList = fullList + "<div class='panel' data-toggle='tooltip' data-placement='bottom' title='" + BM['description'] + "'>";
                fullList = fullList + "<div class='panel-body'>";
                fullList = fullList + "<div class='col-lg-1'>" + BM['id'] + "</div>";
                fullList = fullList + "<div class='col-lg-2'>" + BM['name'] + "</div>";
                fullList = fullList + "<div class='col-lg-4'>" + BM['description'] + "</div>";
                fullList = fullList + "<div class='col-lg-2'>" + BM['unit_of_measure']['name'] + "</div>";
                fullList = fullList + "<div class='col-lg-3'><div class='btn-group'>" +
                        "<button type='button' class='btn btn-warning' onClick='showTags(" + BM['id'] + ")'>Tags</button>" +
                        "<button type='button' class='btn btn-success'>Edit</button>" +
                        "<button type='button' class='btn btn-danger'>Delete</button>" +
                        "</div></div>";
                fullList = fullList + "</div>";
                fullList = fullList + "</div>";
            });

            //$('#building_materials_list').append(buildingMaterials[0]['id']);
            $('#building_materials_list').append(fullList);

        }

        function showTags(BMID) {
            var selectedTags = '';
            var data = '';
            $.ajax({
                url: '/api/building_materials/' + BMID + '/tags',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    selectedTags = data;
                    var window = "";
                    allTags.forEach(function (a) {
                        window = window + "<div class='checkbox'><label>";
                        window = window + "<input type='checkbox' onClick='checkboxActivation(this);' data-bmid='" + BMID + "' value='" + a['id'] + "'";
                        data.forEach(function (d) {
                            if (a['id'] == d['id']) {
                                window = window + " checked=checked";
                            }
                        })
                        window = window + ">" + a['name'];
                        window = window + "</label></div>";
                    })
                    $('#modalBox').html(window);
                    $('#myModal').modal('toggle');
                }
            });
        }

        function checkboxActivation(checkbox) {
            // Here we need to send an ajax call to the server to add / remove the checked tag from this building material
            if($(checkbox).is(':checked')) {
                $.ajax({
                    url: '/api/building_materials/' + $(checkbox).data('bmid') + '/addTag/' + $(checkbox).val(),
                    type: "get",
                    dataType: 'json',
                    success: function (data) {
                        $(checkbox).parent('label').parent('div').css('background-color', '#F0FFF0');

                        setTimeout(function(){
                            $(checkbox).parent('label').parent('div').css('background-color', '#FFFFFF');
                        },2000);
                    }
                });
            }
            else {
                $.ajax({
                    url: '/api/building_materials/' + $(checkbox).data('bmid') + '/removeTag/' + $(checkbox).val(),
                    type: "get",
                    dataType: 'json',
                    success: function (data) {
                        $(checkbox).parent('label').parent('div').css('background-color', '#FFE4E1');

                        setTimeout(function(){
                            $(checkbox).parent('label').parent('div').css('background-color', '#FFFFFF');
                        },2000);
                    }
                });
            }
        }

    </script>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="building_materials_list">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-lg-1">ID</div>
                            <div class="col-lg-2">Name</div>
                            <div class="col-lg-4">Description</div>
                            <div class="col-lg-2">Unit Of Measure</div>
                            <div class="col-lg-3">Actions</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- This is the tags pop up window -->
    <div id='myModal' class='modal fade' role='dialog'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 class='modal-title'>Tags</h4>
                </div>
                <div class='modal-body'>
                    <form id="tagForm">
                    <div id="modalBox"></div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
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