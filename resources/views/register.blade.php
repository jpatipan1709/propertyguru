@extends('layouts.master')

@section('content')



@if (count($attendees) == 1)

<div class="container py-5">

    <div class="row">

        @foreach ($attendees as $attendee)

        <div class="col-sm-6 offset-sm-3">

            <div class="card" style="border: 3px solid {{ $attendee->atd_border }};">

                <div class="card-body">

                    <div class="text-center py-3">

                        <img src="{{ url('storage/event').'/'.$attendee->atd_image }}" class="mw-100" style="height:250px; display:inline-block">

                    </div>

                    <h5 class="card-title" style="color:{{ $attendee->atd_border }};">{{ $attendee->atd_title }}</h5>

                    <p class="card-text my-4">{!! $attendee->atd_content !!}</p>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};">
                            <i class="fas fa-calendar-alt fa-fw"></i> Date of event: </span>
                            @php
                            $attendeedetails = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->get();
                            $attendeedetails2 = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->first();
                            $event = App\Events::where('ev_pj_id',$id)->first();
                            $date2 = date_create($attendeedetails2->atdt_date);
                            $date3 = date_create($event->ev_date_start);
                            @endphp
                            @foreach ($attendeedetails as $key => $attendeedetail)
                            @php
                            $date = date_create($attendeedetail->atdt_date);
                            @endphp
                            {{-- {{ $key }} --}}
                            @if (++$key == count($attendeedetails))
                            {{date_format($date3,"j")}}
                            @else
                            {{date_format($date3,"j")}} -
                            @endif
                            @endforeach
                            {{date_format($date3,"F Y")}}


                    </div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-clock fa-fw"></i>

                            Time: </span>

                        @php

                        $attendeedetails = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->get();

                        @endphp

                        @foreach ($attendeedetails as $key => $attendeedetail)

                        @php

                        $time = date_create($attendeedetail->atdt_time_from);

                        $time2 = date_create($attendeedetail->atdt_time_to);

                        @endphp

                        {{-- {{ $key }} --}}

                        @if (++$key == count($attendeedetails))

                        {{date_format($time,"H:i")}} - {{date_format($time2,"H:i")}}

                        @else

                        {{date_format($time,"H:i")}} - {{date_format($time2,"H:i")}} /

                        @endif



                        @endforeach

                    </div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-trophy fa-fw"></i>

                            Gala dinner & Awards Ceremony: </span>{{ $attendee->atd_type }}</div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-map-marker-alt fa-fw"></i>

                            Venue of event: </span> <a style="color:#212529;" href="{{ $attendee->atd_map }}" target="_blank">{{

                            $attendee->atd_venue }} </a></div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="row">

        <div class="col-sm-12 text-center py-5">

            <a href="{{ url('/registergroup/'.$attendees[0]->atd_pj_id.'/'.$status.'/'.$attendees[0]->pj_id)}}" class="btn btn-lg btn-outline-warning">Register</a>

        </div>

    </div>

</div>



@elseif(count($attendees) == 2)



<div class="container py-5">

    <!--กรณีมี 2-3 งาน-->

    <div class="row">

        @foreach ($attendees as $attendee)

        <div class="col-lg col-md-12">

            <div class="card" style="border: 3px solid {{ $attendee->atd_border }};">

                <div class="card-body">

                    <div class="text-center py-3">

                      <img src="{{ url('storage/event').'/'.$attendee->atd_image }}" class="mw-100" style="height:250px; display:inline-block">

                    </div>

                    <h5 class="card-title" style="color:{{ $attendee->atd_border }};">{{ $attendee->atd_title }}</h5>

                    <p class="card-text my-4">{!! $attendee->atd_content !!}</p>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};">

                            <i class="fas fa-calendar-alt fa-fw"></i> Date of event: </span>

                            @php

                            $attendeedetails = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->get();

                            $attendeedetails2 = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->first();

                            $date2 = date_create($attendeedetails2->atdt_date);

                            @endphp

                            @foreach ($attendeedetails as $key => $attendeedetail)

                            @php

                            $date = date_create($attendeedetail->atdt_date);

                            @endphp

                            {{-- {{ $key }} --}}

                            @if (++$key == count($attendeedetails))

                            {{date_format($date,"j")}}

                            @else

                            {{date_format($date,"j")}} -

                            @endif

    

    

    

                            @endforeach

                            {{date_format($date2,"F Y")}}

                    </div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-clock fa-fw"></i>

                            Time: </span>

                        @php

                        $attendeedetails = App\AttendeeDetail::where('atdt_agd_id',$attendee->atd_id)->get();

                        @endphp

                        @foreach ($attendeedetails as $key => $attendeedetail)

                        @php

                        $time = date_create($attendeedetail->atdt_time_from);

                        $time2 = date_create($attendeedetail->atdt_time_to);

                        @endphp

                        {{-- {{ $key }} --}}

                        @if (++$key == count($attendeedetails))

                        {{date_format($time,"H:i")}} - {{date_format($time2,"H:i")}}

                        @else

                        {{date_format($time,"H:i")}} - {{date_format($time2,"H:i")}} /

                        @endif



                        @endforeach

                    </div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-trophy fa-fw"></i>

                            Gala dinner & Awards Ceremony: </span>{{ $attendee->atd_type }}</div>

                    <div class="mb-2"><span class="text-list" style="color:{{ $attendee->atd_border }};"><i class="fas fa-map-marker-alt fa-fw"></i>

                            Venue of event: </span> <a style="color:#212529;" href="{{ $attendee->atd_map }}" target="_blank">{{

                            $attendee->atd_venue }} </a></div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <div class="row">

        <div class="col-sm-12 text-center py-5">

                <a href="{{ url('/registergroup/'.$attendees[0]->atd_pj_id.'/'.$status.'/'.$attendees[0]->pj_id)}}" class="btn btn-lg btn-outline-warning">Register</a>



        </div>

    </div>

</div>

@endif

@endsection

