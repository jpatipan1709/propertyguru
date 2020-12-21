@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/bower_components/switchery/css/switchery.min.css">

<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css')}}" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css')}}" />
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
                                    <h5>Front-End Register Template</h5>
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
                                        <div class="col-12">
                                            @if($errors->all())
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <i class="icofont icofont-close-line-circled"></i>
                                                        </button>
                                                        @foreach ($errors->all() as $error)
                                                        {{ $error }} <br />
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(\Session::has('success'))
                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('success') }}
                                            </div>
                                            @endif
                                            @if(\Session::has('danger'))
                                            <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('danger') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            Project Name : {{ Session::get('project_name') }}
                                        </div>
                                        {{-- <div class="col-6 text-right">
                                            <button class="btn btn-primary btn-outline-primary" data-toggle="modal"
                                                data-target="#default-Modal">ADD</button>
                                        </div> --}}
                                    </div>

                                    <hr>
                                    @php
                                    $regisform = App\Regisform::where('rgf_pj_id',Session::get('id_project'))->first();     
                                    if($regisform != null){
                                    $ex_rgf_rgt_ids = explode(',',$regisform->rgf_rgt_id);
                                    }else{
                                    $ex_rgf_rgt_ids = array();
                                    }

                                    @endphp
                                    <form action="{{ url('tempalte',Session::get('id_project')) }}" method="post" autocomplete="off">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div>
                                                    <label for="project_name"><b>Input List</b> </label>
                                                    <select multiple="multiple" id="my-select" name="myselect[]">
                                                        @foreach ($templates as $template)
                                                        <option value='{{ $template->rgt_id }}'
                                                            {{ (collect(old('myselect'))->contains($template->rgt_label)) ? 'selected':'' }}
                                                            @foreach ($ex_rgf_rgt_ids as $ex_rgf_rgt_id)
                                                            {{ ($ex_rgf_rgt_id==$template->rgt_id) ? 'selected'  : '' }}
                                                            @endforeach>{{ $template->rgt_label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">

                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                    {{-- <div class="table-responsive">
                                        <table id="table2" class="table table-bordered table-strip table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">#</th>
                                                    <th class="text-center">Event Name</th>
                                                    <th class="text-center" width="20%">Mange</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($events as $key => $event)
                                                <tr>
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td class="text-center">{{ $event->ev_name }} </td>
                                                    <td class="text-center">
                                                        @if ($event->pj_status == 1)

                                                        <a href="{{ url('tempalte',$event->ev_pj_id).'/edit'}}" class="btn btn-outline-success btn-success"
                                                            data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                                class="fa fa-info-circle"></i></a>
                                                        @else
                                                        <a href="{{ url('tempalte',$event->ev_id).'/edit'}}" class="btn btn-outline-success btn-success"
                                                            data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                                class="fa fa-info-circle"></i></a>
                                                        @endif

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div> --}}
                                    {{-- @php
                                    $events = App\Regisform::where('rgf_pj_id',Session::get('id_project'))->first();

                                    if($events != null){
                                    $ex_rgf_rgt_ids = explode(',',$events->rgf_rgt_id);
                                    }else{
                                    $ex_rgf_rgt_ids = array();
                                    }

                                    @endphp
                                    <form action="{{ url('tempalte',Session::get('id_project')) }}" method="post"
                                        autocomplete="off">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div>
                                                    <label for="project_name"><b>Input List</b> </label>
                                                    <select multiple="multiple" id="my-select" name="myselect[]">

                                                        @foreach ($templates as $template)
                                                        <option value='{{ $template->rgt_id }}'
                                                            {{ (collect(old('myselect'))->contains($template->rgt_label)) ? 'selected':'' }}
                                                            @foreach ($ex_rgf_rgt_ids as $ex_rgf_rgt_id)
                                                            {{ ($ex_rgf_rgt_id==$template->rgt_id) ? 'selected'  : '' }}
                                                            @endforeach>{{ $template->rgt_label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                            </div>
                                        </div>

                                    </form> --}}
                                    {{-- <form action="#" method="post" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="project_name"><b>Type Admin:</b> </label>
                                                <select name="type_admin" id="type_admin" class="form-control">
                                                    <option value="0">------- Please Select Type -------</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Sponsor</option>
                                                    <option value="3">Guest</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="project_name"><b>Generate URL:</b> </label>
                                                <input type="text" name="generate_url" id="generate_url" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Generate</button>
                                            </div>
                                        </div>

                                    </form> --}}
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
<script src="{{ asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/jszip.min.js')}}"></script>
<script src="{{ asset('iles/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select 2 js -->
<script src="{{ asset('files/bower_components/select2/js/select2.full.min.js')}}"></script>

<!-- Multiselect js -->
<script src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('files/assets/js/jquery.quicksearch.js')}}"></script>

<!-- Custom js -->
<script src="{{ asset('files/assets/pages/advance-elements/select2-custom.js')}}"></script>

<script>
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();

    $("#select_input").change(function () {
        alert("test");
    });

</script>
@endsection
