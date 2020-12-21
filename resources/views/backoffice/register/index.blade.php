@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
@endsection
@section('content')
<style>
    th input{
    width:100%;
}
</style>
@php
$active = 'registered';
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
                                    <h5>Registered List</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-12">
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
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                             <a href="{{ url('CreateForm').'/'.Session::get('id_project') }}" class="btn btn-primary btn-outline-primary">Add
                                                Register</a>
                                            {{-- <a href="{{ url('checkin') }}" class="btn btn-success btn-outline-success">CheckIn</a> --}}
                                            <button class="btn btn-warning btn-outline-warning" data-toggle="modal"
                                                data-target="#exampleModal2">Import Register</button>
                                            <button class="btn btn-danger btn-outline-danger" data-toggle="modal"
                                                data-target="#exampleModal3">Replace Register</button>
                                           

                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{url('deleteregister')}}" method="POST" id="form_delete_regis">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 text-left">
                                                <button type="button" id="delete_regis" class="btn btn-danger btn-outline-danger">DELETE
                                                    SELECT</button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="table2" class="table table-bordered table-strip table-hover display"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="5%"><input type="checkbox" class="checkAll"
                                                                name="checkAll[]" id="checkAll"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">E-mail</th>
                                                        <th class="text-center">Company</th>
                                                        <th class="text-center">Country</th>
                                                        <th class="text-center">Type Personal</th>
                                                        <th class="text-center">Arrive</th>
                                                        <th class="text-center">Re-send</th>
                                                        <th class="text-center">Read</th>
                                                        <th class="text-center">Manage</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($registerds as $key => $registerd)
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="check_del" name="check_del[]" id="check_del"
                                                            value="{{$registerd->rg_id}}"></td>
                                                    <td>{{$registerd->rg_id}}</td>
                                                    <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                                    <td>{{ $registerd->rg_email }}</td>
                                                    <td>{{ $registerd->rg_company }}</td>
                                                    <td>{{ $registerd->rg_country}}</td>
                                                    <td>{{ $registerd->tps_name }}</td>
                                                    <td>
                                                        {{-- @php
                                                            $checkins = App\Checkin::where('chi_rg_id',$registerd->rg_id)->where('chi_pj_id',Session::get('id_project'))->get();
                                                        @endphp
                                                        @foreach ($checkins as $checkin)
                                                            @if ( $checkin->chi_status == 1)
                                                           <i  style="font-size:18px;" class="text-success fa fa-check-square-o"
                                                                    aria-hidden="true"></i>
                                                            @else
                                                            <i  style="font-size:18px;" class="text-danger  fa fa-times-circle-o"
                                                                    aria-hidden="true"></i>
                                                            @endif
                                                        @endforeach --}}
                                                        @if ( $registerd->rg_status == 1)
                                                        <h5 style="color:green;"><i class="fa fa-check-square-o"
                                                                aria-hidden="true"></i></h5>
                                                        @else
                                                        <h5 style="color:red;"><i class="fa fa-times-circle-o"
                                                                aria-hidden="true"></i></h5>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ( $registerd->rg_resend == 1)
                                                        <h5 style="color:green;"><i class="fa fa-check-square-o"
                                                                aria-hidden="true"></i></h5>
                                                        @else
                                                        <h5 style="color:red;"><i class="fa fa-times-circle-o"
                                                                aria-hidden="true"></i></h5>
                                                        @endif
                                                    </td>
                                                   
                                                    <td>
                                                        @if ( $registerd->rg_read == 1)
                                                        <h5 style="color:green;"><i class="fa fa-check-square-o"
                                                                aria-hidden="true"></i></h5>
                                                        @else
                                                        <h5 style="color:red;"><i class="fa fa-times-circle-o"
                                                                aria-hidden="true"></i></h5>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-outline-primary btn-primary"
                                                        id="show_event" atr="{{ $registerd->rg_id }}" data-toggle="modal"
                                                        data-target="#exampleModal"><i class="fa fa-list-alt"
                                                            aria-hidden="true"></i></button>
                                                    <a href="{{ url('registered',$registerd->rg_id).'/edit'}}" class="btn btn-outline-warning btn-warning"
                                                        data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" width="5%"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">E-mail</th>
                                                        <th class="text-center">Phone</th>
                                                        <th class="text-center">Company</th>
                                                        <th class="text-center">Country</th>
                                                        <th class="text-center">Type Personal</th>
                                                        <th class="text-center">Arrive</th>
                                                        <th class="text-center">Read</th>
                                                        <th class="text-center">Manage</th>
                                                    </tr>
                                                </tfoot>
                                                </tbody>
                                            </table>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@csrf

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Exhibitors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="show_list"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('uploadimport')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="file" name="upload_file" id="upload_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('UploadUpdate')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Repalce Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="file" name="upload_file" id="upload_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
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
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
{{-- <script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#table2 tfoot th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        // DataTable
        var table = $('#table2').DataTable();

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    });

    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });


    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $("#del_check").click(function () {
        var check = $('.check_del:checked').serialize();
        var token = $('input[name=_token]').val();
        $.ajax({
            url: "{{url('deleteregister')}}",
            type: "post",
            data: {
                _method: "POST",
                token: token,
                check: check
            },
        }).done(function (data) {

            console.log(data);
        });
    });

</script>
<script>
    $(function () {

        $(document).on('click', '#delete_register', function () {
            var id = $(this).attr('atr');
            var token = $('input[name=_token]').val();
            swal({
                title: "Warning",
                text: "Do you want to delete Register?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{url('registered')}}/" + id,
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

        $(document).on('click', '#show_event', function () {
            var id = $(this).attr('atr');
            $.ajax({
                url: "{{url('showlist')}}/" + id,
                type: "get",
                data: {
                    id: id
                },
            }).done(function (data) {
                $('#show_list').html(data);
            });
        });

        $(document).on('click', '#delete_regis', function () {
            swal({
                title: "Warning",
                text: "Want to delete the selected data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $("#form_delete_regis").submit();
                }
            });
        });

    });

</script>
@endsection
