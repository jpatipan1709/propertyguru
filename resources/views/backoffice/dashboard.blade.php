@extends('backoffice.layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('files/assets/pages/chart/radial/css/radial.css')}}" type="text/css" media="all">
@endsection
@section('content')
<?php
    $active = "dashboard_index";
    $active_menu = "dashboard";
?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    {{-- <div class="col-4">
                        <form action="#">
                            <select name="event_name" id="event_name" class="form-control">
                                <option value="0">All Event</option>
                                @foreach ($events as $event)
                                <option value="{{ $event->ev_id }}">{{ $event->ev_name }}</option>
                                @endforeach

                            </select>
                        </form>
                    </div>
                    <br> --}}
                    {{-- {{ Session::get('id_event') }} --}}
                    <div class="col-12">
                        <div class="card-deck">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Registered Total</h6>
                                    <p class="m-b-0">
                                        <p class="m-b-0">Registered <a href="{{ url('ShowRegister')}}" style="color:white;"><span class="f-right">{{ $registere_count }}</span></a></p>
                                        <p class="m-b-0">Daily<span class="f-right">{{ $registere_count }}</span></p>
                                        <p class="m-b-0">Weekly<span class="f-right">{{ $registere_count }}</span></p>
                                        <p class="m-b-0">Monthly<span class="f-right">{{ $registere_count }}</span></p>
                                    </p>
                                </div>
                            </div>
                            <div class="card bg-c-black order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">On site Report</h6>
                                    <p class="m-b-0">
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-right">Check In</p>
                                                @foreach ($typepersonals as $typepersonal)
                                                @php
                                                $registere_count_type_personal =
                                                App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_personal',$typepersonal->tps_id)->where('rg_status',1)->count();
                                                @endphp
                                                <p class="m-b-0">{{ $typepersonal->tps_name }}<span class="f-right">
                                                    <a href="{{ url('ShowCheckIn').'/'.$typepersonal->tps_id}}" style="color:white;">{{ $registere_count_type_personal }}</a></span></p>
                                                @endforeach
                                            </div>
                                            <div class="col-6">
                                                <p class="text-right">Not Check In</p>
                                                @foreach ($typepersonals as $typepersonal)
                                                @php
                                                $registere_count_type_personal =
                                                App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_personal',$typepersonal->tps_id)->where('rg_status',null)->count();
                                                @endphp
                                                <p class="m-b-0">{{ $typepersonal->tps_name }}<span class="f-right">
                                                        <a href="{{ url('ShowNotCheckIn').'/'.$typepersonal->tps_id}}" style="color:white;">{{ $registere_count_type_personal }}</a></span></p>
                                                @endforeach
                                            </div>
                                        </div>

                                    </p>
                                </div>
                            </div>
                            <div class="card bg-c-orenge order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Registered Personal Type</h6>
                                    <p class="m-b-0">
                                        @foreach ($typepersonals as $typepersonal)
                                        @php
                                        $registere_count_type_personal =
                                        App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_personal',$typepersonal->tps_id)->count();
                                        @endphp
                                        <p class="m-b-0">{{ $typepersonal->tps_name }}
                                            <span class="f-right">
                                                    <a href="{{ url('ShowTypePersonal').'/'.$typepersonal->tps_id}}" style="color:white;">{{$registere_count_type_personal }}</a>
                                            </span>
                                        </p>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card-deck">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Registered Link</h6>
                                    <p class="m-b-0">
                                        @php
                                            $registere_count_link1 =
                                            App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_id',1)->count();
                                        @endphp
                                        <p class="m-b-0">Admin link 
                                            <a href="{{ url('ShowLink').'/1'}}" style="color:white;"> 
                                                <span class="f-right">{{$registere_count_link1}}
                                                </span>

                                            </a>
                                        </p>
                                        @php
                                            $registere_count_link2 =
                                            App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_id',2)->count();
                                        @endphp
                                        <p class="m-b-0">Guest link<a href="{{ url('ShowLink').'/2'}}" style="color:white;"> 
                                            <span class="f-right">{{$registere_count_link2}}
                                            </span>

                                        </a></p>
                                        @php
                                            $registere_count_link3 =
                                            App\Registered::where('rg_pj_id',Session::get('id_project'))->where('rg_type_id',3)->count();
                                        @endphp
                                        <p class="m-b-0">Sponser link<a href="{{ url('ShowLink').'/3'}}" style="color:white;"> 
                                            <span class="f-right">{{$registere_count_link3}}
                                            </span>

                                        </a></p>
                                    </p>
                                </div>
                            </div>
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Activities Top list</h6>
                                    <p class="m-b-0">
                                        @foreach ($events as $event)
                                                @php
                                                    $registere_count_top = App\Registered::where('rg_pj_id',Session::get('id_project'))
                                                    ->whereRaw("find_in_set($event->ev_id,rg_event_id)")
                                                    ->count();
                                                @endphp
                                                <p class="m-b-0">{{ $event->ev_name }}
                                                        <a href="{{ url('ShowEvent').'/'.$event->ev_id}}" style="color:white;">  <span class="f-right">{{$registere_count_top}}</span> </a>
                                                </p>
                                        @endforeach

                                    </p>
                                </div>
                            </div>
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Selections Latest</h6>
                                    <p class="m-b-0">
                                        <p class="m-b-0">Gala dinner ticket<span class="f-right">0</span></p>
                                        <p class="m-b-0">Diatary Requirement<span class="f-right">0</span></p>
                                        <p class="m-b-0">EzyExpress<span class="f-right">0</span></p>
                                        <p class="m-b-0">Walk in Day 1<span class="f-right">0</span></p>
                                        <p class="m-b-0">Speaker<span class="f-right">0</span></p>
                                        <p class="m-b-0">Dalegate<span class="f-right">0</span></p>
                                        <p class="m-b-0">Guest<span class="f-right">0</span></p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="card-deck">
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Registered Total</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0">Registered<span class="f-right">0</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-black order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Cancellations</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0"> Cancellations - Path of the order<span class="f-right">0</span></p>
                                            <p class="m-b-0"> Cancellations - Full<span class="f-right">0</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-orenge order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Registered Personal Type</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0">Guest<span class="f-right">0</span></p>
                                            <p class="m-b-0">Judge<span class="f-right">0</span></p>
                                            <p class="m-b-0">Judge's Guest<span class="f-right">0</span></p>
                                            <p class="m-b-0">Partnaer<span class="f-right">0</span></p>
                                            <p class="m-b-0">PG Group<span class="f-right">0</span></p>
                                            <p class="m-b-0">Press<span class="f-right">0</span></p>
                                            <p class="m-b-0">Sponser<span class="f-right">0</span></p>
                                            <p class="m-b-0">VIP<span class="f-right">0</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Registered Regline</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0">Admin link<span class="f-right">0</span></p>
                                            <p class="m-b-0">Main Event Template<span class="f-right">0</span></p>
                                            <p class="m-b-0">Sponser Link<span class="f-right">0</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Activities Top list</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0">Asia Real Estate summit, Day 1<span class="f-right">0</span></p>
                                            <p class="m-b-0">Asia Real Estate summit, Day 2<span class="f-right">0</span></p>
                                            <p class="m-b-0">Asia Property Awards Grand Final, Gala Dinner<span class="f-right">0</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Selections Latest</h6>
                                        <p class="m-b-0">
                                            <p class="m-b-0">Gala dinner ticket<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">Diatary Requirement<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">EzyExpress<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">Walk in Day 1<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">Speaker<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">Dalegate<span class="f-right">xxx</span></p>
                                            <p class="m-b-0">Guest<span class="f-right">xxx</span></p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Statistics</h5>
                                </div>
                                <div class="card-block">
                                    <div id="Statistics-chart" style="height:400px"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Chart js -->
<script src="{{ asset('files/bower_components/chart.js/js/Chart.js')}}"></script>

<!-- custom js -->
<script src="{{ asset('files/assets/pages/dashboard/custom-dashboard.js')}}"></script>
<script src="{{ asset('files/assets/pages/dashboard/analytic-dashboard.js')}}"></script>

@endsection
