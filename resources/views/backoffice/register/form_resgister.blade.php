                                   @php

                                    // $project = App\Projects::where('pj_id',Session::get('id_project'))->get();
                                    // if($project[0]->pj_status == 1){
                                    dd(Session::get('id_project'));
                                    $events =  App\Events::where('ev_pj_id',Session::get('id_project'))->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
                                   
                                    // }else{
                                    // $events =
                                    // App\Events::where('ev_id',$id)->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
                                    // }
                                    @endphp
                                    <form action="{{ url('registered') }}" method="post">
                                        @csrf
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
                                                        <input class="form-check-input" type="checkbox" name="event_sel[]"
                                                            id="exampleRadios1" value="{{ $event->ev_id }}" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            {{ $event->ev_name }} : 
                                                            <i class="fa fa-calendar" aria-hidden="true"></i> {{ date_format($date,"d/m/Y") }}
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            {{ date_format($time1,"H:i") }} - {{ date_format($time2,"H:i") }} 
                                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                            location
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="fisrt_name">First name</label>
                                                <input type="text" class="form-control" id="fisrt_name" name="fisrt_name"
                                                    placeholder="First name" autocomplete="off">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="lastname">Last name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    placeholder="Last name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="project_name">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="E-mail" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="project_name">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="company_name">Company name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name"
                                                    placeholder="Company name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Address" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="project_name">Event Name</label>
                                                <select name="country" id="inputCountry" class="form-control">
                                                    <option value="0">--- Please Choose Country---</option>
                                                    @foreach ($countrys as $country)
                                                    <option value="{{ $country->ct_id }}"
                                                        {{ old('job_title') == $country->ct_id ? 'selected' : '' }}>{{
                                                        $country->ct_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="job_title">Job title</label>
                                                <input type="text" class="form-control" id="job_title" name="job_title"
                                                    placeholder="Job title" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="dietary_re">Dietary requirement</label>
                                                <textarea type="text" class="form-control" id="dietary_re" name="dietary_re"
                                                    placeholder="Dietary requirement" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary btn-outline-primary">Register</button>
                                            </div>
                                        </div>
                                    </form>