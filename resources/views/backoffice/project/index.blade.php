@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
@endsection
@section('content')
@php
$active = 'project';
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
                                    <h5>Project List</h5>
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
                                            @if(\Session::has('success'))
                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('success') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        {{--<div class="col-6 text-right">
                                            <button class="btn btn-primary btn-outline-primary" data-toggle="modal"
                                                data-target="#default-Modal">ADD</button>
                                            <a href="{{ url('project'.'/create') }} " class="btn btn-primary
                                        btn-outline-primary">ADD</a>
                                    </div>--}}
                                </div>
                                @if($errors->all())
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled"></i>
                                            </button>
                                            @foreach ($errors->all() as $error)
                                            {{ $error }} <br />
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <br>
                                <form action="{{ url('project') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div>
                                                <label for="project_name">Project Name</label>
                                                <input type="text" class="form-control" id="project_name"
                                                    name="project_name" placeholder="Project Name"
                                                    value="{{ old('project_name') }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div>
                                                <p>Final Project</p>
                                                <input type='hidden' value='0' name='final_project'>
                                                <input type="checkbox" name="final_project" id="final_project"
                                                    class="js-single" @if (old('final_project') !="" ) {{'checked'}}
                                                    @endif value="1" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 text-right">
                                            <button type="submit"
                                                class="btn btn-primary btn-outline-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="table-responsive">
                                    <table id="table2" class="table table-bordered table-strip table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="5%">#</th>
                                                <th class="text-center">Project Name</th>
                                                <th class="text-center">Project Type</th>
                                                <th class="text-center">Create Date</th>
                                                <th class="text-center">Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $key => $project)
                                            <tr class="text-center">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $project->pj_name }}</td>
                                                <td>
                                                    @if ($project->pj_status == 0)
                                                    {{ '-' }}
                                                    @else
                                                    {{ 'Final Project' }}
                                                    @endif

                                                </td>
                                                <td>{{ $project->created_at }}</td>
                                                <td>
                                                    <a href="{{ url('project',$project->pj_id).'/edit'}}"
                                                        class="btn btn-outline-warning btn-warning"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button
                                                        class="btn btn-outline-danger btn-danger delete_pro" data-toggle="tooltip"
                                                        data-placement="bottom" title="delete" atr="{{ $project->pj_id }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
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
            <form action="{{ url('project') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name"
                                placeholder="Project Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <table class="table table-hover small-text" id="tb">
                                <tr class="tr-header">
                                    <th></th>
                                    <th class="text-right"><a href="javascript:void(0);" id="addMore" title="เพิ่ม"
                                            class="btn btn-outline-success btn-success">Add Event</a></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Event Name</td>
                                    <td><input type="text" id="event_name[]" name="event_name[]" class="form-control">
                                    </td>
                                    <td><a href='javascript:void(0);' class='remove'><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="table3" class="table table-bordered table-strip table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th class="text-center">Label</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $key => $template)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $template->rgt_label }}</td>
                                    <td>{{ $template->tip_input }}</td>
                                    <td><input type="checkbox" name="sel_typeinputs[]" id="sel_typeinputs[]"
                                            value="{{  $template->rgt_id }}" checked /></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="{{ asset('files/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
</script>
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();
    $('#table3').DataTable();

</script>
<script>
    $(function () {
        $('#addMore').on('click', function () {
            var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
            data.find("input").val('');
        });
        $(document).on('click', '.remove', function () {
            var trIndex = $(this).closest("tr").index();
            if (trIndex > 1) {
                $(this).closest("tr").remove();
            } else {
                alert("Need to have 1 row in the show");
            }
        });

     
        $(document).on('click', '.delete_pro', function () {
            var id = $(this).attr('atr');
            var token = $("input[name=_token]").val();
            swal({
            title: "Warning",
            text: "Do you want to delete project information?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{url('project')}}/" + id,
                        type: "post",
                        data: {
                            _method: 'delete',
                            _token: token,
                            id: id
                        },
                    }).done(function (data) {
                        // console.log(data);
                        location.reload();
                    });
                }
            });
        });
    });
    
    $('input[type=text]').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.,@!#$%&'*+/=?^_`{|}~-]{1,}$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });
</script>
@endsection
