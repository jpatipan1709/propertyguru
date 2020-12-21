@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">

@endsection
@section('content')
@php
$active = 'other';
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
                                    <h5>Country List</h5>
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
                                    {{-- <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ url('country/create') }}" class="btn btn-primary btn-outline-primary">Add
                                                Country</a>
                                        </div>
                                    </div> --}}
                                    <form action="{{ url('country') }}" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="country_name">Country Name</label>
                                                    <input type="text" class="form-control" id="country_name" name="country_name"
                                                placeholder="Country Name" autocomplete="off" value="{{ old('country_name') }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6 text-right">
                                                    <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-bordered table-strip table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">#</th>
                                                    <th class="text-center">Country Name</th>
                                                    <th class="text-center" width="20%">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($countrys as $key => $country)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $country->ct_name }}</td>
                                                    <td>
                                                        <a href="{{ url('country',$country->ct_id).'/edit'}}" class="btn btn-outline-warning btn-warning"
                                                            data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button class="btn btn-outline-danger btn-danger delete_country" id="delete_country"
                                                            atr="{{ $country->ct_id }}" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#table2').DataTable();

    $(document).on('click', '.delete_country', function () {
            var id = $(this).attr('atr');
            var token = $('input[name=_token]').val();
            swal({
                title: "Warning",
                text: "Do you want to delete Country ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{url('country')}}/" + id,
                        type: "post",
                        data: {
                            _method: 'delete',
                            _token: token,
                            id: id
                        },
                    }).done(function (data) {
                        if(data == 1){
                            location.reload();
                        }
                    });
                }
            });

        });
</script>
@endsection
