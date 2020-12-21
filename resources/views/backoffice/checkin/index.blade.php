@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
--}}
@endsection
@section('content')
<style>
    th input {
        width: 100%;
    }



    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;

    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input.default:checked+.slider {
        background-color: #444;
    }

    input.primary:checked+.slider {
        background-color: #2196F3;
    }

    input.success:checked+.slider {
        background-color: #8bc34a;
    }

    input.info:checked+.slider {
        background-color: #3de0f5;
    }

    input.warning:checked+.slider {
        background-color: #FFC107;
    }

    input.danger:checked+.slider {
        background-color: #f44336;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
@php
$active = 'check';
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
                                    <h5>CheckIn</h5>
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
                                            @if(\Session::has('danger'))
                                            <div class="alert alert-danger border-danger" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ \Session::get('danger') }}
                                            </div>
                                            @endif
                                            {{-- @if(\Session::has('complete'))
                                            <div class="alert alert-success border-success" style="margin-bottom:0px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont-close-line-circled"></i>
                                                </button>
                                                {{ 'Thank you! CheckIn Success' }}
                                        </div>
                                        @endif --}}
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
                                        <a href="{{ url('registered') }}"
                                            class="btn btn-inverse btn-outline-inverse">Back</a>
                                    </div>
                                </div>
                                <hr>
                                <form action="{{ url('checkin') }}" method="post" id="form-checkin">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            {{-- <label for="fisrt_name">SCAN QR CODE</label> --}}
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1"><i
                                                        class="fa fa-qrcode"></i></span>
                                                <input type="text" class="form-control" id="qr_code" name="qr_code"
                                                    placeholder="SCAN QR CODE" autocomplete="off" required>
                                            </div>

                                            <input type="hidden" class="form-control" id="qr_code2" name="qr_code2"
                                                placeholder="SCAN QR CODE" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 text-right">
                                            {{-- <button type="button" id="check_in_form" class="btn btn-primary">Send</button> --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- @if(\Session::has('complete'))
                                    <hr>
                                    @php
                                    $registers = App\Registered::where('rg_id',Session::get('complete'))->get();
                                    @endphp
                                    <table id="table2" class="table table-bordered table-strip table-hover display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Name - Lastname</th>
                                                <th class="text-center">E-mail</th>
                                                <th class="text-center">Company</th>
                                                <th class="text-center">Country</th>
                                                <th class="text-center">Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registers as $key => $register)
                                            <tr>
                                                <td width="5%" class="text-center">{{ ++$key}}</td>
                                <td class="text-center">{{$register->rg_name}}
                                    {{$register->rg_lastname}}</td>
                                <td class="text-center">{{$register->rg_email}}</td>
                                <td class="text-center">{{$register->rg_company}}</td>
                                <td class="text-center">{{$register->rg_country}}</td>
                                <td class="text-center">
                                    <a href="{{ url('PrintBadge',$register->rg_id)}}"
                                        class="btn btn-outline-danger btn-danger" data-toggle="tooltip"
                                        data-placement="bottom" title="Badge" target="_blank"><i
                                            class="fa fa-print"></i></a>
                                    <a href="{{ url('PrintGala',$register->rg_id)}}"
                                        class="btn btn-outline-success btn-success" data-toggle="tooltip"
                                        data-placement="bottom" title="Gala Dinner" target="_blank"><i
                                            class="fa fa-print"></i></a>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>

                                @endif --}}
                                <div class="table-responsive">
                                    <table id="table2" class="table table-bordered table-strip table-hover display"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Guest Name</th>
                                                <th class="text-center">E-mail</th>
                                                <th class="text-center">Company</th>
                                                <th class="text-center">Country</th>
                                                <th class="text-center">Type Personal</th>
                                                <th class="text-center">Event</th>
                                                <th class="text-center">Arrive</th>
                                                <th class="text-center">Check-In</th>
                                                <th class="text-center">Print</th>
                                            </tr>
                                        </thead>
                                        @foreach ($registerds as $key => $registerd)
                                        <tr class="text-center">
                                            <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                            <td>{{ $registerd->rg_email }}</td>
                                            <td>{{ $registerd->rg_company }}</td>
                                            <td>{{ $registerd->rg_country}}</td>
                                            <td>{{ $registerd->tps_name }}</td>
                                            <td>{{ $registerd->ev_name }}</td>
                                            <td>
                                                {!! $registerd->chi_status == 1 ?
                                                '<h5 style="color:green;"><i class="fa fa-check-square-o"
                                                        aria-hidden="true"></i></h5>' : '<h5 style="color:red;"><i
                                                        class="fa fa-times-circle-o" aria-hidden="true"></i></h5>' !!}

                                            </td>
                                            <td class="text-center">
                                                <label class="switch ">
                                                    <input type="checkbox" class="primary checkin_man"
                                                        name="checkin_man" id="checkin_man"
                                                        {{ $registerd->chi_status == 1 ? 'checked' : '' }} value="1"
                                                        atr="{{$registerd->rg_id}}" atr2="{{$registerd->ev_id}}">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ url('PrintBadge',$registerd->rg_id)}}"
                                                    class="btn btn-outline-danger btn-danger" data-toggle="tooltip"
                                                    data-placement="bottom" title="Badge" target="_blank"><i
                                                        class="fa fa-print"></i></a>
                                                <a href="{{ url('PrintGala',$registerd->rg_id)}}"
                                                    class="btn btn-outline-success btn-success" data-toggle="tooltip"
                                                    data-placement="bottom" title="Gala Dinner" target="_blank"><i
                                                        class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Guest Name</th>
                                                <th class="text-center">E-mail</th>
ฃฃ
                                                <th class="text-center">Company</th>
                                                <th class="text-center">Country</th>
                                                <th class="text-center">Type Personal</th>
                                                <th class="text-center">Event</th>
                                                <th class="text-center">Arrive</th>
                                                <th class="text-center">Check-In</th>
                                                <th class="text-center">Print</th>
                                            </tr>
                                        </tfoot>
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
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
</script>
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        $("#qr_code").focus();
    });

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

    $("input[name=checkin_man]").change(function () {
        var status = this.value = (Number(this.checked));
        var id = $(this).attr('atr');
        var event = $(this).attr('atr2');
        swal({
            title: "Warning",
            text: "Do you want Change CheckIn?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{url('CheckInMan')}}" + '/' + id + '/' + event + '/' + status,
                    method: "get",
                    data: {
                        id: id,
                        status: status
                    }
                }).done(function (data) {

                    setTimeout(
                        function () {
                            swal('Check In Success');
                        }, 500);

                    window.location.reload();
                });
            } else {
                window.location.reload();
            }

        });
    });
    $("#qr_code").keyup(function () {
        var qr_code = $("#qr_code").val();
        setTimeout(
            function () {
                swal({
                    title: "Warning",
                    text: "Do you want to CheckIn?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $("#form-checkin").submit();
                    }
                });
            }, 500);


    });
    $('#table2').DataTable();

    $("#check_in_form").click(function () {
        var value = $("#qr_code").val();
        // alert(value);
        swal({
            title: "Warning",
            text: "Do you want to CheckIn?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            $("#form-checkin").submit();
        });
    });

    $('input').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.,@!#$%&'*+/=?^_`{|}~-]{1,}$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });

</script>
@endsection
