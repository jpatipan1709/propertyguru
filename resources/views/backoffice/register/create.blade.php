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
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" />
@endsection
@section('content')
<style>
    .bg-gold {
        background: linear-gradient(to right, #871619, #871619);
        border: 2px solid #fff;
        outline: 5px solid #871619;
        color: #fff;
    }

    .form-check-input {
        position: absolute;
        margin-top: .25rem;
        margin-left: 0rem;
    }

</style>
@php
$active = 'registered';
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
                                    <h5>Registered Create</h5>
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
                                        </div>
                                    </div>
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
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Project Name :</b> {{ Session::get('project_name') }}
                                        </div>
                                        <div class="col-6 text-right">
                                            {{-- <button type="button" class="btn btn-success btn-outline-success waves-effect"
                                                data-toggle="modal" data-target="#default-Modal">Import Register</button>
                                            --}}
                                            {{-- <a class="btn btn-success btn-outline-success">Import Register</a>
                                            --}}
                                            <a href="{{ url('registered') }}"
                                                class="btn btn-inverse btn-outline-inverse">Back</a>
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-6">
                                            <i class="fa fa-user" aria-hidden="true"></i> ( 1 / {{$number_personal}} )
                                    Personal
                                </div>
                            </div> --}}

                            {{-- @php
                                    $project = App\Projects::where('pj_id',Session::get('id_project'))->get();
                                    @endphp

                                    @if ($project[0]->pj_status != 1)
                                    @php
                                    $events = App\Events::where('ev_pj_id',Session::get('id_project'))->get();
                                    @endphp
                                    @php
                                    $project = App\Projects::where('pj_id',Session::get('id_project'))->get();
                                    if($project[0]->pj_status == 1){
                                    $events =
                                    App\Events::where('ev_pj_id',$id)->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
                                    }else{
                                    $events =
                                    App\Events::where('ev_id',$id)->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
                                    }
                                    @endphp--}}

                            @php
                            $events =
                            App\Events::where('ev_pj_id',Session::get('id_project'))->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
                            @endphp
                            <form action="{{ url('registered') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="p-3 bg-gold" style="margin-bottom:25px;">
                                            <h4 class="font-weight-bold text-white">Select event</h4>
                                            @foreach ($events as $key => $event)
                                            @php
                                            $date = date_create($event->ev_date_start);
                                            $time1 = date_create($event->ev_time_start);
                                            $time2 = date_create($event->ev_time_end);
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="event_sel[]"
                                                    id="exampleRadios1" value="{{ $event->ev_id }}"
                                                    {{ old('event_sel.'.$key) ==  $event->ev_id  }}>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    {{ $event->ev_name }} :
                                                    <br>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i> {{
                                                            date_format($date,"d/m/Y") }}
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    {{ date_format($time1,"H:i") }} - {{
                                                            date_format($time2,"H:i") }}
                                                  
                                                    {!! isset($attendee->atd_venue) ?  '  <i class="fa fa-map-marker" aria-hidden="true"></i>'. $attendee->atd_venue  : '' !!}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fisrt_name">Type of Person</label>
                                        <select name="type_personal" id="type_personal" class="form-control" required>
                                            <option value="">------ Please Choose Type of Person -------</option>
                                            @php
                                            $typepersonals = App\TypePersonal::all();
                                            @endphp
                                            @foreach ($typepersonals as $typepersonal)
                                            <option value="{{ $typepersonal->tps_id }}"
                                                {{ old('type_personal') == $typepersonal->tps_id ? 'selected' : ''}}>{{
                                                        $typepersonal->tps_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fisrt_name">First name</label>
                                        <input type="text" class="form-control" id="fisrt_name" name="fisrt_name"
                                            placeholder="First name" autocomplete="off" value="{{old('fisrt_name')}}"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastname">Last name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                            placeholder="Last name" autocomplete="off" value="{{old('lastname')}}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="project_name">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                            placeholder="E-mail" autocomplete="off" value="{{old('email')}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cc_email">CC E-mail</label>
                                        <input type="email" class="form-control" id="cc_email" name="cc_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                            placeholder="CC E-mail" autocomplete="off" value="{{old('cc_email')}}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="cc_status">Send e-mail to</label>
                                        <select name="cc_status" id="cc_status" class="form-control" required>
                                            <option value="">------ Please Choose CC E-mail -------</option>
                                            <option value="1"{{ old('cc_status') ==1 ? 'selected' : ''}}>Send to primary e-mail</option>
                                            <option value="2"{{ old('cc_status') ==2 ? 'selected' : ''}}>Send to cc e-mail</option>
                                            <option value="3"{{ old('cc_status') ==3 ? 'selected' : ''}}>Send to both e-mails</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="project_name">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Phone" autocomplete="off" value="{{old('phone')}}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="company_name">Company name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            placeholder="Company name" autocomplete="off"
                                            value="{{old('company_name')}}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="address">Address</label>
                                        <div id="locationField">
                                            <input id="autocomplete" name="address" class="form-control"
                                                placeholder="Enter your address" onFocus="geolocate()" type="text"
                                                autocomplete="off" required value="{{old('address')}}" />
                                        </div>
                                        {{-- <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Address" autocomplete="off" required value="{{old('address')}}">
                                        --}}

                                        {{-- <table id="address">
                                                            <tr>
                                                              <td class="label">Street address</td>
                                                              <td class="slimField"></td>
                                                              <td class="wideField" colspan="2"><input class="field" id="route" disabled="true"/></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="label">City</td>
                                                              <td class="wideField" colspan="3"></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="label">State</td>
                                                              <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true"/></td>
                                                              <td class="label">Zip code</td>
                                                              <td class="wideField"><input class="field" id="postal_code" disabled="true"/></td>
                                                            </tr>
                                                            <tr>
                                                              <td class="label">Country</td>
                                                              <td class="wideField" colspan="3"><input class="field" id="country" disabled="true"/></td>
                                                            </tr>
                                                          </table> --}}
                                    </div>
                                    {{-- <div class="form-group col-md-4">
                                                    <label for="company_name">Street address</label>
                                                    <input  class="field form-control"  id="street_number" disabled="true" readonly/>

                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label for="company_name">Route</label>
                                                    <input class="field form-control" id="route" disabled="true" readonly/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label for="company_name">City</label>
                                                    <input class="field form-control" id="locality" disabled="true" readonly/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label for="company_name">State</label>
                                                    <input class="field form-control" id="administrative_area_level_1" disabled="true" readonly/>
                                            </div>
                                            <div class="form-group col-md-4">
                                                    <label for="company_name">Zip code</label>
                                                    <input class="field form-control" id="postal_code" disabled="true" readonly/>
                                            </div> --}}
                                    <div class="form-group col-md-4">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" id="country" name="country"
                                            placeholder="Country" autocomplete="off" required
                                            value="{{old('country')}}">
                                        {{-- <select name="country" id="inputCountry" class="form-control" required>
                                                        <option value="">--- Please Choose Country---</option>
                                                        @foreach ($countrys as $country)
                                                        <option value="{{ $country->ct_id }}"
                                        {{ old('job_title') == $country->ct_id ? 'selected' : '' }}>{{
                                                            $country->ct_name }}</option>
                                        @endforeach
                                        </select> --}}
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="job_title">Job title</label>
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                            placeholder="Job title" autocomplete="off" required
                                            value="{{old('job_title')}}" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="dietary_re">Dietary requirement</label>
                                        <textarea type="text" class="form-control" id="dietary_re" name="dietary_re"
                                            placeholder="Dietary requirement"
                                            autocomplete="off">{{old('dietary_re')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="remark1">Remark 1</label>
                                        <textarea type="text" class="form-control" id="remark1" name="remark1"
                                            placeholder="Remark 1" autocomplete="off">{{old('remark1')}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="remark2">Remark 2</label>
                                        <textarea type="text" class="form-control" id="remark2" name="remark2"
                                            placeholder="Remark 2" autocomplete="off">{{old('remark2')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12 text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-outline-primary">Register</button>
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

<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('uploadimport') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h6>Select file for upload (.xls, .xlxs)</h6>
                    <br>
                    <input type="file" name="upload_file" id="upload_file"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Upload</button>
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                </div>
            </form>
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
{{-- <script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script> --}}
{{-- <script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<script>
    $('#table2').DataTable();
    $("#event_name").change(function () {
        var event_id = $(this).val();
        alert(event_id);
    });
    $(document).ready(function () {
        $('#inputCountry').change(function () {
            var test = $('#inputCountry').val();
            if (test == 15) {
                // alert('block');
                $('#other_id').css('display', 'block');
            } else {
                // alert('none');
                $('#other_id').css('display', 'none');
            }
        });

    });

</script>
<script>
    // This sample uses the Autocomplete widget to help the user select a
    // place, then it retrieves the address components associated with that
    // place, and then it populates the form fields with those details.
    // This sample requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script
    // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;

    var componentForm = {
        //   street_number: 'long_name',
        //   route: 'long_name',
        //   locality: 'long_name',
        //   administrative_area_level_1: 'long_name',
        country: 'long_name',
        //   postal_code: 'long_name'
    };
    console.log(componentForm);

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {
                types: ['geocode']
            });

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields('address_components');

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV1YcC1yu84_5gpNikcyoSB6xdtJH8Dl8&libraries=places&callback=initAutocomplete"
    async defer></script>
    <script>
    $('input').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.,@!#$%&'*+/=?^_`{|}~-]{1,}$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });

    $('textarea').bind('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z0-9.,@!#$%&'*+/=?^_`{|}~-]{1,}$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });

    $('input[name=phone]').bind('keypress', function (event) {
        var regex = new RegExp("^[0-9.-]{1,}$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
        event.preventDefault();
        return false;
        }
    });
    </script>
@endsection
