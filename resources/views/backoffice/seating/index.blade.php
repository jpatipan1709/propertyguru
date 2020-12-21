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

<!-- Select 2 css -->
<link rel="stylesheet" href="{{ asset('files/bower_components/select2/css/select2.min.css')}}" />
<!-- Multi Select css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/multiselect/css/multi-select.css')}}" />

<!-- Date-time picker css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css')}}">
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css')}}" />
<!-- Date-Dropper css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/datedropper/css/datedropper.min.css')}}" />
<!-- Color Picker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/spectrum/css/spectrum.css')}}" />
<!-- Mini-color css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/jquery-minicolors/css/jquery.minicolors.css')}}" />
<!-- Color Picker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/spectrum/css/spectrum.css')}}" />
<!-- Mini-color css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset('files/bower_components/jquery-minicolors/css/jquery.minicolors.css')}}" />

@endsection
@section('content')
<style>
    #canvas {
        width: 370px;
        height: 350px;
        position: relative;
        margin: 2em auto;
        background-color: cornsilk;


    }


    .box {
        position: absolute;
        height: 80px;
        background-color: #D5D8DC;
        width: 80px;
        cursor: move;
        color: black;
        font-size: 14px;
        border-radius: 50%;
        display: inline-block;
        padding-top: 10px;
    }


    #box1 {
        position: absolute;
        height: 100px;
        width: 300px;
        background-color: black;
        cursor: move;
        color: white;
        font-size: 18px;
        display: inline-block;
        padding-top: 35px;
        padding-left: 75px;
    }


    #box2 {
        position: absolute;
        height: 80px;
        background: red;
        width: 80px;
        cursor: move;
        color: black;
        font-size: 14px;
        border-radius: 50%;
        display: inline-block;
        padding-top: 25px;
        padding-left: 15px;
    }

    #box3 {
        position: absolute;
        height: 80px;
        width: 120px;
        color: black;
        padding-top: 25px;
        padding-left: 15px;
        border-width: 1px;
        border-style: solid;
    }

    #results {
        text-align: center;
    }

    #image-preview {
        width: 300px;
        height: 300px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
        border: #bdc3c7 1px solid;
    }

    #image-preview input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;

    }

    #image-preview label {
        position: absolute;
        z-index: 5;
        opacity: 0.8;
        cursor: pointer;
        background-color: #bdc3c7;
        width: 200px;
        height: 50px;
        font-size: 14px;
        line-height: 50px;
        text-transform: uppercase;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        text-align: center;
    }

    #main_bg {
        background-color: white;
        width: 99%;
        height: 790px;
        border-style: solid;
        border-width: 1px;
        border-color: silver;
        position: relative;
    }

    .main {
        list-style: none;
        width: 100%;
        overflow: hidden;
        padding: 0;
    }

    .sub {

        display: block;
        width: 50px;
        height: 50px;
        border: 1px solid silver;
        float: left;
        margin-left: -1px;
        margin-top: -1px;
        border-bottom: none;
        border-right: none;
    }

</style>
@php
$active = 'Seat';
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
                                    <h5>Seat Planning Tempalte</h5>
                                </div>
                                <form action="{{url('seatplanning')}}" method="POST">
                                    @csrf
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-12">
                                                @if($errors->all())
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="alert alert-danger border-danger"
                                                            style="margin-bottom:0px;">
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
                                                <div class="alert alert-success border-success"
                                                    style="margin-bottom:0px;">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <i class="icofont-close-line-circled"></i>
                                                    </button>
                                                    {{ \Session::get('success') }}
                                                </div>
                                                @endif
                                                @if(\Session::has('danger'))
                                                <div class="alert alert-danger border-danger"
                                                    style="margin-bottom:0px;">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <i class="icofont-close-line-circled"></i>
                                                    </button>
                                                    {{ \Session::get('danger') }}
                                                </div>
                                                @endif
                                                <div id="alert_set"></div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-6">
                                                <b>Project Name :</b> {{ Session::get('project_name') }}
                                            </div>
                                            <div class="col-6 text-right">
                                                <button type="button" class="btn btn-primary" id="add_table"
                                                    data-toggle="modal" data-target="#default-Modal2">Add Table</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row text-right" style="margin-bottom: 15px;">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary" id="reverse_stage"><i
                                                        class="fa fa-refresh" aria-hidden="true"></i></button>
                                                {{-- <button type="button" class="btn btn-success" id="ZoomIn"><i class="fa fa-search-plus"
                                                    aria-hidden="true"></i></button>
                                            <button type="button" class="btn btn-danger" id="ZoomOut"><i class="fa fa-search-minus"
                                                    aria-hidden="true"></i></button> --}}
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12">
                                                {{-- <button type="button" id="set_seating" class="btn btn-primary btn-outline-primary">Set Seating</button> --}}
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save
                                                    Seating</button>
                                                <input type="hidden" name="stage_x" id="stage_x"
                                                    value="{{ count($seats) >= 1 ? $seats[0]->s_stage_x: '' }}">
                                                <input type="hidden" name="stage_y" id="stage_y"
                                                    value="{{ count($seats) >= 1 ? $seats[0]->s_stage_y: '' }}">
                                                <input type="hidden" name="width_stage" id="width_stage"
                                                    value="{{ count($seats) >= 1 ? $seats[0]->s_width: '' }}">
                                                <input type="hidden" name="height_stage" id="height_stage"
                                                    value="{{ count($seats) >= 1 ? $seats[0]->s_height: '' }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div id="main_bg">
                                            @if (isset($tb_tables))
                                            @foreach ($tb_tables as $tb_table)
                                        <div class="box" atr="{{$tb_table->tb_id}}" id="box_alert" data-html="true" data-toggle="tooltip"  data-placement="right"
                                                title="@php
                                                if($tb_table->tb_seat != ""){
                                                    $im_seats = explode(',',$tb_table->tb_seat);
                                                    foreach ($im_seats as $key => $im_seat) {
                                                        // echo $im_seat;
                                                        $regirsters = App\Registered::where('rg_id',$im_seat)->where('rg_pj_id',Session::get('id_project'))->first();
                                                        
                                                        echo $regirsters['rg_name'].' '.$regirsters['rg_lastname'].'<br/>';
                                                    }
                                                }else{
                                                    echo "No Person in table";
                                                }
                                                @endphp
                                                "
                                                style="top:{{ $tb_table->tb_position_y }}px;left:{{  $tb_table->tb_position_x }}px;">
                                                <a href="{{url('AddRegisterSeat').'/'.$tb_table->tb_id}}">
                                                    <p style="text-align: center">
                                                        {{$tb_table->tb_name}} 
                                                        <br />
                                                        No.{{$tb_table->tb_no}}
                                                        <br>
                                                        {{ $tb_table->tb_seat != "" ? count(explode(',',$tb_table->tb_seat))  : '0'}} / {{$tb_table->tb_person}}
                                                    </p>
                                                </a>
                                            </div>
                                            @endforeach

                                            @endif
                                            <div style="top:{{ count($seats) >= 1 ? $seats[0]->s_stage_x: '' }}px;left:{{ count($seats) >= 1 ? $seats[0]->s_stage_y: '' }}px;width:{{ count($seats) >= 1 ? $seats[0]->s_width: '' }}px;height:{{ count($seats) >= 1 ? $seats[0]->s_height: '' }}px;"
                                                id="box1"></div>

                                            <div class="main" id="main">
                                                @for ($i = 0; $i < 496; $i++) <div class="sub">
                                            </div>
                                            @endfor
                                        </div>
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


<div class="modal fade" id="default-Modal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add table</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="table_name">Table Number : </label>
                            <input type="number" name="table_no1" id="table_no1" value="" class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="table_name">Table Name : </label>
                            <input type="text" name="table_name" id="table_name" value="" class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="table_name">Seats : </label>
                            <input type="number" name="seats" id="seats" value="" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add_table2" data-dismiss="modal"
                        class="btn btn-primary waves-effect ">Add</button>
                  
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
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript"
    src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
<!-- Bootstrap date-time-picker js -->
<script src="{{ asset('files/assets/pages/advance-elements/moment-with-locales.min.js')}}"></script>
<script src="{{ asset('files/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/bootstrap-datetimepicker.min.j')}}s"></script>
<!-- Date-range picker js -->
<script src="{{ asset('files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js')}}"></script>
<!-- Date-dropper js -->
<script src="{{ asset('files/bower_components/datedropper/js/datedropper.min.js')}}"></script>

<!-- Color picker js -->
<script src="{{ asset('files/bower_components/spectrum/js/spectrum.js')}}"></script>
<script src="{{ asset('files/bower_components/jscolor/js/jscolor.js')}}"></script>
<!-- Mini-color js -->
<script src="{{ asset('files/bower_components/jquery-minicolors/js/jquery.minicolors.min.js')}}"></script>
<!-- Custom js -->
<script src="{{ asset('files/assets/pages/advance-elements/custom-picker.js')}}"></script>

<!-- Select 2 js -->
<script src="{{ asset('files/bower_components/select2/js/select2.full.min.js')}}"></script>

<!-- Multiselect js -->
<script src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('files/assets/js/jquery.quicksearch.js')}}"></script>

<script src="{{ asset('files/assets/pages/advance-elements/select2-custom.js')}}"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
    $(document).ready(function () {
        
        $('.box').draggable({
            containment: $('#main_bg'),
            drag: function () {
                var offset = $(this).position();

                var xPos = offset.left;
                var yPos = offset.top;
                var no = $(this).attr('atr');
                $.ajax({
                    url: "{{ url('updateseat') }}" + '/' + no + '/' + xPos + '/' + yPos,
                    method: "get",
                    data: {
                        no: no,
                        xPos: xPos,
                        yPos: yPos
                    },
                }).done(function (data) {

                });
            }
        }).click(function () {
            var no = $(this).attr('atr');
            $("#no_table").html(no);
            $("#table_no").val(no);
         
            $.ajax({
                    url: "{{ url('setsession') }}" + '/' + no,
                    method: "get",
                    data: {
                        no: no,
                    },
                }).done(function(data){
                    $('#myselect').html(data.html);
                });
        });

        var currentZoom = 1.0;
        $('#ZoomIn').click(
            function () {
                $('#mainbg').animate({
                    'zoom': currentZoom += .1
                }, 'slow');
            })
        $('#ZoomOut').click(
            function () {
                $('#divName').animate({
                    'zoom': currentZoom -= .1
                }, 'slow');
            })
        $('#btn_ZoomReset').click(
            function () {
                currentZoom = 1.0
                $('#divName').animate({
                    'zoom': 1
                }, 'slow');
            })
    });

    $(document).ready(function () {

        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Upload E-itcket", // Default: Choose File
            label_selected: "Ready", // Default: Change File
            no_label: false // Default: false
        });




    });

    function readURL(input) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#results2').attr('src', e.target.result);
            var img = new Image();
            img.src = e.target.result;
            img.onload = function () {
                var width = img.width;
                var height = img.height;
                $('#canvas').css('width', width);
                $('#canvas').css('height', height);
                $('#width_ticket').val(width);
                $('#heigth_ticket').val(height);
            }
        }
        reader.readAsDataURL(input.files[0]);
    }

    $('#image-upload').on('change', function () {
        readURL(this);
        $('#canvas').css('display', 'block');
        $('#box').css('left', '0');
        $('#box').css('top', '0');

        $('#box1').css('left', '0');
        $('#box1').css('top', '0');

        $('#box2').css('left', '0');
        $('#box2').css('top', '0');

        $('#box3').css('left', '0');
        $('#box3').css('top', '0');

        $('#box4').css('left', '0');
        $('#box4').css('top', '0');

        $('#box5').css('left', '0');
        $('#box5').css('top', '0');

    });

    $('input[name=images_logo]').on('change', function () {
        $("#show-image1").css('display', 'none');
    });

    // $('#size_qr').on('change', function () {
    //     var size = $(this).val();
    //     $("#box3").css('width', size);
    //     $("#box3").css('height', size);
    // });

    $('#font_size').on('change', function () {
        var size = $(this).val();
        $("#box").css('font-size', size + "px");
        $("#box1").css('font-size', size + "px");
        $("#box2").css('font-size', size + "px");
        $("#box3").css('font-size', size + "px");
        $("#box4").css('font-size', size + "px");
        $("#box5").css('font-size', size + "px");

    });

    $('#table2').DataTable();

</script>
<script>
    $('#reverse_stage').click(function () {
        var width = $("#box1").width();
        var height = $("#box1").height();
        if (width > 150) {
            $("#box1").css('width', 100);
            $("#box1").css('height', 300);
        } else {
            $("#box1").css('width', 300);
            $("#box1").css('height', 100);
        }

    });
    $('#add_table2').click(function () {
        var table_name = $("#table_name").val();
        var table_no = $("#table_no1").val();
        var seats = $("#seats").val();
        var token = $("input[name=_token]").val();

        //create an element
        var $element = $('<div class="box" atr="' + table_no +'" data-toggle="modal"  data-target="#default-Modal"  id="box_alert"   />').text(table_no +' : ' + table_name);
        //append it to the DOM
        $("#main_bg").append($element);
        //make it "draggable" and "resizable"
        $element.draggable().resizable().click(function () {
            var no = $(this).attr('atr');
            $("#no_table").html(no);
            // click action here
        });


        $.ajax({
            url: "{{ url('addseat') }}",
            method: "post",
            data: {
                _token: token,
                _method: "POST",
                table_name: table_name,
                table_no: table_no,
                seats:seats
            },
        }).done(function (data) {
            window.location.reload();;
        });

    });

</script>
<script>
    var coordinates = function (element) {
        element = $(element);
        var top = element.position().top;
        var left = element.position().left;
        var width = element.width();
        var height = element.height();
        $('#results').text('X: ' + left + ' ' + 'Y: ' + top);

        $('#stage_x').val(top);
        $('#stage_y').val(left);

        if (width > height) {
            var width2 = width + 75;
            var height2 = height + 35;
        } else {
            var width2 = width + 75;
            var height2 = height + 35;
        }

        $('#width_stage').val(width2);
        $('#height_stage').val(height2);
        // $("#alert_set").html(
        //     '<div class="alert alert-success border-success" style="margin-bottom:0px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont-close-line-circled"></i></button>Ready to Add Value!!</div>'
        // );
    }

    $('#box1').draggable({
        start: function () {
            coordinates('#box1');
        },
        stop: function () {
            coordinates('#box1');
        }
    });

    $('#box2').draggable({
        start: function () {
            coordinates('#box2');
        },
        stop: function () {
            coordinates('#box2');
        }
    });


    $('#set_seating').click(function () {
        var box1 = $('#box1').position();

        if (width > height) {
            var width2 = width + 75;
            var height2 = height + 35;
        } else {
            var width2 = width + 75;
            var height2 = height + 35;
        }
        $('#stage_x').val(box1.top);
        $('#stage_y').val(box1.left);


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
