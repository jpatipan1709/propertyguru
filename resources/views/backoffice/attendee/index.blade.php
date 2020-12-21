@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">

<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css')}}" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css')}}" />

<!-- Date-time picker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css')}}" />
<!-- Date-Dropper css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datedropper/css/datedropper.min.css')}}" />
<!-- Color Picker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/spectrum/css/spectrum.css')}}" />
<!-- Mini-color css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/jquery-minicolors/css/jquery.minicolors.css')}}" />

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
                                    <h5>Front-End Event Template</h5>
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
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        @if ($event != null)
                                        <div class="col-6 text-right">
                                            <a href="{{ url('eventtemplate/create') }}" class="btn btn-primary btn-outline-primary">Add
                                                Event</a>
                                            <a href="{{ url('CreateBG'.'/'.Session::get('id_project'))}}" class="btn btn-primary btn-outline-primary">Add
                                                BG Image</a>
                                        </div>
                                        @endif

                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-bordered table-strip table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">#</th>
                                                    <th class="text-center">Event Title</th>
                                                    <th class="text-center">Event Name</th>
                                                    <th class="text-center">Background Image</th>
                                                    <th class="text-center" width="20%">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attendees as $key => $attendee)
                                                <tr class="text-center">
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $attendee->atd_title }}</td>
                                                    <td>
                                                        @php
                                                        $events =
                                                        App\Events::whereIn('ev_id',explode(',',$attendee->atd_ev_sel))->get();
                                                        @endphp
                                                        @foreach ($events as $event)
                                                        {!! $event->ev_name."<br />" !!}
                                                        @endforeach

                                                    </td>
                                                    <td>
                                                        @if ($attendee->pj_image !== "")
                                                        <span class="text-success">{{'YES'}}</span>
                                                        @else
                                                        <span class="text-danger">{{'NO'}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button href="#" id="show_url" class=" show_url btn btn-outline-success btn-success"
                                                            data-toggle="modal" data-target="#default-Modal" atr="{{ $attendee->atd_pj_id }}"
                                                            atr2="{{ $attendee->atd_pj_id }}"><i class="fa fa-info-circle"></i></button>
                                                        <a href="{{ url('eventtemplate',$attendee->atd_id).'/edit'}}"
                                                            class="btn btn-outline-warning btn-warning" data-toggle="tooltip"
                                                            data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-outline-danger btn-danger delete_event"
                                                            id="delete_event" atr="{{ $attendee->atd_id }}" data-toggle="tooltip"
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

<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Url Genarate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="show_url_link"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
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

</script>
<script>
    $(".show_url").click(function () {
        var ev_id = $(this).attr('atr');
        var pj_id = $(this).attr('atr2');
        var token = $("input[name=_token]").val();
        $.ajax({
            url: "{{ url('showlink') }}",
            type: "post",
            data: {
                _method: "post",
                _token: token,
                id: ev_id,
            },
        }).done(function (data) {
            // console.log(data);
            $('.show_url_link').html(data);
        });
    });

    $(document).on('click', '.delete_event', function () {
        var id = $(this).attr('atr');
        var token = $('input[name=_token]').val();
        swal({
            title: "Warning",
            text: "Do you want to delete event information?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{url('eventtemplate')}}/" + id,
                    type: "post",
                    data: {
                        _method: 'delete',
                        _token: token,
                        id: id
                    },
                }).done(function (data) {
                    console.log(data);
                    // location.reload();
                });
            }
        });

    });

</script>
@endsection
