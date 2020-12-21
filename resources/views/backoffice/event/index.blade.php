@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}"> --}}

<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

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
                                    <h5>Event List</h5>
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
                                    <form action="{{ url('event') }}" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="event_name">Event Name</label>
                                                <input type="text" class="form-control" id="event_name" name="event_name"
                                            placeholder="Event Name" autocomplete="off" value="{{ old('event_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="event_date">Event Date</label>
                                                <input type="date" class="form-control" id="event_date" name="event_date"
                                                    placeholder="Event Date" autocomplete="off" value="{{ old('event_date') }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="event_time_start">Event Time Start</label>
                                                <input type="time" class="form-control" id="event_time_start" name="event_time_start"
                                                    placeholder="Event Time Start" autocomplete="off" value="{{ old('event_time_start') }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="event_time_end">Event Time End</label>
                                                <input type="time" class="form-control" id="event_time_end" name="event_time_end"
                                                    placeholder="Event Time End" autocomplete="off" value="{{ old('event_time_end') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
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
                                                    <th class="text-center">Event Name</th>
                                                    <th class="text-center"  width="15%">Event Date</th>
                                                    <th class="text-center"  width="15%">Event Time Start</th>
                                                    <th class="text-center"  width="15%">Event Time End</th>
                                                    <th class="text-center" width="20%">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($events as $key => $event)
                                                <tr class="text-center">
                                                    <td>{{ $event->ev_id }}</td>
                                                    <td>{{ $event->ev_name }}</td>
                                                    <td>{{ $event->ev_date_start }}</td>
                                                    <td>{{ $event->ev_time_start }}</td>
                                                    <td>{{ $event->ev_time_end }}</td>
                                                    <td>
                                                        <a href="{{ url('event',$event->ev_id).'/edit'}}" class="btn btn-outline-warning btn-warning"
                                                            data-toggle="tooltip" data-placement="bottom" title="Edit"><i
                                                                class="fa fa-edit"></i></a>
                                                        <button class="btn btn-outline-danger btn-danger" id="delete_event"
                                                            atr="{{ $event->ev_id }}" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                                        {{-- <form id="delete-form" action="{{ route('event.destroy',$event->ev_id)}}"
                                                            method="POST">
                                                            {{ method_field('DELETE') }}
                                                            @csrf

                                                        </form> --}}
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
@csrf
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
{{-- <script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script> --}}
{{-- <script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<script>
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();
    $('#table3').DataTable();

    // var timepicker = new TimePicker('event_time_start', {
    //     lang: 'en',
    //     theme: 'dark'
    // });

    // timepicker.on('change', function(evt) {
    //     var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    //     evt.element.value = value;
    // });

    // var timepicker = new TimePicker('event_time_end', {
    //     lang: 'en',
    //     theme: 'dark'
    // });

    // timepicker.on('change', function(evt) {
    //     var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    //     evt.element.value = value;
    // });
</script>
<script>
    $(function () {

        $(document).on('click', '#delete_event', function () {
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
                        url: "{{url('event')}}/" + id,
                        type: "post",
                        data: {
                            _method: 'delete',
                            _token: token,
                            id: id
                        },
                    }).done(function (data) {
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
