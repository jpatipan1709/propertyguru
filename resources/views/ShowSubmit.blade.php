@extends('layouts.masterregis')

@section('content')

<link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">

<!-- Google font-->

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

<!-- Required Fremwork -->

<link rel="stylesheet" type="text/css" href="{{ asset('files/bower_components/bootstrap/css/bootstrap.min.css') }}">

<!-- themify icon -->

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">

<!-- Font Awesome -->

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/icon/font-awesome/css/font-awesome.min.css') }}">

<!-- scrollbar.css -->

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/jquery.mCustomScrollbar.css') }}">

<!-- radial chart.css -->

<link rel="stylesheet" href="{{ asset('files/assets/pages/chart/radial/css/radial.css') }}" type="text/css" media="all">

<!-- Style.css -->

<link rel="stylesheet" type="text/css" href="{{ asset('files/assets/css/style.css') }}">

<style>

    .section a {

        outline: 0;

        display: inline-block;

        padding: 5px;

        margin-bottom: 0px;

        width: 60px;

        background-color: #333;

        color: #fff;

        font-size: 16px;

        letter-spacing: 3px;

        transition: all 0.3s ease 0s;

        -moz-transition: all 0.3s ease 0s;

        -webkit-transition: all 0.3s ease 0s;

    }



</style>



<div class="container-fluid">

    <div class="row">

        <div class="col-sm bg-lightgray">

            <div class="section px-lg-5 px-3">

                <div class="top-border left"></div>

                <div class="top-border right"></div>

                <h2 class="mb-5">All Register List</h2>

                @if (session()->has('form_array'))

                    

               

                <form action="{{url('AddRegister')}}" id="form_add_register" method="POST">

                    @csrf

                    <div class="table-responsive">

                    <table id="table2" class="table table-bordered table-strip table-hover display" style="width:100%">

                        <thead style="background-color:black;color:white;">

                            <tr>

                                <th class="text-center">Guest Name</th>

                                <th class="text-center">E-mail</th>

                                <th class="text-center">Phone</th>

                                <th class="text-center">Company</th>

                                <th class="text-center">Address</th>

                                <th class="text-center">Country</th>

                                <th class="text-center">Job Title</th>

                                <th class="text-center">Dietary requirement</th>

                                <th class="text-center">Edit</th>

                            </tr>

                        </thead>

                        @php

                        // dd(Session::get('form_array'));

                        @endphp



                        @for ($i = 0; $i < 99; $i++)
                           
                            @if (isset(Session::get('form_array')[$i]))
                        
                            {{-- {{Session::get('form_array')[$i]->fisrt_name}} --}} 
                            <tr class="text-center">
                                <td>{{ Session::get('form_array')[$i]['fisrt_name'].' '.Session::get('form_array')[$i]['lastname'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['email'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['phone'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['company_name'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['address'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['country'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['job_title'] }}</td>
                                <td>{{ Session::get('form_array')[$i]['dietary_re'] }}</td>
                                <th class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-warning edit_form" atr="{{$i}}"
                                        data-toggle="modal" data-target="#exampleModal3" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{url('DeleteRegister').'/'.$i}}"
                                        class="btn btn-outline-warning btn-warning"><i class="fa fa-trash"
                                            aria-hidden="true"></i></a>
                                </th>
                           
                            </tr>
                            @endif


                            @endfor

                            </tbody>

                    </table>

                </div>

                    <div class="row text-center" style="margin-bottom:15px;">

                        <div class="col-12">

                            <button type="button" id="add_form_register" class="btn btn-outline-primary btn-primary">Register All</button>

                        </div>

                    </div>

                </form>

                @endif

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

       

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Edit Register</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <form action="{{ url('UpdateRegister')}}" method="post" enctype="multipart/form-data">

                    @csrf

                    {{ method_field('PUT') }}

                <div class="modal-body">

                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="inputFirstnsme">First name</label>

                                <input type="text" name="fisrt_name" class="form-control" id="inputFirstnsme"

                                    value="{{ old('fisrt_name') }}" required>

                            </div>

                            <div class="form-group col-md-6">

                                <label for="inputLastname">Last name</label>

                                <input type="text" name="lastname" class="form-control" id="inputLastname"

                                    value="{{ old('lastname') }}" required>

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="inputEmail">E-mail</label>

                                <input type="email" name="email" class="form-control" id="inputEmail"

                                    value="{{ old('email') }}" required>

                            </div>

                            <div class="form-group col-md-6">

                                <label for="inputPhone">Phone</label>

                                <input type="text" name="phone" class="form-control" id="inputPhone"

                                    value="{{ old('phone') }}" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputCompany">Company name</label>

                            <input type="text" name="company_name" class="form-control" id="inputCompany"

                                value="{{ old('company_name') }}" required>

                        </div>

                        <div class="form-group">

                                <label for="inputAddress">Address</label>

                                <div id="locationField">

                                    <input id="autocomplete"  name="address" class="form-control"  onFocus="geolocate()" type="text" placeholder=""  autocomplete="off" value=""  required/>

                                </div>

                            {{-- <input type="text" name="address" class="form-control" id="inputAddress" value="{{ old('address') }}"

                            required> --}}

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">

                                <label for="country">Country</label>

                                <input type="text" class="form-control" id="country" name="country" autocomplete="off"

                                    value="{{ old('country') }}" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="inputJob">Job title</label>

                            <input type="text" name="job_title" class="form-control" id="inputJob"

                                value="{{ old('job_title') }}" required>

                        </div>

                        <div class="form-group">

                            <label for="inputDietary">Dietary requirement</label>

                            <textarea class="form-control" name="dietary_re" id="inputDietary"

                                rows="4">{{ old('dietary_re') }}</textarea>

                        </div>

                   

                </div>

                <div class="modal-footer">

                    <input type="hidden" name="project_id" id="project_id" value="">

                    <input type="hidden" name="type_personal" id="type_personal" value="">

                    <input type="hidden" name="status" id="status" value="">

                    <input type="hidden" name="id" id="id" value="">

                    <button type="submit" class="btn btn-primary">Update</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </form>

            </div>

        </form>

    </div>

</div>



<script src="{{ asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>

<script src="{{ asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}} "></script>

<script src="{{ asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>

<script src="{{ asset('files/bower_components/bootstrap/js/bootstrap.min.js')}} "></script>

<script src="{{ asset('files/assets/pages/widget/excanvas.js')}} "></script>

<!-- jquery slimscroll js -->

<script src="{{ asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}} "></script>

<!-- modernizr js -->

<script src="{{ asset('files/bower_components/modernizr/js/modernizr.js ')}}"></script>

<!-- slimscroll js -->

<script src="{{ asset('files/assets/js/SmoothScroll.js')}}"></script>

<script src="{{ asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js ')}}"></script>

<!-- Chart js -->

<script src="{{ asset('files/bower_components/chart.js/js/Chart.js')}}"></script>

<script src="{{ asset('files/assets/pages/widget/amchart/amcharts.js')}}"></script>

<script src="{{ asset('files/assets/pages/widget/amchart/serial.js')}}"></script>

<script src="{{ asset('files/assets/pages/widget/amchart/light.js')}}"></script>

<!-- menu js -->

<script src="{{ asset('files/assets/js/pcoded.min.js')}}"></script>

<script src="{{ asset('files/assets/js/vertical/vertical-layout.min.js')}} "></script>

<!-- custom js -->



<script src="{{ asset('files/assets/js/script.js ')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    $("#add_form_register").click(function(){

            swal({

            title: "Warning",

            text: "Make sure  information are correct before submitting?",

            icon: "warning",

            buttons: true,

            dangerMode: true,

            }).then((willDelete) => {

                if (willDelete) {

                $("#form_add_register").submit();

                }

            });

    });

    $(".edit_form").click(function () {

        var id = $(this).attr('atr');

        $.ajax({

            url: "{{url('edit_regis')}}" + '/' + id,

            method: "get",

            data: {

                id: id

            },

        }).done(function (data) {

            console.log(data);

            $("#inputFirstnsme").val(data['registerd']['fisrt_name']);

            $("#inputLastname").val(data['registerd']['lastname']);

            $("#inputEmail").val(data['registerd']['email']);

            $("#inputPhone").val(data['registerd']['phone']);

            $("#inputCompany").val(data['registerd']['company_name']);

            $("#country").val(data['registerd']['country']);

            $("#inputJob").val(data['registerd']['job_title']);

            $("#inputDietary").val(data['registerd']['dietary_re']);

            $("#autocomplete").val(data['registerd']['address']);

            $("#project_id").val(data['registerd']['project_id']);

            $("#status").val(data['registerd']['status']);

            $("#type_personal").val(data['registerd']['type_personal']);

            $("#id").val(data['id']);

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

