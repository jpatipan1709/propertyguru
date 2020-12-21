<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Events;
use App\Agenda;
use App\AgendaDetail;
use App\Http\Requests\CheckEvent;
use Session;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::where('ev_pj_id',Session::get('id_project'))->get();
        $data = array(
            'events' => $events
        );
        return view('backoffice.event.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckEvent $request)
    {
       
        // $key_id = base64_encode('PPTGR'.time());
        $event = new Events;
        $event->ev_pj_id        = Session::get('id_project');
        $event->ev_status       = "";
        $event->ev_name         = $request->event_name;
        $event->ev_date_start   = $request->event_date;
        $event->ev_time_start   = $request->event_time_start;
        $event->ev_time_end     = $request->event_time_end;
        $event->save();

        return redirect('event')->with('success','Add Event Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = Events::find($id);

        $data = array(
            'events' => $events
        );
        return view('backoffice.event.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckEvent $request, $id)
    {
        
        $event = Events::find($id);
        $event->ev_name = $request->event_name;
        $event->ev_date_start   = $request->event_date;
        $event->ev_status = "";
        $event->ev_time_start   = $request->event_time_start;
        $event->ev_time_end     = $request->event_time_end;
        $event->save();

        return redirect('event')->with('success','Edit Event Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   
        $event = Events::destroy($id);
        $agenda = Agenda::destroy($id);
        $agendadetail = AgendaDetail::destroy($id);
        if( $event &&  $agenda && $agendadetail){
            echo 1;
        }else{
            echo 0;
        }
    }
}
