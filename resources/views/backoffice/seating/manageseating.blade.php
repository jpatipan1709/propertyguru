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
        padding-top: 25px;
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

    ul .list { 
  padding: 0; 
  margin: 0 auto;

  list-style-type: none; 
}

ul li .list { 
  cursor: move;
  margin: 0 3px 3px 3px; 
  padding: 0.3em; 
  
  font-size: 1.25em; 
  height: 2em; 
  
  border: 1px solid #d3d3d3;
	background: #e6e6e6;
}

ul div .list { 
  font-family: FontAwesome;
  font-size: 0.5em;
  letter-spacing: 10px;
  width: 10px;
}

ul .up, ul .down { float: left; }
ul .up:before { content: "\f077"; }
ul .down:before { content: "\f078"; }
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
                                    <h5>Adjust  Seating Planning</h5>
                                </div>
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
                                            <div id="alert_set"></div>

                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{url('deletetable').'/'.$id}}" class="btn btn-outline-danger btn-danger">DELETE TABLE</a>
                                            <button  class="btn btn-outline-success btn-success edit_table" atr="{{$id}}"  data-toggle="modal" data-target="#default-Modal2">EDIT TABLE</button>
                                            <a href="{{url('seatplanning')}}" class="btn btn-outline-inverse btn-inverse">DONE</a>
                                        </div>
                                    </div>
                                    <hr>
                                   <div class="row">
                                       <div class="col-6">
                                        <form action="{{ url('addseat_register') }}" method="post" autocomplete="off"
                                        enctype="multipart/form-data">
                                        {{-- {{ method_field('PUT') }} --}}
                                        @csrf
                                        <table id="table2" class="table table-bordered table-strip table-hover display"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="5%"><input type="checkbox" class="checkAll"
                                                                name="checkAll[]" id="checkAll"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">Company</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                      $registerds = App\Registered::where('rg_seat',null)->where('rg_pj_id',Session::get('id_project'))->get();
                                                      
                                                        // $tables = App\Tables::where('tb_no',$id)->first();
                                                        // $registereds2 = DB::table('tb_register')->whereIn('rg_seat',explode(',',$tables->tb_seat))->get();
                                                @endphp
                                                @foreach ($registerds as $key => $registerd)
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="check_del" name="check_del[]" id="check_del"
                                                            value="{{$registerd->rg_id}}"></td>
                                                    <td>{{$registerd->rg_id}}</td>
                                                    <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                                    <td>{{ $registerd->rg_company }}</td>
                                                </tr>
                                                @endforeach
                                                {{-- <tfoot>
                                                    <tr>
                                                        <th class="text-center" width="5%"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">Company</th>
                                                    </tr>
                                                </tfoot> --}}
                                                </tbody>
                                            </table>
                                        {{-- <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div>
                                                    <label for="project_name"><b>Register List</b> </label>
                                                    @php
                                                    $registereds = App\Registered::where('rg_seat','<>',1)->get();
                                                        $tables = App\Tables::where('tb_no',$id)->first();
                                                        $registereds2 = DB::table('tb_register')->whereIn('rg_seat',explode(',',$tables->tb_seat))->get();
                                                        @endphp


                                                        <select name="myselect[]" id="myselect"
                                                            class="searchable {{ $errors->has('myselect') ? ' is-invalid' : '' }}"
                                                            multiple='multiple'>
                                                            @foreach ($registereds as $key => $registered)
                                                            <option value='{{ $registered->rg_id }}'>
                                                                {{ $registered->rg_name }}
                                                                {{ $registered->rg_lastname }}
                                                                ({{ $registered->rg_company }}) </option>
                                                            @endforeach
                                                            @foreach ($registereds2 as $key2 => $registered2)
                                                            <option value='{{ $registered2->rg_id }}' selected>
                                                                {{ $registered2->rg_name }}
                                                                {{ $registered2->rg_lastname }}
                                                                ({{ $registered2->rg_company }}) </option>
                                                            @endforeach

                                                        </select>

                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="row text-center">
                                            <div class="col-12">
                                            <input type="hidden" name="table_no" value="{{$id}}">
                                                    <button type="submit" id="add_seat" class="btn btn-primary waves-effect ">Add</button>
                                            </div>
                                                
                                        </div>
                                       
                                        </form>
                                        
                                       </div>

                                       <div class="col-6" style="border-left: 1px solid black;">
                                            {{-- <table id="table3" class="table table-bordered table-strip table-hover display"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" width="5%"><input type="checkbox" class="checkAll"
                                                                name="checkAll[]" id="checkAll"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">Company</th>
                                                        <th class="text-center">Sequence</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    //   $registerds = App\Registered::where('rg_seat','<>',1)->get();
                                                        $tables = App\Tables::where('tb_no',$id)->first();
                                                        $registereds2 = DB::table('tb_register')->whereIn('rg_seat',explode(',',$tables->tb_seat))->get();
                                                @endphp
                                                @foreach ($registereds2 as $key => $registerd)
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="check_del" name="check_del[]" id="check_del"
                                                            value="{{$registerd->rg_id}}"></td>
                                                    <td>{{$registerd->rg_id}}</td>
                                                    <td>{{ $registerd->rg_name.' '.$registerd->rg_lastname }}</td>
                                                    <td>{{ $registerd->rg_company }}</td>
                                                    <td><input type="text" name="sequence[]" id="Sequence" value=""></td>
                                                </tr>
                                                @endforeach
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-center" width="5%"></th>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Guest Name</th>
                                                        <th class="text-center">Company</th>
                                                        <th class="text-center">Sequence</th>
                                                    </tr>
                                                </tfoot>
                                                </tbody>
                                            </table> --}}
                                            <form action="{{ url('sorting_seat') }}" method="post" autocomplete="off"
                                            enctype="multipart/form-data">
                                            {{-- {{ method_field('PUT') }} --}}
                                            @csrf
                                            @php
                                                $registerds = App\Registered::where('rg_seat','<>',1)->get();
                                                $tables = App\Tables::where('tb_id',$id)->where('tb_pj_id',Session::get('id_project'))->first();
                                      
                                                
                                                $ex_seats = explode(',',$tables->tb_seat);
                                                $registereds2 = DB::table('tb_register')->where('rg_pj_id',Session::get('id_project'))->whereIn('rg_id',explode(',',$tables->tb_seat))->get();
                                        
                                            @endphp
                                            <h4>Table Name : {{$tables->tb_name}}</h4>
                                             @if ($tables->tb_seat != null)

                                                <ul class="list">
                                                        @foreach ($ex_seats as $key => $ex_seat)
                                                            @php
                                                                $registerd = DB::table('tb_register')->where('rg_pj_id',Session::get('id_project'))->where('rg_id',$ex_seat)->first();
                                                            if($registerd == null){
                                                            $registerd3 = "";
                                                            $registerd4 = "";
                                                            $registerd5 = "";
                                                            }else{
                                                            $registerd3 = $registerd->rg_id;
                                                            $registerd4 = $registerd->rg_name;
                                                            $registerd5 = $registerd->rg_lastname;
                                                            }
                                                            @endphp
                                                           
                                                            <li class="list">
                                                            <p class="text-right"><a href="#" id="delete_seat" atr2="{{$ex_seat}}"  atr="{{ $tables->tb_id}}" class="delete_seat btn btn-mini btn-danger">delete</a></p>
                                                            <input type="hidden" name="sorting_list[]" id="sorting_list" value="{{ $registerd3}}">
                                                            <div class="list">{{$registerd4}} {{$registerd5}}</div>
                                                                No. {{++$key}}
                                                            </li> 
                                                        @endforeach  
                                                </ul>

                                                <div class="row text-center">
                                                    <div class="col-12">
                                                    <input type="hidden" name="table_no" value="{{$id}}">
                                                            <button type="submit" id="add_seat" class="btn btn-primary waves-effect ">Sorting</button>
                                                    </div>
                                                        
                                                </div>
                                            @endif
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
    </div>
</div>



<div class="modal fade" id="default-Modal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit table</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
               
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="table_name">Name Table : </label>
                            <input type="text" name="table_name" id="table_name" value="" class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="limit_table">Limit Person: </label>
                            <input type="number" name="limit_table" id="limit_table" value="" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="table_id" id="table_id" value="" class="form-control">
                    <button type="button" id="edit_table2"  class="btn btn-primary waves-effect ">UPDATE</button>
                    {{-- <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    --}}
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
    $(document).ready(function () {
        $(".edit_table").click(function(){
            var id = $(this).attr('atr');
       
            $.ajax({
                    url: "{{ url('editseat') }}" + '/' + id,
                    method: "get",
                    data: {
                        id: id,
                    },
                }).done(function (data) {
                    console.log(data);
                    $("#table_id").val(data.tables['tb_id']);
                    $("#limit_table").val(data.tables['tb_person']);
                    $("#table_name").val(data.tables['tb_name']);
                });
        });

        $("#edit_table2").click(function(){
            var id =  $("#table_id").val();
            var limit =  $("#limit_table").val();
            var name =  $("#table_name").val();
            $.ajax({
                    url: "{{ url('updateseat2') }}"+'/'+id+'/' + limit+ '/' + name,
                    method: "get",
                    data: {
                        id: id,
                    },
                }).done(function (data) {
                    // console.log(data);
                   window.location.reload();
                });
        });

        $(".delete_seat").click(function(){
            var id =  $(this).attr('atr');
            var seat =  $(this).attr('atr2');
            $.ajax({
                    url: "{{ url('deleteseat') }}"+'/'+id+'/'+seat,
                    method: "get",
                    data: {
                        id: id,
                    },
                }).done(function (data) {
                    console.log(data);
                //    window.location.reload();
                });
        });
        
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        $(function() {
            $( "ul" ).sortable();
            $( "ul" ).disableSelection();
        });

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
                    console.log(data);
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
            }).done(function (data) {
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
    $('#table3').DataTable();
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
        var token = $("input[name=_token]").val();

        //create an element
        var $element = $('<div class="box" atr="' + table_no +
            '" data-toggle="modal"  data-target="#default-Modal"  id="box_alert"   />').text(table_no +
            ' : ' + table_name);
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
                table_no: table_no
            },
        }).done(function (data) {
            window.location.reload();
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

</script>
@endsection
