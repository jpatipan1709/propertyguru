@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/bower_components/switchery/css/switchery.min.css">
@endsection
@section('content')
@php
$active = 'template';
@endphp
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Input From</h5>
                                    {{-- <span class="text-muted">Get 15% Off on <a href="https://www.amcharts.com/"
                                            target="_blank">amCharts</a>
                                        licences. Use code "codedthemes" and get the discount.</span> --}}
                                    {{-- <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="fa fa-chevron-left"></i></li>
                                            <li><i class="fa fa-window-maximize full-card"></i></li>
                                            <li><i class="fa fa-minus minimize-card"></i></li>
                                            <li><i class="fa fa-refresh reload-card"></i></li>
                                            <li><i class="fa fa-times close-card"></i></li>
                                        </ul>
                                    </div> --}}
                                </div>
                               
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-6">
                                                Project Name : {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-primary btn-outline-primary"
                                                data-toggle="modal" data-target="#default-Modal" >ADD</button>
                                        </div>
                                    </div>
                                   
                                    <hr>
                                   
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-bordered table-strip table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">#</th>
                                                    <th class="text-center">Input Type</th>
                                                    <th class="text-center">Example</th>
                                                    <th class="text-center" width="15%">Select</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($typeinputs as $key => $typeinput)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $typeinput->tip_input }}</td>
                                                    <td >
                                                        <div class="row" style="margin:5px;">
                                                                @if ($typeinput->tip_input == 'select')
                                                                <select name="test" id="test" class="form-control">
                                                                    @foreach ($countrys as $country)
                                                                        <option value="{{ $country->ct_id }}">{{ $country->ct_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            @elseif($typeinput->tip_input == 'textarea')
                                                                <textarea name="" id=""  class="form-control">{{ 'Example Input TextArea'  }}</textarea>
                                                            @else 
                                                            <input type="{{ $typeinput->tip_input }}" class="form-control" value="@if($typeinput->tip_input == 'email') {{ 'email@mail.com'  }}@else {{ 'Example Input Text'  }} @endif "></td>
                                                            @endif
                                                        </div>
                                                       
                                                    
                                                    <td><a href="#" class="btn btn-outline-danger btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash-o"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Input Option</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('tempalte') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="label_input">Label</label>
                            <input type="text" class="form-control" id="label_input" name="label_input" placeholder="Label">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6 col-md-6">
                            <label for="name_input">Name</label>
                            <input type="text" class="form-control" id="name_input" name="name_input" placeholder="Name">
                        </div>
                        <div class="form-group col-6 col-md-6">
                            <label for="id_input">ID</label>
                            <input type="text" class="form-control" id="id_input" name="id_input" placeholder="ID"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_input">Type Input</label>
                        <select id="type_input" name="type_input" class="form-control">
                            @foreach ($typeinputs as $typeinput)
                            <option value="{{$typeinput->tip_id }}">{{$typeinput->tip_input }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- data-table js -->
<script src="files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="files/bower_components/switchery/js/switchery.min.js"></script>
<script src="files/assets/pages/advance-elements/swithces.js"></script>
<script>
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();

    function valDeleteData(id) {
        var token = $('#token').val();
        $.ajax({
            url: "{{ url('backoffice/order') }}/" + id,
            type: "POST",
            data: {
                _method: 'delete',
                _token: token
            },
            success: function (data) {
                $('#resultDelete').html(data);
                $('#reloadCheck').val(10);

            }

        });
    }
</script>
@endsection
