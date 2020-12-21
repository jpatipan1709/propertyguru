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
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">

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
                                    <form action="{{ url('eventtemplate',$attendees->atd_id) }}" method="post"
                                        autocomplete="off" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <input type="hidden" name="attendee_id" id="attendee_id" value="{{ $attendees->atd_id }}">
                                        <div class="form-row justify-content-md-center">
                                            <div class="form-group col-md-4">
                                                <div id="image-preview">
                                                    <label for="image-upload" id="image-label">Upload Logo</label>
                                                    <input type="file" name="images_logo" id="image-upload" />
                                                    <img style="width:300px;height: 300px;" src="{{ url('storage/event/'.$attendees->atd_image) }}"
                                                        alt="" id="show-image1" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div>
                                                    <label for="project_name"><b>Event List</b> </label>
                                                    <select name="myselect[]" id="myselect" class="searchable {{ $errors->has('myselect') ? ' is-invalid' : '' }}"
                                                        multiple='multiple' onchange="myFunction()">
                                                        @php
                                                        $ex_events = explode(',',$attendees->atd_ev_sel )
                                                        @endphp
                                                        @foreach ($events as $event)
                                                        <option value='{{ $event->ev_id }}' @foreach ($ex_events as
                                                            $ex_event)
                                                            {{($ex_event == $event->ev_id) ? 'selected':'' }}
                                                            @endforeach>{{ $event->ev_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="agenda_title"> <b>Event Title</b></label>
                                                <input type="text" class="form-control {{ $errors->has('agenda_title') ? ' is-invalid' : '' }}"
                                                    id="agenda_title" name="agenda_title" placeholder="Event Title"
                                                    value="{{$attendees->atd_title}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="agenda_content"> <b>Event Content</b></label>
                                                <textarea type="text" class="form-control {{ $errors->has('agenda_content') ? ' is-invalid' : '' }}"
                                                    id="agenda_content" name="agenda_content" placeholder="Event Content">{{$attendees->atd_content}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="galadinner"> <b>Gala dinner & Awards Ceremony</b></label>
                                                <input type="text" class="form-control {{ $errors->has('galadinner') ? ' is-invalid' : '' }}"
                                                    id="galadinner" name="galadinner" placeholder="Gala dinner & Awards Ceremony"
                                                    value="{{$attendees->atd_type}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="venueofevent"> <b>Venue of event</b></label>
                                                <input type="text" class="form-control {{ $errors->has('venueofevent') ? ' is-invalid' : '' }}"
                                                    id="venueofevent" name="venueofevent" placeholder="Venue of event"
                                                    value="{{$attendees->atd_venue}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="agenda_map"> <b>Map</b></label>
                                                <textarea id="agenda_map" class="form-control {{ $errors->has('agenda_map') ? ' is-invalid' : '' }}"
                                                    name="agenda_map">{{$attendees->atd_map}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <div>
                                                    <p><b>Use Color master<b></p>
                                                    <input type='hidden' value='0' name='use_color'>
                                                    <input type="checkbox" name="use_color" id="use_color" class="js-single"
                                                        @if (old('use_color') !="" ) {{'checked'}} @endif value="1"
                                                        @if($attendees->atd_use_color == 1) {{'checked'}} @endif/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="border_agenda"> <b>Master Color</b></label>
                                                <select name="border_agenda" id="border_agenda" class="form-control"
                                                    style="background-color: {{ $attendees->atd_use_color == 0 ? '#bc9c2f' :  $attendees->atd_border }};color:white;"
                                                    onchange="myFunction2()">
                                                    @foreach ($colors as $color)
                                                    <option value="{{ $color->cl_name }}" @if($attendees->atd_border ==
                                                        $color->cl_name) {{'selected'}} @endif> {{ $color->cl_name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="border_pick"> <b>Picker Color</b></label>
                                                <input type="text" id="text-field" class="form-control demo {{ $errors->has('border_pick') ? ' is-invalid' : '' }}"
                                                    name="border_pick" value="{{ $attendees->atd_use_color != 0 ? '' :  $attendees->atd_border }}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div id="result_show">
                                            <div class="wrapper">
                                                {{-- <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button type="button" class="btn btn-success btn-outline-success clone">ADD</button>
                                                        <button type="button" class="btn btn-warning btn-outline-warning remove">REMOVE</button>
                                                    </div>
                                                </div>
                                                <br> --}}
                                                @php
                                                $attendeedetails =
                                                App\AttendeeDetail::where('atdt_agd_id',$attendees->atd_id)->leftjoin('tb_attendee','tb_attendee_details.atdt_id','=','tb_attendee.atd_id')->get();
                                                @endphp
                                                @foreach ($attendeedetails as $attendeedetail)
                                                <div class="element">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="dateofeventstart"> <b>Date of event</b></label>
                                                            <input type="date" class="form-control" id="dateofevent"
                                                                name="dateofeventstart[]" placeholder="Date of event Start"
                                                                value="{{ $attendeedetail->atdt_date }}" readonly>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="time_agenda1"> <b>Time End</b></label>
                                                            <input type="time" class="form-control" id="time_agenda1"
                                                                name="time_agenda1[]" placeholder="Time" value="{{ $attendeedetail->atdt_time_from }}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="time_agenda2"> <b>Time End</b></label>
                                                            <input type="time" class="form-control" id="time_agenda2"
                                                                name="time_agenda2[]" placeholder="Time" value="{{ $attendeedetail->atdt_time_to }}"
                                                                readonly>
                                                        </div>
                                                    </div>


                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Default Modal</h5>
                <p>This is Photoshop's version of Lorem IpThis is Photoshop's version of Lorem Ipsum. Proin gravida
                    nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat
                    ipsum, nec sagittis sem nibh id elit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
    $('.wrapper').on('click', '.remove', function () {
        var test = $('.remove').closest('.wrapper').find('.element').not(':first').last().remove();
        console.log(test);
    });

    $('.wrapper').on('click', '.clone', function () {
        var test = $('.clone').closest('.wrapper').find('.element').first().clone().appendTo('.results');
        console.log(test);
    });

</script>
<script>
    $('input[name=images_logo]').on('change', function () {
        $("#show-image1").css('display', 'none');
    });

    $('input[name=image_bg]').on('change', function () {
        $("#show-image2").css('display', 'none');
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

        $.uploadPreview({
            input_field: "#image-upload2", // Default: .image-upload
            preview_box: "#image-preview2", // Default: .image-preview
            label_field: "#image-label2", // Default: .image-label
            label_default: "Upload Background", // Default: Choose File
            label_selected: "Ready", // Default: Change File
            no_label: false // Default: false
        });


    });

    $(document).ready(function() {
        $('#agenda_content').summernote({
            tabsize: 2,
            height: 400,
            popover: {
                image: [],
                link: [],
                air: []
            }
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
            $("#result_show").html(data)
            console.log(data);
        });
    }

    function myFunction2() {
        var border_agenda = $("#border_agenda").val();
        var token = $("input[name=_token]").val();
        var att_id = $("#attendee_id").val();
        $.ajax({
            url: "{{ url('showcolor') }}",
            type: "post",
            data: {
                _method: "post",
                _token: token,
                border_agenda: border_agenda,
                att_id:att_id
            },
        }).done(function (data) {
            $('#border_agenda').css('background-color', data);
        });
    }

</script>
@endsection
