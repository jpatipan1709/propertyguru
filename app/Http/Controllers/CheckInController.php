<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use PDF;
use Storage;
use Redirect;
use DB;
use App\Projects;
use App\Tickets;
use App\Registered;
use App\Mails;
use App\Events;
use App\Checkin;
class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $registered = DB::table('tb_register')->where('rg_pj_id',Session::get('id_project'))
                                ->leftjoin('tb_checkin','tb_register.rg_id','=','tb_checkin.chi_rg_id') 
                                ->leftjoin('tb_events','tb_checkin.chi_ev_id','=','tb_events.ev_id') 
                                ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                                ->get();
        // dd($registered);
       $data = array(
           'registerds' => $registered
       );
       return view('backoffice.checkin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $qr_code = explode('-',$request->qr_code);
     
        if(isset($qr_code[1])){
            $qr_code_ex = $qr_code[1];
        }else{
            $qr_code_ex = 0;
        }
  
      
        $registered = Registered::where('rg_id',$qr_code_ex)->first();

        if($registered !== null){
            $registered->rg_status = 1;
            $registered->save();
            
            // return Redirect::route('checkin', $id);
            return redirect('checkin')->with('complete',$qr_code_ex);
            // return redirect('checkin')->with('success','Thank you! CheckIn Success');
        }else{
            return redirect('checkin')->with('danger','No information was found.');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
       
        $registerd = Registered::where('rg_id',$id)->first();
        $registerd->rg_resend = 1;
        $registerd->rg_read = 0;
        $registerd->save();
        

        $registerd = Registered::where('rg_id',$id)->first();
        $event_ids = explode(',',$registerd->rg_event_id);
        foreach($event_ids as $key => $event_id){
            $mails = Mails::where('tbm_pj_id',$registerd->rg_pj_id)->first();
            $events = Events::where('ev_id',$event_id)->first();
            $data = array(
                'mails' =>  $mails,
                'events' =>  $events,
                'registerd' => $registerd,
            );
            try {
                Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                    $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                    $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                });
            } catch (Exception $ex) {
                return redirect('registered')->with('danger','Not found e-mail.');;
            }
        }
        return  Redirect::back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkin($event,$id){
        echo 'Event'.$event.'<br/>';
        echo 'ID'.$id.'<br/>';
    }

    public function checkinman($id,$event,$status){
        $checkin = Checkin::where('chi_rg_id',$id)->where('chi_ev_id',$event)->first();

        $checkin->chi_status = $status;
        $checkin->save();
    }
    
    public function checkqr($qr){
        $qr_code = explode('-',$qr);
     
        if(isset($qr_code[1])){
            $qr_code_ex = $qr_code[1];
        }else{
            $qr_code_ex = 0;
        }
  
      
        $registered = Registered::where('rg_id',$qr_code_ex)->first();

        if($registered !== null){
            $registered->rg_status = 1;
            $registered->save();
            
            // return Redirect::route('checkin', $id);
            return redirect('checkin')->with('complete',$qr_code_ex);
            // return redirect('checkin')->with('success','Thank you! CheckIn Success');
        }else{
            return redirect('checkin')->with('danger','No information was found.');
        }
    }

    public function resendmail(Request $request){ 

        $registerd = Registered::where('rg_id',$request->rg_id)->first();
        $registerd->rg_resend = 1;
        $registerd->rg_read = 0;
        $registerd->save();
        

        $registerd = Registered::where('rg_id',$request->rg_id)->first();
        $event_ids = explode(',',$registerd->rg_event_id);
        foreach($event_ids as $key => $event_id){
            $mails = Mails::where('tbm_pj_id',$registerd->rg_pj_id)->first();
            $events = Events::where('ev_id',$event_id)->first();
            $data = array(
                'mails' =>  $mails,
                'events' =>  $events,
                'registerd' => $registerd,
            );

            if($request->cc_status == 1){
                Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                    $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                    $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                });
             }else if($request->cc_status == 2){
                Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                    $message->to($data['registerd']->rg_cc_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                    $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                });
             }else{
                Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                    $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                    $message->cc($data['registerd']->rg_cc_email, $name = null);
                    $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                });
                
             }
        }

        return redirect('registered')->with('success','Resend E-mail Success');;
    }
}
