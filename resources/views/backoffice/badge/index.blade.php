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
<!-- Color Picker css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/spectrum/css/spectrum.css')}}" />
<!-- Mini-color css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/jquery-minicolors/css/jquery.minicolors.css')}}" />

@endsection
@section('content')
<style>
    #canvas {
    width: 400px;
    height: 200px;
    position: relative;
    margin: 2em auto;
    background-color:cornsilk;
}

#box {
    position: absolute;
    height: 18px;
    /* background: red; */
    cursor: move;
    color:black;
    font-size:14px;
}
#box1 {
    position: absolute;
    height: 18px;
    /* background: orange; */
    cursor: move;
    color:black;
    font-size:14px;
}
#box2 {
    position: absolute;
    height: 18px;
    /* background: green; */
    cursor: move;
    color:black;
    font-size:14px;
}
#box3 {
    position: absolute;
    height: 18px;
    /* background: green; */
    cursor: move;
    color:black;
    font-size:14px;
}

#box4 {
    position: absolute;
    height: 18px;
    /* background: green; */
    cursor: move;
    color:white;
    width: 130px;
    height: 130px;
    background: blue;
    font-size:14px;
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
</style>
@php
$active = 'card';
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
                                    <h5>Badge Tempalte</h5>
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
                                    </div>

                                    <hr>
                                    <div id="alert_set"></div>
                                    <br>
                                    <form action="{{url('badge')}}" method="post" autocomplete="off" enctype="multipart/form-data"
                                        accept="image/png, image/jpeg">
                                        @csrf
                                        <div class="form-row justify-content-md-center">

                                                <div class="form-group col-md-4">
                                                    <div id="image-preview">
                                                        <label for="image-upload" id="image-label">Upload Images</label>
                                                        <input type="file" name="images_logo" id="image-upload" />
                                                        <img style="width:300px;height:300px;" src="{{ count($tickets) >= 1 ?  url('storage/ticket/'.$tickets[0]->b_images) : '' }}"
                                                            alt="" id="show-image1" class="img-responsive">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                {{-- <label for="width_box1">Top FirstName :</label> --}}
                                                <input type="hidden" class="form-control" name="width_box1" id="width_box1"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_name_x: '' }}"
                                                    required readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{-- <label for="heigth_box1">Left FirstName :</label> --}}
                                                <input type="hidden" class="form-control" name="heigth_box1" id="heigth_box1"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_name_y: '' }}"
                                                    required readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{-- <label for="width_box2">Top LastName :</label> --}}
                                                <input type="hidden" class="form-control" name="width_box2" id="width_box2"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_lastname_x: '' }}"
                                                    required readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{-- <label for="heigth_box2">Left LastName :</label> --}}
                                                <input type="hidden" class="form-control" name="heigth_box2" id="heigth_box2"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_lastname_y: '' }}"
                                                    required readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                {{-- <label for="width_box3">Top Company :</label> --}}
                                                <input type="hidden" class="form-control" name="width_box3" id="width_box3"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_company_x	: '' }}"
                                                    required readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{-- <label for="heigth_box3">Left Company :</label> --}}
                                                <input type="hidden" class="form-control" name="heigth_box3" id="heigth_box3"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_company_y: '' }}"
                                                    required readonly>
                                            </div>

                                            <div class="form-group col-md-3">
                                                {{-- <label for="width_box4">Top QR CODE :</label> --}}
                                                <input type="hidden" class="form-control" name="width_box4" id="width_box4"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_department_x: '' }}"
                                                    readonly readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                {{-- <label for="heigth_box4">Left QR CODE :</label> --}}
                                                <input type="hidden" class="form-control" name="heigth_box4" id="heigth_box4"
                                                    value="{{ count($tickets) >= 1 ? $tickets[0]->b_department_y: '' }}"
                                                    required readonly>
                                            </div>
                                            
                                            <div class="form-group col-md-3">
                                                    {{-- <label for="width_box4">Top QR CODE :</label> --}}
                                                    <input type="hidden" class="form-control" name="width_box5" id="width_box5"
                                                        value="{{ count($tickets) >= 1 ? $tickets[0]->b_images_x: '' }}"
                                                        readonly readonly>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    {{-- <label for="heigth_box4">Left QR CODE :</label> --}}
                                                    <input type="hidden" class="form-control" name="heigth_box5" id="heigth_box5"
                                                        value="{{ count($tickets) >= 1 ? $tickets[0]->b_images_y: '' }}"
                                                        required readonly>
                                                </div>
                                        </div>

                                        <div class="form-row">
                                                <div class="form-group ">
                                                    {{-- <label for=""><b>Width</b></label> --}}
                                                    <input type="hidden" id="width_size" class="form-control" name="width_size" value="{{ count($tickets) >= 1 ? $tickets[0]->b_width: '400' }}" >
                                                </div>
                                                <div class="form-group" style="margin-left:25px;">
                                                    {{-- <label for=""><b>Height</b></label> --}}
                                                    <input type="hidden" id="height_size" class="form-control" name="height_size" value="{{ count($tickets) >= 1 ? $tickets[0]->b_height: '200' }}" >
                                                </div>
                                            </div>
                                        <div class="form-row">
                                            <div class="form-group ">
                                                <label for=""><b>Color Font</b></label>
                                                <input type="text" id="text-field" id="border_pick" class="form-control demo {{ $errors->has('border_pick') ? ' is-invalid' : '' }}"
                                                    name="border_pick" value="{{ count($tickets) >= 1 ? $tickets[0]->b_color: '' }}">
                                            </div>
                                            <div class="form-group" style="margin-left:25px;">
                                                <label for=""><b>Font Size</b></label>
                                                <select name="font_size" id="font_size" class="form-control">
                                                    <option value="10"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 10 ? 'selected' : '')  : ''  }}>10</option>
                                                    <option value="14"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 14 ? 'selected' : '')  : ''  }}>14</option>
                                                    <option value="16"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 16 ? 'selected' : '')  : ''  }}>16</option>
                                                    <option value="18"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 18 ? 'selected' : '')  : ''  }}>18</option>
                                                    <option value="20"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 20 ? 'selected' : '')  : ''  }}>20</option>
                                                    <option value="22"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 22 ? 'selected' : '')  : ''  }}>22</option>
                                                    <option value="24"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 24 ? 'selected' : '')  : ''  }}>24</option>
                                                    <option value="26"
                                                        {{ (count($tickets) >= 1) ? ($tickets[0]->b_size == 26 ? 'selected' : '')  : ''  }}>26</option>
                                                </select>
                                            </div>
                                            <div class="form-group" style="margin-left:25px;">
                                                    <label for=""><b>Size Images (pixel)</b></label>
                                                    <input type="number" name="font_size_images" id="font_size_images" class="form-control" value="{{ (count($tickets) >= 1) ? $tickets[0]->b_images_size : '120'  }}">
                                                </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-7 text-right">
                                                    <button type="button" id="get_form" class="btn btn-primary">Preview</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                {{-- <a href="{{url('PreviewBadge')}}" class="btn btn-primary">Preview Badge</a> --}}
                                            </div>
                                        </div>
                                        <hr>
                                       
                                        <h5 style="margin-left:570.203px;"> Preview Badge</h5>
                                        <div id="canvas">
                                            
                                            <div id="box" style="{{ count($tickets) >= 1 ? 'left:'.$tickets[0]->b_name_y.'px;'.'top:'.$tickets[0]->b_name_x.'px;font-size:'.$tickets[0]->b_size.'px;color:'.$tickets[0]->b_color : '' }}">
                                                [FirstName]</div>
                                            <div id="box1" style="{{ count($tickets) >= 1 ? 'left:'.$tickets[0]->b_lastname_y.'px;'.'top:'.$tickets[0]->b_lastname_x.'px;'.'px;font-size:'.$tickets[0]->b_size.'px;color:'.$tickets[0]->b_color : '' }}">
                                                [LastName]</div>
                                            <div id="box2" style="{{ count($tickets) >= 1 ? 'left:'.$tickets[0]->b_company_y.'px;'.'top:'.$tickets[0]->b_company_x.'px;'.'px;font-size:'.$tickets[0]->b_size.'px;color:'.$tickets[0]->b_color : '' }}">
                                                [CompanyName]</div>
                                            <div id="box3" style="{{ count($tickets) >= 1 ? 'left:'.$tickets[0]->b_department_y.'px;'.'top:'.$tickets[0]->b_department_x.'px;'.'px;font-size:'.$tickets[0]->b_size.'px;color:'.$tickets[0]->b_color : '' }}">
                                                [DeperimentPersonal] </div>

                                            <div id="box4" style="{{ count($tickets) >= 1 ? 'left:'.$tickets[0]->b_images_y.'px;'.'top:'.$tickets[0]->b_images_x.'px;width:'.$tickets[0]->b_images_size.'px;height:'.$tickets[0]->b_images_size.'px' : '' }}">
                                                [Images] </div>
                                        </div>

                                        <div id="results"> </div>


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
<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
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
<script>
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

   
    $('input[name=images_logo]').on('change', function () {
        $("#show-image1").css('display', 'none');
    });

    $('#size_qr').on('change', function () {
        var size = $(this).val();
        $("#box3").css('width', size);
        $("#box3").css('height', size);
    });

    $('#font_size').on('change', function () {
        var size = $(this).val();
        $("#box").css('font-size', size + "px");
        $("#box1").css('font-size', size + "px");
        $("#box2").css('font-size', size + "px");
        $("#box3").css('font-size', size + "px");
        $("#box4").css('font-size', size + "px");
    });

    $('#table2').DataTable();

    $("#font_size_images").keyup(function(){
        var size_images = $(this).val();
        $("#box4").css('width', size_images + "px");
        $("#box4").css('height', size_images + "px");
        $("#box4").css('font-size', size_images/5 + "px");
    });
</script>
<script>
    var coordinates = function (element) {
        element = $(element);
        var top = element.position().top;
        var left = element.position().left;
        $('#results').text('X: ' + left + ' ' + 'Y: ' + top);
    }

    $('#box').draggable({
        start: function () {
            coordinates('#box');
        },
        stop: function () {
            coordinates('#box');
        }
    });

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


    $('#box3').draggable({
        start: function () {
            coordinates('#box3');
        },
        stop: function () {
            coordinates('#box3');
        }
    });

    $('#box4').draggable({
        start: function () {
            coordinates('#box3');
        },
        stop: function () {
            coordinates('#box3');
        }
    });

    $('#get_form').click(function () {
        var box1 = $('#box').position();
        var box2 = $('#box1').position();
        var box3 = $('#box2').position();
        var box4 = $('#box3').position();
        var box5 = $('#box4').position();

        $('#width_box1').val(box1.top);
        $('#heigth_box1').val(box1.left);
        $('#width_box2').val(box2.top);
        $('#heigth_box2').val(box2.left);
        $('#width_box3').val(box3.top);
        $('#heigth_box3').val(box3.left);
        $('#width_box4').val(box4.top);
        $('#heigth_box4').val(box4.left);
        $('#width_box5').val(box5.top);
        $('#heigth_box5').val(box5.left);
        $("#alert_set").html(
            '<div class="alert alert-success border-success" style="margin-bottom:0px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont-close-line-circled"></i></button>Ready to Add Value!!</div>'
        );
    });

</script>
@endsection
