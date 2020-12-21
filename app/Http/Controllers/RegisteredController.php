<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registered;
use App\Events;
use App\Projects;
use App\Country;
use App\Attendee;
use App\AttendeeDetail;
use App\TypePersonal;
use App\Badges;
use App\Logs;
use App\galadinner;
use App\Mails;
use App\Checkin;
use App\imports\UsersImport;
use App\imports\UsersMail;
use App\Http\Requests\CheckregisterForm;
use Session;
use DB;
use Excel;
use PDF;
use App;
use Mail;
class RegisteredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = Projects::find(Session::get('id_project'));
        // dd(Session::get('id_event'));
        $countrys = Country::all();
        // if($projects->pj_status == 1){
            // $registerds = Registered::where('rg_pj_id',Session::get('id_project'))->whereRaw('FIND_IN_SET('.Session::get('id_event').',rg_event_id)')->leftjoin('tb_country','tb_register.rg_country','=','tb_country.ct_id')->get();
        // }else{
            $registerds = Registered::where('rg_pj_id',Session::get('id_project'))
            ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
            ->leftjoin('tb_country','tb_register.rg_country','=','tb_country.ct_id')->get();
        // }
        // $registerds = Registered::where('rg_pj_id',Session::get('id_project'))->where->leftjoin('tb_country','tb_register.rg_country','=','tb_country.ct_id')->get();
        $events = Events::where('ev_pj_id',Session::get('id_project'))->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();

        $data = array(
            'registerds' =>$registerds,
            'events' =>$events,
        );
        return view('backoffice.register.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = $id;
        $countrys = Country::all();
        $typepersonals = TypePersonal::all();
        $project = Projects::where('pj_id',Session::get('id_project'))->first();
        // $attendee = Attendee::where('atd_pj_id',$request->id)->first();
        // if($project->pj_status == 1){
        $attendee = Attendee::where('atd_pj_id',$id)->first();
        // }else{
        //     $attendee = Attendee::where('atd_ev_id',$id)->first();
        // }
        $data  = array(
            'countrys' => $countrys,
            'id' => $id,
            'attendee' => $attendee,
            'typepersonals' => $typepersonals
        );
        return view('backoffice.register.create',$data);
    }

    public function createform($id)
    {
        
        $id = $id;
        $countrys = Country::all();
        $typepersonals = TypePersonal::all();
        $project = Projects::where('pj_id',Session::get('id_project'))->first();
        // $attendee = Attendee::where('atd_pj_id',$request->id)->first();
        // if($project->pj_status == 1){
        $attendee = Attendee::where('atd_pj_id',$id)->first();
        // }else{
        //     $attendee = Attendee::where('atd_ev_id',$id)->first();
        // }
        $data  = array(
            'countrys' => $countrys,
            'id' => $id,
            'attendee' => $attendee,
            'typepersonals' => $typepersonals
        );
        return view('backoffice.register.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckregisterForm $request)
    {
        $im_event = implode(',',$request->event_sel);
        $registered = new Registered;
        $registered->rg_pj_id            =       Session::get('id_project');
        $registered->rg_event_id         =       $im_event;
        $registered->rg_name             =       $request->fisrt_name;
        $registered->rg_lastname         =       $request->lastname;
        $registered->rg_email            =       $request->email;
        $registered->rg_cc_email         =       $request->cc_email;
        $registered->rg_phone            =       $request->phone;
        $registered->rg_company          =       $request->company_name;
        $registered->rg_address          =       $request->address;
        $registered->rg_country          =       $request->country;
        $registered->rg_other            =        $request->other;
        $registered->rg_job_title        =       $request->job_title;
        $registered->rg_dietary          =       $request->dietary_re;
        $registered->rg_type_id          =       1;
        $registered->rg_type_personal    =       $request->type_personal;
        $registered->rg_remark1          =       $request->remark1;
        $registered->rg_remark2          =       $request->remark2;
        $registered->rg_cc_status        =       $request->cc_status;
        $registered->save();

        $event_ids = explode(',',$im_event);
        
        $registerd = Registered::where('rg_id',$registered->rg_id)->first();
         foreach($event_ids as $key => $event_id){
            


             $mails = Mails::where('tbm_pj_id',Session::get('id_project'))->first();
             $events = Events::where('ev_id',$event_id)->first();

             $checkin = new Checkin();
             $checkin->chi_rg_id = $registered->rg_id;
             $checkin->chi_pj_id = Session::get('id_project');
             $checkin->chi_ev_id = $event_id;
             $checkin->save();


             $data = array(
                 'mails' =>  $mails,
                 'events' =>  $events,
                 'registerd' => $registerd,
             );
             if($registerd->rg_cc_status == 1){
                Mail::send('backoffice.mail.mail', $data, function($message) use ($data) {
                    $message->to($data['registerd']->rg_email, $data['registerd']->rg_name.' '.$data['registerd']->rg_lastname)->subject('PropertyGuru E-ticket for  '.$data['events']->ev_name);
                    $message->from(env('MAIL_USERNAME'),'PropertyGuru');
                });
             }else if($registerd->rg_cc_status == 2){
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

        return redirect('registered')->with('success','Register information  Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = Projects::find(Session::get('id_project'));
        $countrys = Country::all();
        if($projects->pj_status == 1){
            $registerds = Registered::where('rg_pj_id',$id)->leftjoin('tb_country','tb_register.rg_country','=','tb_country.ct_id')->get();
        }else{
            $registerds = Registered::where('rg_event_id',$id)->leftjoin('tb_country','tb_register.rg_country','=','tb_country.ct_id')->get();
        }
      
        $data = array(
            'registerds' =>$registerds,
            'countrys' => $countrys
        );
        return view('backoffice.register.show',$data,compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $id;
        $countrys = Country::all();
        $typepersonals = TypePersonal::all();
        $project = Projects::where('pj_id',Session::get('id_project'))->first();
        $attendee = Attendee::where('atd_pj_id',Session::get('id_project'))->first();
        $registered = Registered::find($id);
        $data  = array(
            'countrys' => $countrys,
            'id' => $id,
            'attendee' => $attendee,
            'typepersonals' => $typepersonals,
            'registered' => $registered
        );
        return view('backoffice.register.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckregisterForm $request, $id)
    {
        $im_event = implode(',',$request->event_sel);
        $registered = Registered::find($id);
        $registered->rg_pj_id            =       Session::get('id_project');
        $registered->rg_event_id         =       $im_event;
        $registered->rg_name             =       $request->fisrt_name;
        $registered->rg_lastname         =       $request->lastname;
        $registered->rg_email            =       $request->email;
        $registered->rg_phone            =       $request->phone;
        $registered->rg_company          =       $request->company_name;
        $registered->rg_address          =       $request->address;
        $registered->rg_country          =       $request->country;
        $registered->rg_other           =       $request->other;
        $registered->rg_job_title        =       $request->job_title;
        $registered->rg_dietary          =       $request->dietary_re;
        $registered->rg_type_id          =       1;
        $registered->rg_type_personal    =       $request->type_personal;
        $registered->rg_remark1          =       $request->remark1;
        $registered->rg_remark2          =       $request->remark2;
        $registered->save();

        return redirect('registered')->with('success','Edit Register information  Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Registered::destroy($id);
        return redirect('registered')->with('success','Delete Register  Success');
    }

    public function upload(Request $request){
       
        // Excel::import(new UsersImport, request()->file('upload_file'));
        Excel::import(new UsersMail, request()->file('upload_file'));
        return redirect('registered')->with('success','Add Register  Success');
    }

    public function UploadUpdate(Request $request){
        // dd(request()->file('upload_file'));
        $registers = Excel::toCollection(new UsersImport, request()->file('upload_file'));

        foreach($registers[0] as $register){
            Registered::where('rg_id',$register['id'])->update([
                "rg_name" => $register['name'],
                "rg_lastname" => $register['lastname'],
                "rg_email" => $register['email'],
                "rg_phone" => $register['phone'],
                "rg_company" => $register['company'],
                "rg_address" => $register['address'],
                "rg_country" => $register['country'],
                "rg_job_title" => $register['jobtitle'],
                "rg_dietary" => $register['dietary'],
                "rg_type_personal" => $register['typepersonal'],
                "rg_event" => $register['event'],
            ]);


        }

        return redirect('registered')->with('success','Update Register  Success');
    }

    public function showlist($id){
        
        $html = "";
       
        $registered = Registered::where('rg_id',$id)
        ->leftjoin('tb_country','rg_country','=','tb_country.ct_id')
        ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
        ->first();
        $html .= view('backoffice.register.showlist', compact('registered'))->render();


        return $html;
    }

    public function PrintBadge($id){
      
        $registered = Registered::where('rg_id',$id)->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')->first();
        $badges = Badges::where('b_pj_id',$registered->rg_pj_id)->first();
        $data = array(
            'badges' => $badges,
            'registered' => $registered
        );
        
        $customPaper = array(0,0,367.00,183.80);
        $pdf =  PDF::loadView('backoffice.register.print',$data)->setPaper($customPaper, 'portrait');;
        
        // return view('backoffice.register.print',$data);
        return $pdf->stream();

    }


    public function PrintGala($id){
      
        $registered = Registered::where('rg_id',$id)->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')->first();
      

        $tables = DB::table('tb_tables')->whereRaw("find_in_set($id,tb_seat)")->first();
     
        if( $tables != null){
            $tabl_no = $tables->tb_no;
        }else{

            $tabl_no = "";
        }
        $galadinners = galadinner::where('gl_pj_id',$registered->rg_pj_id)->first();
        $data = array(
            'tabl_no' => $tabl_no,
            'galadinners' => $galadinners,
            'registered' => $registered
        );
        $customPaper = array(0,0,340.00,383.80);
        $pdf =  PDF::loadView('backoffice.register.print2',$data)->setPaper($customPaper, 'portrait');
        return $pdf->stream();
    }

    public function deleteregister(Request $request){
        
        $validatedData = $request->validate([
            'check_del' => 'required',
        ]);

        foreach($request->check_del as $key => $checks){
           $Registered = Registered::where('rg_id',$checks)->delete();
        }
        
        return redirect('registered')->with('danger','Delete Register information  Success');
    }

    public function checkread($id){
        // $Registered = Registered::where('rg_id',$id)->update([
        //     'rg_read' => '1',
        // ]);

        return view('backoffice.register.map');
    }
}
