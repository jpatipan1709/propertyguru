@extends('backoffice.layouts.master')
@section('css')
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/switchery/css/switchery.min.css')}}">
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
                                            {{-- <button type="button" class="btn btn-success btn-outline-success waves-effect"
                                                data-toggle="modal" data-target="#default-Modal">Import Register</button>
                                            --}}
                                            {{-- <a class="btn btn-success btn-outline-success">Import Register</a>
                                            --}}
                                            <a href="{{ url('registered') }}" class="btn btn-inverse btn-outline-inverse">Back</a>
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
                                    <form action="{{ url('registered',$registered->rg_id) }}" method="post">
                                        
                                        {{ method_field('PUT') }}
                                        @php
                                            $ex_sels = explode(',',$registered->rg_event_id);
                                        @endphp
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
                                                            @foreach ($ex_sels as $ex_sel)
                                                                {{  $ex_sel == $event->ev_id ? 'checked' : '' }}
                                                            @endforeach
                                                            
                                                            >
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            {{ $event->ev_name }} :
                                                            <br>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i> {{
                                                            date_format($date,"d/m/Y") }}
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            {{ date_format($time1,"H:i") }} - {{
                                                            date_format($time2,"H:i") }}
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            {{ $attendee->atd_venue }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="fisrt_name">Type of Person</label>
                                                <select name="type_personal" id="type_personal" class="form-control"
                                                    required>
                                                    <option value="">------ Please Choose Type of Person -------</option>
                                                    @php
                                                    $typepersonals = App\TypePersonal::all();
                                                    @endphp
                                                    @foreach ($typepersonals as $typepersonal)
                                                    <option value="{{ $typepersonal->tps_id }}" {{ $registered->rg_type_personal == $typepersonal->tps_id ? 'selected' :'' }}>
                                                        {{$typepersonal->tps_name }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="fisrt_name">First name</label>
                                                <input type="text" class="form-control" id="fisrt_name" name="fisrt_name"
                                            placeholder="First name" autocomplete="off" value="{{$registered->rg_name}}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="lastname">Last name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    placeholder="Last name" autocomplete="off" value="{{$registered->rg_lastname}}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="project_name">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                                    placeholder="E-mail" autocomplete="off" value="{{$registered->rg_email}}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cc_email">CC E-mail</label>
                                                <input type="email" class="form-control" id="cc_email" name="cc_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                                    placeholder="CC E-mail" autocomplete="off" value="{{$registered->rg_cc_email}}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="cc_status">Send e-mail to</label>
                                                <select name="cc_status" id="cc_status" class="form-control" required>
                                                    <option value="">------ Please Choose CC E-mail -------</option>
                                                    <option value="1"{{ $registered->rg_cc_status ==1 ? 'selected' : ''}}>Send to primary e-mail</option>
                                                    <option value="2"{{ $registered->rg_cc_status ==2 ? 'selected' : ''}}>Send to cc e-mail</option>
                                                    <option value="3"{{ $registered->rg_cc_status ==3 ? 'selected' : ''}}>Send to both e-mails</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="project_name">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone" autocomplete="off" value="{{$registered->rg_phone}}" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="company_name">Company name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name"
                                                    placeholder="Company name" autocomplete="off" value="{{$registered->rg_company}}"required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="address">Address</label>
                                                <div id="locationField">
                                                        <input id="autocomplete"  name="address" class="form-control" placeholder="Enter your address" onFocus="geolocate()" type="text"  autocomplete="off" value="{{$registered->rg_address}}"required/>
                                                      </div>
                                                {{-- <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Address" autocomplete="off" value="{{$registered->rg_address}}"required> --}}
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="project_name">Country</label>
                                                <input type="text" class="form-control" id="country" name="country"
                                                    placeholder="Country" autocomplete="off" value="{{$registered->rg_country}}"required>
                                                {{-- <select name="country" id="inputCountry" class="form-control" required>
                                                    <option value="">--- Please Choose Country---</option>
                                                    @foreach ($countrys as $country)
                                                    <option value="{{ $country->ct_id }}"
                                                        {{ $registered->rg_country == $country->ct_id ? 'selected' : '' }}>{{
                                                        $country->ct_name }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                            <div class="form-group col-md-6" id="other_id"  style="{{ $registered->rg_country == 15 ? 'display: block'  : 'display: none' }}">
                                                <label for="other">Other</label>
                                                <input type="text" name="other"  class="form-control" id="other" value="{{$registered->rg_other}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="job_title">Job title</label>
                                                <input type="text" class="form-control" id="job_title" name="job_title"
                                                    placeholder="Job title" autocomplete="off" required value="{{$registered->rg_job_title}}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="dietary_re">Dietary requirement</label>
                                                <textarea type="text" class="form-control" id="dietary_re" name="dietary_re"
                                                    placeholder="Dietary requirement" autocomplete="off">{{$registered->rg_dietary}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="remark1">Remark 1</label>
                                                <textarea type="text" class="form-control" id="remark1" name="remark1"
                                                    placeholder="Remark 1" autocomplete="off">{{$registered->rg_remark1}}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="remark2">Remark 2</label>
                                                <textarea type="text" class="form-control" id="remark2" name="remark2"
                                                    placeholder="Remark 2" autocomplete="off">{{$registered->rg_remark2}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <input type="hidden" class="form-control" id="rg_id" name="rg_id" value="{{$registered->rg_id}}"/>
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Register</button>
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
                    <input type="file" name="upload_file" id="upload_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        required>
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
<script src="{{ asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>
<script src="{{ asset('files/assets/pages/advance-elements/swithces.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#table2').DataTable();
    $("#event_name").change(function () {
        var event_id = $(this).val();
        alert(event_id);
    });

    $(document).ready(function() {
        $('#inputCountry').change(function(){
            var test = $('#inputCountry').val();
            if(test == 15){
                // alert('block');
                $('#other_id').css('display', 'block'); 
            }else{
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
              document.getElementById('autocomplete'), {types: ['geocode']});
        
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
            navigator.geolocation.getCurrentPosition(function(position) {
              var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              var circle = new google.maps.Circle(
                  {center: geolocation, radius: position.coords.accuracy});
              autocomplete.setBounds(circle.getBounds());
            });
          }
        }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV1YcC1yu84_5gpNikcyoSB6xdtJH8Dl8&libraries=places&callback=initAutocomplete"
                async defer></script>
@endsection
