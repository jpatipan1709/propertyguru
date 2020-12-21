<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CheckregisterForm;
use App\Events;
use App\Attendee;
use App\AttendeeDetail;
use App\Country;
use App\Tickets;
use App\Registered;
use App\Regisform;
use App\Projects;
use App\Mails;
use DB;
use Mail;
use Session;
use PDF;
use Storage;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
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
     
        // $project  = Projects::where('pj_id',$request->project_id)->get();
        // if($project[0]->pj_status == 1){
            // $events = Events::where('ev_pj_id',$request->id)->get();
            $countrys = Country::all();
            $regisforms = Regisform::where('rgf_pj_id',$request->id)->first();
            $attendee = Attendee::where('atd_pj_id',$request->id)->first();
        // }else{
        //     $events = Events::where('ev_id',$request->id)->get();
        //     $countrys = Country::all();
        //     $regisforms = Regisform::where('rgf_ev_id',$request->id)->first();
        // }
    
        // dd($events);
        if($request->count_lap == null){
            $count_lap = 0;
        }else{
            $count_lap = $request->count_lap+1;
        }
        
        if($request->type_personal != null){
            $type_personal = $request->type_personal;
        }else{
            if($request->status == 2){
                $type_personal = 7;
            }else if($request->status == 3){
                $type_personal = 1;
            }
            
        }
       
        // dd($request->count_lap.'<='.$request->max_lap);
        if($request->count_lap <= $request->max_lap){
        //    $im_event = implode(',',$request->event_sel);
        //    $registered = new Registered;
        //    $registered->rg_pj_id            =       $request->project_id;
        //    $registered->rg_event_id         =       $im_event;
        //    $registered->rg_name             =       $request->fisrt_name;
        //    $registered->rg_lastname         =       $request->lastname;
        //    $registered->rg_email            =       $request->email;
        //    $registered->rg_phone            =       $request->phone;
        //    $registered->rg_company          =       $request->company_name;
        //    $registered->rg_address          =       $request->address;
        //    $registered->rg_country          =       $request->country;
        //    $registered->rg_other            =       $request->other;
        //    $registered->rg_job_title        =       $request->job_title;
        //    $registered->rg_dietary          =       $request->dietary_re;
        //    $registered->rg_type_id          =       $request->status;
        //    if($request->type_personal == "" || $request->type_personal == null){
        //     $registered->rg_type_personal    =       $request->status;
        //    }else{
        //     $registered->rg_type_personal    =       $request->type_personal;
        //    }
           
        //    $registered->save();
            $form_array = collect([
                'project_id'      =>  $request->id,
                'event_id'        =>  $request->event_sel,
                'fisrt_name'      =>  $request->fisrt_name,
                'lastname'        =>  $request->lastname,
                'email'           =>  $request->email,
                'phone'           =>  $request->phone,
                'company_name'    =>  $request->company_name,
                'address'         =>  $request->address,
                'country'         =>  $request->country,
                'job_title'       =>  $request->job_title,
                'dietary_re'      =>  $request->dietary_re,
                'type_personal'   =>  $type_personal,
                'status'          =>  $request->status,
                'id'                =>  $request->id,
            ]);
            Session::push('form_array', $form_array);

                // $id = $registered->rg_id;
                // $email = $request->email;
                // $fisrt_name = $request->fisrt_name;
                // $lastname = $request->lastname;
                // $registerd = Registered::where('rg_id',$id)->first();
                // $mails = Mails::where('tbm_pj_id',$registerd->rg_pj_id)->first();
                // $events = Events::where('ev_pj_id',$registerd->rg_pj_id)->get();
               
                // $events2 = Events::where('ev_pj_id',$registerd->rg_pj_id)->get();
                // $data = array(
                //     'mails' =>  $mails,
                //     'events' =>  $events,
                //     'email' => $email,
                //     'fisrt_name' => $fisrt_name,
                //     'lastname' => $lastname,
                //     'registerd' => $registerd
                // );

                // foreach($events as $key => $event){
                //     $events = Events::where('ev_id',$event->ev_id)->first();
                //     $data = array(
                //         'mails' =>  $mails,
                //         'events' =>  $events,
                //         'email' => $email,
                //         'fisrt_name' => $fisrt_name,
                //         'lastname' => $lastname,
                //         'registerd' => $registerd
                //     );
                    // Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {

                    //     $message->to($data['email'], $data['fisrt_name'].' '.$data['lastname'])->subject('PropertyGuru E-ticket for '.$data['events']->ev_name);
                    //     $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                    // });
                // }
                // return view('backoffice.checkin.show',compact('id'));

                $events = Events::where('ev_pj_id',$request->id)->get();

            $data = array(
                'count_lap' => $count_lap,
                'events' => $events,
                'countrys' => $countrys,
                'id' => $request->id,
                'status' => $request->status,
                'max_lap' => $request->max_lap,
                'regisforms' => $regisforms,
                'project_id' => $request->project_id,
                'attendee' => $attendee,
                'type_personal' => $type_personal,
            );
            

            if($request->count_lap == $request->max_lap){
                return redirect('showdata');
            }else{
                return view('registration',$data);
            }
        }else{  
                return redirect('thankyou');
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
        echo $id;
    }

  

    public function registergroup($id,$status,$type){
        session([
            'confirm' => rand().time()
        ]);
    //    Session::forget('form_array');
        $data = array(
            'status' => $status,
            'id' => $id,
            'type' => $type,
        );
        return view('numgroup',$data);
    }

    public function showregistergroup(Request $request){

        // dd($request->id);
        // $project = Projects::where('pj_id',$request->type)->first();
        // if($project->pj_status == 1){
            $regisforms = Regisform::where('rgf_pj_id',$request->id)->first();
            $events = Events::where('ev_pj_id',$request->id)->get();
            $attendee = Attendee::where('atd_pj_id',$request->id)->first();
        // }else{
        //     $regisforms = Regisform::where('rgf_ev_id',$request->id)->first();
        //     $events = Events::where('ev_id',$request->id)->get();
        //     $attendee = Attendee::where('atd_ev_id',$request->id)->first();
        // }
        $countrys = Country::all();
       
        $num_regis = $request->number_personal;
        $data = array(
            'attendee' => $attendee,
            'num_regis' => $num_regis,
            'events' => $events,
            'countrys' => $countrys,
            'id' => $request->id,
            'status' => $request->status,
            'type_personal' => $request->type_personal,
            'regisforms' => $regisforms,
            'project_id' => $request->type
        );
        return view('registration',$data);
    }

    public function storageform(CheckregisterForm $request){
       
       

    }

    public function thankyou(){
        // dd(Session::get('form_array'));
        session()->forget('form_array');
        // Session::forget('confirm');
        return view('thankyou');
    }

    public function showregister($id,$status,$type){
        $events = Events::where('ev_pj_id',$id)->get();
        $countrys = Country::all();
        $regisforms = Regisform::where('rgf_pj_id',$id)->first();
        $attendee = Attendee::where('atd_pj_id',$request->id)->first();

        if($request->count_lap == null){
            $count_lap = 0;
        }else{
            $count_lap = $request->count_lap+1;
        }
        

        if($request->$count_lap <= $request->max_lap){
            // $form_array = collect([
            //     'project_id'      =>  $request->id,
            //     'event_id'        =>  $request->event_sel,
            //     'fisrt_name'      =>  $request->fisrt_name,
            //     'lastname'        =>  $request->lastname,
            //     'email'           =>  $request->email,
            //     'phone'           =>  $request->phone,
            //     'company_name'    =>  $request->company_name,
            //     'address'         =>  $request->address,
            //     'country'         =>  $request->country,
            //     'job_title'       =>  $request->job_title,
            //     'dietary_re'      =>  $request->dietary_re,
            // ]);
            // Session::push('form_array', $form_array);

            $data = array(
                'count_lap' => $count_lap,
                // 'events' => $events,
                'countrys' => $countrys,
                'id' => $id,
                'status' => $request->status,
                'max_lap' => $request->max_lap,
                'regisforms' => $regisforms,
                'project_id' => $request->project_id,
                'attendee' => $attendee
            );
            

            if($request->count_lap == $request->max_lap){
                return redirect('showdata');
            }else{
                return view('registration',$data);
            }
        }else{  
                return redirect('thankyou');
        }
    }

    public function showdata(){
        // dd(Session::all());
        return view('ShowSubmit'); 
    }
    
    public function  edit_regis($id){
        $registerd = Session::get('form_array')[$id];
        $data = array(
            'registerd' => $registerd,
            'id' => $id
        );
        return  $data;
        // return view('ShowSubmit'); 
    }
   
    public function AddRegister(Request $request){
        // dd(Session::get('form_array'));
        for ($i = 0; $i < 99; $i++){
            if (isset(Session::get('form_array')[$i])){
                
            
            $im_event =  implode(',',Session::get('form_array')[$i]['event_id']);

            $registered                      =  new Registered;
            $registered->rg_name             =  Session::get('form_array')[$i]['fisrt_name'];
            $registered->rg_lastname         =  Session::get('form_array')[$i]['lastname'];
            $registered->rg_email            =  Session::get('form_array')[$i]['email'];
            $registered->rg_phone            =  Session::get('form_array')[$i]['phone'];
            $registered->rg_company          =  Session::get('form_array')[$i]['company_name'];
            $registered->rg_address          =  Session::get('form_array')[$i]['address'];
            $registered->rg_country          =  Session::get('form_array')[$i]['country'];
            $registered->rg_job_title        =  Session::get('form_array')[$i]['job_title'];
            $registered->rg_dietary          =  Session::get('form_array')[$i]['dietary_re'];
            $registered->rg_event_id         =  $im_event;
            $registered->rg_pj_id            =  Session::get('form_array')[$i]['project_id'];
            $registered->rg_type_id          =  Session::get('form_array')[$i]['id'];
            $registered->rg_type_personal    =  Session::get('form_array')[$i]['type_personal'];
            $registered->save();

            $event_ids = explode(',',$im_event);
            $registerd = Registered::where('rg_id',$registered->rg_id)->first();
                foreach($event_ids as $key => $event_id){

                    $checkin = new Checkin();
                    $checkin->chi_rg_id = $registered->rg_id;
                    $checkin->chi_pj_id = Session::get('form_array')[$i]['project_id'];
                    $checkin->chi_ev_id = $event_id;
                    $checkin->save();


                    $mails = Mails::where('tbm_pj_id',Session::get('form_array')[$i]['project_id'])->first();
                    $events = Events::where('ev_id',$event_id)->first();
                    $data = array(
                        'mails' =>  $mails,
                        'events' =>  $events,
                        'registerd' => $registerd,
                    );
                    
                        Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                            $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                            $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                        });
                }
            }
        }
        return redirect('thankyou');

    }   

    public function DeleteRegister($id){
        // dd('form_array.'.$id);


        Session::forget('form_array.'.$id);
        // dd();


        // exit();
        
        return redirect('showdata');
    }

    public function UpdateRegister(Request $request){
        // dd(Session::get('form_array')[$request->id]);
        Session::get('form_array')[$request->id]['fisrt_name'] = $request->fisrt_name;
        Session::get('form_array')[$request->id]['lastname'] = $request->lastname;
        Session::get('form_array')[$request->id]['email'] = $request->email;
        Session::get('form_array')[$request->id]['phone'] = $request->phone;
        Session::get('form_array')[$request->id]['company_name'] = $request->company_name;
        Session::get('form_array')[$request->id]['address'] = $request->address;
        Session::get('form_array')[$request->id]['country'] = $request->country;
        Session::get('form_array')[$request->id]['job_title'] = $request->job_title;
        Session::get('form_array')[$request->id]['dietary_re'] = $request->dietary_re;

        
        // exit();
       
        // foreach(Session::get('form_array') as $item) {
        //     $item['fisrt_name']     = $request->fisrt_name;
        //     $item['lastname']       = $request->lastname;
        //     $item['email']          = $request->email;
        //     $item['phone']          = $request->phone;
        //     $item['company_name']   = $request->company_name;
        //     $item['country']        = $request->country;
        //     $item['job_title']      = $request->job_title;
        //     $item['dietary_re']     = $request->dietary_re;
        // }
        return redirect('showdata');
    }
}
