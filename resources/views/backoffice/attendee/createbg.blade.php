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
<style type="text/css">
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

    #image-preview2 {
        width: 300px;
        height: 300px;
        position: relative;
        overflow: hidden;
        background-color: #ffffff;
        color: #ecf0f1;
        border: #bdc3c7 1px solid;
    }

    #image-preview2 input {
        line-height: 200px;
        font-size: 200px;
        position: absolute;
        opacity: 0;
        z-index: 10;
    }

    #image-preview2 label {
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
                                    <h5>Event Tempalte</h5>
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
                                        <div class="col-6 text-right">
                                            <a href="{{ url('eventtemplate') }}" class="btn btn-inverse btn-outline-inverse">Back</a>
                                        </div>
                                    </div>

                                    <hr>
                                    @if ($projects->pj_image != "" || $projects->pj_image != null)
                                        <form action="{{ url('EditBG') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <div class="form-row justify-content-md-center">
                                                <div class="form-group col-md-4">
                                                    <div id="image-preview">
                                                        <label for="image-upload" id="image-label">Upload BG</label>
                                                      
                                                        <input type="file" name="images_bg" id="image-upload" />
                                                        <input type="hidden" name="project_id" id="project_id" value="{{$id}}"/>
                                                        <img style="width:300px;height:300px;" src="{{ ( isset($projects->pj_image) ? url('storage/event/'.$projects->pj_image) : '') }}"
                                                        alt="" id="show-image1" class="img-responsive">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="result_show"></div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 text-right">
                                                    {{-- <input type="hidden" name="event_id" id="event_id" value="{{  $events->ev_id }}">
                                                    --}}
                                                    <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                                </div>
                                            </div>
                                        </form> 
                                    @else
                                        <form action="{{ url('AddBG') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                            {{-- {{ method_field('PUT') }} --}}
                                            @csrf
                                            <div class="form-row justify-content-md-center">
                                                <div class="form-group col-md-4">
                                                    <div id="image-preview">
                                                        <label for="image-upload" id="image-label">Upload BG</label>
                                                        <input type="file" name="images_bg" id="image-upload" />
                                                        <input type="hidden" name="project_id" id="project_id" value="{{$id}}"/>
                                                        <img src="" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="result_show"></div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12 text-right">
                                                    {{-- <input type="hidden" name="event_id" id="event_id" value="{{  $events->ev_id }}">
                                                    --}}
                                                    <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                                </div>
                                            </div>
                                        </form> 
                                    @endif
                                    
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
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>

<!-- Select 2 js -->
<script src="{{ asset('files/bower_components/select2/js/select2.full.min.js')}}"></script>

<!-- Multiselect js -->
<script src="{{ asset('files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
<script src="{{ asset('files/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('files/assets/js/jquery.quicksearch.js')}}"></script>

<!-- ck editor -->
<script src="{{ asset('files/assets/pages/ckeditor/ckeditor.js')}}"></script>

<!-- Custom js -->
{{-- <script src="{{ asset('files/assets/pages/ckeditor/ckeditor-custom.js')}}"></script> --}}
<script src="{{ asset('files/assets/pages/advance-elements/select2-custom.js')}}"></script>

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
<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
<script>
    $('input[name=images_bg]').on('change', function () {
        $("#show-image1").css('display', 'none');
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Upload Logo", // Default: Choose File
            label_selected: "Ready", // Default: Change File
            no_label: false // Default: false
        });
    });

</script>
<script>
    function myFunction() {
        var myselect = $("#myselect").val();
        var token = $("input[name=_token]").val();
        $.ajax({
            url: "{{ url('showdateandttime') }}",
            type: "post",
            data: {
                _method: "post",
                _token: token,
                myselect: myselect
            },
        }).done(function (data) {
            console.log(data);
            $("#result_show").html(data)
        });
    }
</script>
@endsection
