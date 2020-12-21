@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
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

</style>
@php
$active = 'mail';
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
                                    <h5>Email Tempalte</h5>
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
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="{{ url('email') }}" class="btn btn-inverse btn-outline-inverse">Back</a>
                                        </div>
                                    </div>

                                    <hr>
                                    @if (isset($mails))
                                    {{-- {{dd($mails)}} --}}
                                    <form action="{{ url('email',$id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="form-row justify-content-md-center">
                                            <div class="form-group col-md-4">
                                                <div id="image-preview">
                                                    <label for="image-upload" id="image-label">Upload Logo</label>
                                                    <input type="file" name="images_logo" id="image-upload" />
                                                    <img style="width:300px;height:300px;" src="{{ ( isset($mails->tbm_logo) ? url('storage/email/'.$mails->tbm_logo) : '') }}"
                                                        alt="" id="show-image1" class="img-responsive" >

                                                </div>
                                                {{-- <div id="image-preview">
                                                    <img src="{{ (isset($mails->tbm_logo) ? url('storage/email/'. $mails->tbm_logo) : '' )   }}"
                                                        style="width:300px;height: 300px;" class="img-responsive" class="image" />
                                                    <label for="image-upload" id="image-label">Upload Logo</label>
                                                    <input type="file" name="images_logo" id="image-upload" required />
                                                </div> --}}
                                            </div>
                                        </div>
                                       
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="border_pick"> <b>Picker Color </b></label>
                                                <input type="text" id="text-field" class="form-control demo {{ $errors->has('border_pick') ? ' is-invalid' : '' }}"
                                                    name="border_pick" value="{{ ( isset($mails->tbm_color) ?  $mails->tbm_color : '') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="content">Content E-mail</label>
                                                <textarea ype="text" class="form-control" id="content" name="content"
                                                    placeholder="Content E-mail" autocomplete="off" >{{ ( isset($mails->tbm_content) ?  $mails->tbm_content : '') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <input type="hidden" name="id" id="id" value="{{$id}}" />
                                                <input type="hidden" name="type_upload" id="type_upload" value="update" />
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Update
                                                    Template</button>
                                            </div>
                                        </div>
                                    </form>

                                    @else
                                    <form action="{{ url('email') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                        {{-- {{ method_field('PUT') }} --}}
                                        @csrf
                                        <div class="form-row justify-content-md-center">
                                            <div class="form-group col-md-4">
                                                <div id="image-preview">
                                                    <label for="image-upload" id="image-label">Upload Logo</label>
                                                    <input type="file" name="images_logo" id="image-upload" required/>
                                                    <img style="width:300px;height:300px;" src="" alt="" id="show-image1"
                                                        class="img-responsive">
                                                </div>
                                                {{-- <div id="image-preview">
                                                    <img src="{{ (isset($mails->tbm_logo) ? url('storage/email/'. $mails->tbm_logo) : '' )   }}"
                                                        style="width:300px;height: 300px;" class="img-responsive" class="image" />
                                                    <label for="image-upload" id="image-label">Upload Logo</label>
                                                    <input type="file" name="images_logo" id="image-upload" required />
                                                </div> --}}
                                            </div>
                                        </div>
                                            <div class="form-row">
                                                
                                                <div class="form-group col-md-3">
                                                    <label for="border_pick"> <b>Picker Color</b></label>
                                                    <input type="text" id="text-field" class="form-control demo {{ $errors->has('border_pick') ? ' is-invalid' : '' }}"
                                                        name="border_pick" value="{{ old('border_pick') }}" required>
                                                </div>
                                            </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="content">Content E-mail</label>
                                                <textarea class="form-control" id="content" name="content" placeholder="Content E-mail"
                                                    autocomplete="off" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <input type="hidden" name="id" id="id" value="{{$id}}" />
                                                <input type="hidden" name="type_upload" id="type_upload" value="add" />
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Add
                                                    Template</button>
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
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

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
    $("#name_input").keyup(function () {
        var name_input = $("#name_input").val();
        $("#id_input").val(name_input);
    });

    $('#table2').DataTable();
    $('#table3').DataTable();

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

    $('input[name=images_logo]').on('change', function () {
        $("#show-image1").css('display', 'none');
    });

    $(document).ready(function () {
        $('#content').summernote({
            tabsize: 2,
            height: 700,
            popover: {
                image: [],
                link: [],
                air: []
            },
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });

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

    function myFunction2() {
        var border_agenda = $("#border_agenda").val();
        var token = $("input[name=_token]").val();
        // console.log(border_agenda);
        $.ajax({
            url: "{{ url('showcolor') }}",
            type: "post",
            data: {
                _method: "post",
                _token: token,
                border_agenda: border_agenda
            },
        }).done(function (data) {
            $('#border_agenda').css('background-color', data);
        });
    }

</script>
@endsection
