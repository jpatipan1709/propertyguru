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
                                            
                                            <a href="{{ url('dashboard') }}" class="btn btn-inverse btn-outline-inverse">Back</a>

                                        </div>
                                    </div>
                                    <hr>
                                    <form action="{{url('deleteregister')}}" method="POST" id="form_delete_regis">
                                        @csrf
                                        <div class="table-responsive">
                                            <table id="table2" class="table table-bordered table-strip table-hover display"
                                                style="width:100%">
                                                <thead>
                                                    <tr>

                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">E-mail</th>
                                                        <th class="text-center">Company</th>
                                                        <th class="text-center">Address</th>
                                                        <th class="text-center">Country</th>
                                                        <th class="text-center">Type Personal</th>
                                                        <th class="text-center">Arrive</th>
                                                        <th class="text-center">Re-send</th>
                                                        <th class="text-center">Read</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($registerds as $key => $registerd)
                                                <tr class="text-center">
                                                    <td>{{$registerd->rg_id}}</td>
                                                    <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                                    <td>{{ $registerd->rg_email }}</td>
                                                    <td>{{ $registerd->rg_company }}</td>
                                                    <td>{{ $registerd->rg_address }}</td>
                                                    <td>{{ $registerd->rg_country}}</td>
                                                    <td>{{ $registerd->tps_name }}</td>
                                                    <td>
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
                                                </tr>
                                                @endforeach
                                                {{-- <tfoot>
                                                    <tr>
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
                                                </tfoot> --}}
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
 var table = $('#table2').DataTable();
</script>
@endsection
