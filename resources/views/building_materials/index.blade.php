@extends('master.index')

@section('header')

    <style type="text/css">
        #building_materials_list div {
            /*border-right: 1px dotted lightgray;*/
        }
    </style>
    <script>

        jQuery.each(['put', 'delete'], function(i, method) {
           jQuery[method] = function(url, data, callback, type) {
               if(jQuery.isFunction(data)) {
                   type = type || callback;
                   callback = data;
                   data = undefined;
               }
               return jQuery.ajax({
                   url: url,
                   type: method,
                   dataType: type,
                   data: data,
                   success: callback
               });
           };
        });

        var allTags = '';
        var unitsOfMeasure = '';
        $(document).ready(function () {
            $.ajax({
                url: '/api/tags',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    allTags = data;
                }
            });

            $.ajax({
                url: '/api/unit_of_measure',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    unitsOfMeasure = data;
                    data.forEach(function(d) {
                        $("#new_unit_of_measure").append("<option value='" + d['id'] + "'>" + d['name'] + "</option>");
                    });
                },
                complete: function(data) {

                    initBM();
                }
            });
        });

        function initBM() {
            $.ajax({
                url: '/api/building_materials',
                type: "get",
                dataType: 'json',
                success: function (data) {
                    loadBuildingMaterials(data);
                }
            });
        }

        function loadBuildingMaterials(buildingMaterials) {
            var fullList = "";
            $('#building_materials_list').html('');
            buildingMaterials.forEach(function (BM) {
                fullList = fullList + "<div class='panel' data-toggle='tooltip' data-placement='bottom' title='" + BM['description'] + "'>";
                fullList = fullList + "<div class='panel-body'>";

                // start of form
                fullList = fullList + '<form action="" method="" onSubmit="return false;" class="updateForm" id="updateForm_' + BM['id'] + '">';
                fullList = fullList + '{!! Form::token() !!}';
                fullList = fullList + "<div class='col-lg-1'><div class='form-group'><input type='hidden' name='id' value='" + BM['id'] + "' />" + BM['id'] + "</div></div>";
                fullList = fullList + "<div class='col-lg-2'><div class='form-group'><input type='text' class='form-control' name='name' value='" + BM['name'] + "' /></div></div>";
                fullList = fullList + "<div class='col-lg-4'><div class='form-group'><input type='text' class='form-control' name='description' value='" + BM['description'] + "' /></div></div>";;
                fullList = fullList + "<div class='col-lg-2'>";
                fullList = fullList + "<div class='form-group'>";
                fullList = fullList + "<select class='form-control' name='unit_of_measure' id='unitSelector_" + BM['id'] + "'>";
                //fullList = fullList + BM['unit_of_measure']['name'];
                unitsOfMeasure.forEach(function (u) {
                    fullList = fullList + "<option value='" + u['id'] + "'";
                    if(BM['unit_of_measure']['id'] == u['id']) {
                        fullList = fullList + " selected";
                    }
                    fullList = fullList + ">" + u['name'] + "</option>";
                })
                fullList = fullList + "</select>";
                fullList = fullList + "</div>";
                fullList = fullList + "</div>";
                fullList = fullList + "<div class='col-lg-3'><div class='btn-group'>" +
                        "<button type='button' class='btn btn-warning' onClick='showTags(" + BM['id'] + ")'>Tags</button>" +
                        "<button type='button' class='btn btn-success' onClick='updateBM(" + BM['id'] + ")'>Save</button>" +
                        "<button type='button' class='btn btn-danger' onClick='deleteBM(" + BM['id'] + ")'>Delete</button>" +
                        "</div></div>";

                // end of form
                fullList = fullList + '</form>';


                fullList = fullList + "</div>";
                fullList = fullList + "</div>";
            });

            //$('#building_materials_list').append(buildingMaterials[0]['id']);
            $('#building_materials_list').append(fullList);

        }

        function deleteBM(BMID) {
            var form = $("#updateForm_" + BMID);
            var csrf = form.find('input[name="_token"]').val();
            $.ajax({
                url: '/api/building_materials/' + BMID,
                type: 'DELETE',
                data: { id: BMID, _token: csrf },
                dataType: 'JSON',
                complete: function (data) {
                    initBM();
                }
            });
        }

        function updateBM(BMID) {
            var form = $("#updateForm_" + BMID);
            var BMname = form.find('input[name="name"]').val();
            var BMdescription = form.find('input[name="description"]').val();
            var BMunit_of_measure = $("#unitSelector_" + BMID).val()
            var csrf = form.find('input[name="_token"]').val();

            if(BMname == '') {
                alert('Name must be filled in.');
                exit;
            }

            if(BMunit_of_measure == '') {
                alert('You must choose a Unit of Measure.');
                exit;
            }

            $.ajax({
                url: '/api/building_materials/' + BMID,
                type: 'PUT',
                data: { _method: 'PUT', id: BMID, name: BMname, description: BMdescription, unit_of_measure: BMunit_of_measure, _token: csrf },
                dataType: 'JSON',
                complete: function (data) {
                    initBM();
                }
            });
        }

        function createBM() {
            var form = $("#newBM");
            var BMname = form.find('input[name="new_name"]').val();
            var BMdescription = form.find('input[name="new_description"]').val();
            var BMunit_of_measure = $("#new_unit_of_measure").val()
            var csrf = form.find('input[name="_token"]').val();

            if(BMname == '') {
                alert('Name must be filled in.');
                exit;
            }

            if(BMunit_of_measure == '') {
                alert('You must choose a Unit of Measure.');
                exit;
            }

            $.ajax({
                url: '/api/building_materials',
                type: 'POST',
                data: { name: BMname, description: BMdescription, unit_of_measure: BMunit_of_measure, _token: csrf },
                dataType: 'JSON',
                complete: function (data) {
                    initBM();
                    form.find("input[type=text], select").val("");
                }
            });
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
                <div class="panel">
                    <form id="newBM" onSubmit="return false;">
                    <div class="panel-body">
                        <div class="col-lg-1"><div class='form-group'><label>ID</label>{!! Form::token() !!}</div></div>
                        <div class="col-lg-2"><div class='form-group'><label for="new_name">Name</label><input type="text" class="form-control" name="new_name" id="new_name" /></div></div>
                        <div class="col-lg-4"><div class='form-group'><label for="new_description">Description</label><input type="text" class="form-control" name="new_description" id="new_description" /></div></div>
                        <div class="col-lg-2">
                            <div class='form-group'>
                                <label for="unit_of_measure">Unit of Measure</label>

                                <select class='form-control' name='unit_of_measure' id="new_unit_of_measure">
                                    <option value=""></option>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-3"><div class='form-group'><label for="save">Actions</label><br /><button type='button' class='btn btn-success' name='save' onClick='createBM();'>Save</button></div></div>
                    </div>
                    </form>

                </div>
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