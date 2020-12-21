@extends('layouts.masterregis')

@section('content')

<div class="container py-5">

    <div class="row">

        <div class="col-sm bg-lightgray">

            <div class="section px-lg-5 px-3">

                <div class="top-border left"></div>

                <div class="top-border right"></div>

                <h2>REGISTRATION</h2>

  

                <form class="text-left" action="{{ url('registrat') }}" method="POST" id="form-add-register">

                    @csrf

                    <input type="hidden" name="id" id="id" value="{{ (isset($id)) ? $id : '' }}">

                    <input type="hidden" name="status" id="status" value="{{ (isset($status)) ? $status : '' }}">

                    <input type="hidden" name="count_lap" id="count_lap" value="{{ (isset($count_lap)) ? $count_lap : 1 }}">

                    <input type="hidden" name="max_lap" id="max_lap" value="{{ (isset($max_lap)) ? $max_lap : $num_regis }}">

                    <input type="hidden" name="project_id" id="project_id" value="{{ (isset($project_id)) ? $project_id : '' }}">

                    <input type="hidden" name="type_personal" id="type_personal" value="{{ (isset($type_personal)) ? $type_personal : '' }}">

                    <div class="form-group text-left my-4">

                        <div class="row mb-2">

                            <div class="col-12">

                                <i class="fas fa-user-alt"></i>

                                (@if(isset($count_lap))

                                {{-- <select name="lap_regis" id="lap_regis">

                                    @for ($i = 0; $i < $count_lap; $i++) <option value="{{ $i }}" @if

                                        (isset($count_lap)) @if ($count_lap-1==$i) {{ 'selected' }} @endif

                                        {{ $i.' / '.$count_lap }} @endif>{{ $i+1 }}</option>

                                        @endfor

                                </select> --}}

                                {{ $count_lap }}

                                @else

                                {{ '1' }}

                                @endif

                                /

                                @if (isset($max_lap))

                                {{ $max_lap }}

                                @else

                                {{ $num_regis }}

                                @endif) Personal {{ Session::has('form_array')  ? 'Edit' : '' }}

                                {{-- {{ isset($count_lap) ? $count_lap : 1) isset($max_lap) ? $max_lap : $num_regis }}

                                --}}

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="p-3 bg-gold">

                                    <h4 class="font-weight-bold text-white">Select event</h4>

                                    @foreach ($events as $event)

                                    @php

                                    $date = date_create($event->ev_date_start);

                                    $time1 = date_create($event->ev_time_start);

                                    $time2 = date_create($event->ev_time_end);

                                    @endphp

                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="event_sel[]" id="exampleRadios1"

                                            value="{{ $event->ev_id }}" checked>

                                        <label class="form-check-label" for="exampleRadios1">

                                            {{ $event->ev_name }}

                                            <br>

                                            <i class="fas fa-calendar-alt fa-fw"></i> {{ date_format($date,"d/m/Y") }}

                                            <i class="fas fa-clock fa-fw"></i>

                                            {{ date_format($time1,"H:i") }} - {{ date_format($time2,"H:i") }} <i class="fas fa-map-marker-alt fa-fw"></i>

                                            {{ $attendee->atd_venue }}

                                        </label>

                                    </div>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                    <h4 class="font-weight-bold">Add your details</h4>

                  

                    @if(isset($regisforms->rgf_rgt_id))

                        @php

                            $explode_forms = explode(',',$regisforms->rgf_rgt_id);

                        @endphp

                      

                    <div class="form-row">

                        @if (in_array('1',$explode_forms))

                            <div class="form-group col-md-6">

                                <label for="inputFirstnsme">First name</label>

                                <input type="text" name="fisrt_name" class="form-control" id="inputFirstnsme" value="{{ old('fisrt_name') }}" pattern="[A-Za-z0-9]+" required>

                            </div>

                        @endif

                        @if (in_array('2',$explode_forms))

                        <div class="form-group col-md-6">

                            <label for="inputLastname">Last name</label>

                            <input type="text" name="lastname" class="form-control" id="inputLastname" value="{{ old('lastname') }}" required>

                        </div>

                        @endif

                    </div>

                    <div class="form-row">

                        @if (in_array('3',$explode_forms))

                            <div class="form-group col-md-6">

                                <label for="inputEmail">E-mail</label>

                                <input type="email" name="email" class="form-control" id="inputEmail" value="{{ old('email') }}" required>

                            </div>

                        @endif

                        @if (in_array('4',$explode_forms))

                            <div class="form-group col-md-6">

                                <label for="inputPhone">Phone</label>

                                <input type="text" name="phone" class="form-control" id="inputPhone" value="{{ old('phone') }}" required>

                            </div>

                        @endif

                    </div>

                    @if (in_array('5',$explode_forms))

                    <div class="form-group">

                        <label for="inputCompany">Company name</label>

                        <input type="text" name="company_name" class="form-control" id="inputCompany" value="{{ old('company_name') }}" required>

                    </div>

                    @endif

                    @if (in_array('6',$explode_forms))

                    <div class="form-group">

                        <label for="inputAddress">Address</label>

                        <div id="locationField">

                            <input id="autocomplete"  name="address" class="form-control"  onFocus="geolocate()" type="text" placeholder=""  autocomplete="off" value="{{ old('address') }}"  required/>

                        </div>

                        {{-- <input type="text" name="address" class="form-control" id="inputAddress" value="{{ old('address') }}" required> --}}

                    </div>

                    @endif

                    @if (in_array('7',$explode_forms))

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="country">Country</label>

                            <input type="text" class="form-control" id="country" name="country"

                            autocomplete="off"   value="{{ old('country') }}" required>

                            {{-- <select name="country" id="inputCountry" class="form-control" required>

                                <option value="">--- Please Choose Country ---</option>

                                @foreach ($countrys as $country)

                                <option value="{{ $country->ct_id }}" {{ old('job_title') == $country->ct_id ? 'selected' : '' }} >{{ $country->ct_name }}</option>

                                @endforeach

                            </select> --}}

                            <!--Guess country when type first alphabet-->

                        </div>

                       

                    </div>

                    @endif

                    @if (in_array('9',$explode_forms))

                    <div class="form-group">

                        <label for="inputJob">Job title</label>

                        <input type="text" name="job_title" class="form-control" id="inputJob" value="{{ old('job_title') }}" required>

                    </div>

                    @endif

                    @if (in_array('10',$explode_forms))

                    <div class="form-group">

                        <label for="inputDietary">Dietary requirement</label>

                        <textarea class="form-control" name="dietary_re" id="inputDietary" rows="4">{{ old('dietary_re') }}</textarea>

                    </div>

                    @endif

                    <div class="form-group text-center py-5">



                        @if (isset($count_lap) && isset($max_lap))

                            

                            @if ($count_lap == $max_lap)

                                <button type="button" class="btn btn-lg btn-outline-warning" id="confirm-add">Register</button>

                            @else 

                                <button type="submit" class="btn btn-lg btn-outline-warning">Next</button>

                            @endif

                        @else

                            <button type="submit" class="btn btn-lg btn-outline-warning">Next</button>

                        @endif

                        <br>

                        {{-- <button type="button" onclick="goBack()" class="btn btn-outline-secondary my-3">Back</button> --}}

                    </div>

                    @else

                    <br>

                    <h6 class="text-center">No Form Register</h6>

                    @endif

                </form>

            </div>

        </div>

    </div>

</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

$("#confirm-add").click(function(){

            // swal({

            // title: "Warning",

            // text: "Make sure  information are correct before submitting?",

            // icon: "warning",

            // buttons: true,

            // dangerMode: true,

            // }).then((willDelete) => {

            //     if (willDelete) {

                    $("#form-add-register").submit();

                // }

            // });

    

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

<script>

$('input[type=text]').bind('keypress', function (event) {

    var regex = new RegExp("^[a-zA-Z0-9.,' *'@!#$%&'*+/=?^_`{|}~-]{1,}$");

    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

    if (!regex.test(key)) {

       event.preventDefault();

       return false;

    }

});

$('input[name=address]').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9.,' *'@!#$%&'*+/=?^_`{|}~-\s]{1,}$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
    event.preventDefault();
    return false;
    }
});


$('textarea').bind('keypress', function (event) {

    var regex = new RegExp("^[a-zA-Z0-9.,' *'@!#$%&'*+/=?^_`{|}~-]{1,}$");

    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

    if (!regex.test(key)) {

       event.preventDefault();

       return false;

    }

});

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
</script>

@endsection

