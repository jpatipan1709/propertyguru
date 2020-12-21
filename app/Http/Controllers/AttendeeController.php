<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendee;
use App\AttendeeDetail;
use App\Events;
use App\Projects;
use App\Color;
use App\Urls;
use App\Http\Requests\Checkattendee;
use Session;
use DB;
use Storage;
class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendees = DB::table('tb_attendee')
                        ->where('atd_pj_id','=',Session::get('id_project'))
                        ->leftjoin('tb_events','tb_attendee.atd_ev_id','=','tb_events.ev_id')
                        ->leftjoin('tb_projects','tb_attendee.atd_pj_id','=','tb_projects.pj_id')
                        ->get();
        $event = Events::where('ev_pj_id',Session::get('id_project'))->first();
        
        $data = array(
            'attendees' => $attendees,
            'event' => $event
        );
        return view('backoffice.attendee.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Events::where('ev_pj_id',Session::get('id_project'))->get();
        $colors = Color::all();
        $data = array(
            'events' => $events,
            'colors' => $colors
        );
        return view('backoffice.attendee.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckAttendee $request)
    {
        // $myselects = $request->myselect;
        // foreach ($myselects as $key => $myselect) {
        //     $event = Events::find($myselect);
        //     $event->ev_status = 1;
        //     $event->save();
        // }

        $project = Projects::where('pj_id',Session::get('id_project'))->first();
       
        if($project->pj_status == 1){
            $find_att = Attendee::where('atd_pj_id',Session::get('id_project'))->first();
            if($find_att != null){
                $evid = $find_att->atd_ev_id;
            }else{
                $im_myselect = implode(',',$request->myselect);
                $evid =  $im_myselect[0];
            }
        }else{
            $im_myselect = implode(',',$request->myselect);
            $evid =  $im_myselect[0];
        }
        $myselect = implode(',',$request->myselect);

        if($request->hasFile('images_logo')){
            $filename1 = insertSingleImage($request->images_logo, 'event');
        }else{
            $filename1 = "";
        }

        
        if($request->use_color != 0){
            $color_border = $request->border_agenda;
        }else{
            $color_border = $request->border_pick;
        }
        $attendee = new Attendee;
        $attendee->atd_ev_id        =  $evid;
        $attendee->atd_pj_id        =  Session::get('id_project');
        $attendee->atd_ev_sel       =  $myselect;
        $attendee->atd_title        =  $request->agenda_title;
        $attendee->atd_content      =  $request->agenda_content;
        $attendee->atd_type         =  $request->galadinner;
        $attendee->atd_venue        =  $request->venueofevent;
        $attendee->atd_image        =  $filename1;  
        $attendee->atd_use_color    =  $request->use_color;
        $attendee->atd_border       =  $color_border;
        $attendee->atd_map          =  $request->agenda_map;
        $attendee->save();

        for($i=1;$i<=3;$i++){
            $urls = new Urls;
            $urls->url_name = '/app/attendee/new_registration/'.$evid.'/'.$i;
            $urls->url_code = base_convert("ABC".$evid.$i,10,36);
            $urls->save();
        }
       

        for($i=0;$i<count($request->dateofeventstart);$i++){
            $attendeedetail = new AttendeeDetail;
            $attendeedetail->atdt_agd_id      =  $attendee->atd_id;
            $attendeedetail->atdt_date        =  $request->dateofeventstart[$i];
            $attendeedetail->atdt_time_from   =  $request->time_agenda1[$i];
            $attendeedetail->atdt_time_to     =  $request->time_agenda2[$i];
            $attendeedetail->save();
        }

        return redirect('eventtemplate')->with('success','Add Attendee  Success');
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
        $attendees  = DB::table('tb_attendee')->where('atd_id','=',$id)->first();
        $events = Events::where('ev_pj_id',Session::get('id_project'))->get();
        $colors = Color::all();
        $data = array(
            'attendees' => $attendees,
            'events' => $events,
            'colors' => $colors
        );

        return view('backoffice.attendee.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckAttendee $request, $id)
    {
        // dd($id);
        // dd($request->time_agenda2);
        $project = Projects::where('pj_id',Session::get('id_project'))->first();
       
        if($project->pj_status == 1){
            $find_att = Attendee::where('atd_pj_id',Session::get('id_project'))->first();
           
            if($find_att != null){
               
                $evid = $find_att->atd_ev_id;
               
            }else{
                $im_myselect = implode(',',$request->myselect);
                $evid =  $im_myselect[0];
            }
        }else{
            $im_myselect = implode(',',$request->myselect);
            $evid =  $im_myselect[0];
        }
       

        $myselect = implode(',',$request->myselect);

       
        if($request->use_color != 0){
            $color_border = $request->border_agenda;
        }else{
            if($request->border_pick != ""){
                $color_border = $request->border_pick;
            }else{
                $color_border = "";
            }
          
        }
        // Update information 
        $attendee = Attendee::find($id);
        $attendee->atd_ev_id    =  $evid;
        $attendee->atd_pj_id    =  Session::get('id_project');
        $attendee->atd_ev_sel   =  $myselect;
        $attendee->atd_title    =  $request->agenda_title;
        $attendee->atd_content  =  $request->agenda_content;
        $attendee->atd_type     =  $request->galadinner;
        $attendee->atd_venue    =  $request->venueofevent;
        if($request->hasFile('images_logo')){

            $attendee = Attendee::find($id);
            $test = Storage::delete('event/'.$attendee->atd_image);

            $filename1 = insertSingleImage($request->images_logo, 'event');
            Storage::delete('event/'.$attendee->atd_image);
            $attendee->atd_image    =  $filename1;
        }

        // if($request->hasFile('image_bg')){
        //     $filename2 = insertSingleImage($request->image_bg, 'event');
        //     Storage::delete('event/'.$attendee->atd_bg);
        //     $attendee->atd_bg   =  $filename2;
        // }
        $attendee->atd_use_color    =  $request->use_color;
        $attendee->atd_border   =  $color_border;
        $attendee->atd_map      =  $request->agenda_map;
        $attendee->save();

        //Update time and date
        // $count_attendeedetail = AttendeeDetail::where('atdt_agd_id',$id)->get();
        // if(count($count_attendeedetail) < count($request->dateofeventstart)){
        //     DB::table('tb_attendee_details')->where('atdt_agd_id', '=', $id)->delete();

        //     for($i=0;$i<count($request->dateofeventstart);$i++){
        //         $attendeedetail = new AttendeeDetail;
        //         $attendeedetail->atdt_agd_id      =  $id;
        //         $attendeedetail->atdt_date        =  $request->dateofeventstart[$i];
        //         $attendeedetail->atdt_time_from   =  $request->time_agenda1[$i];
        //         $attendeedetail->atdt_time_to     =  $request->time_agenda2[$i];
        //         $attendeedetail->save();
        //     }

        // }else if(count($count_attendeedetail) > count($request->dateofeventstart)){
        //     DB::table('tb_attendee_details')->where('atdt_agd_id', '=', $id)->delete();
        //     for($i=0;$i<count($request->dateofeventstart);$i++){
        //         $attendeedetail = new AttendeeDetail;
        //         $attendeedetail->atdt_agd_id      =  $id;
        //         $attendeedetail->atdt_date        =  $request->dateofeventstart[$i];
        //         $attendeedetail->atdt_time_from   =  $request->time_agenda1[$i];
        //         $attendeedetail->atdt_time_to     =  $request->time_agenda2[$i];
        //         $attendeedetail->save();
        //     }
        // }else{
        //     for($i=0;$i<count($request->dateofeventstart);$i++){
        //         $attendeedetail = AttendeeDetail::where('atdt_agd_id',$id)->first();
        //         $attendeedetail->atdt_agd_id      =  $id;
        //         $attendeedetail->atdt_date        =  $request->dateofeventstart[$i];
        //         $attendeedetail->atdt_time_from   =  $request->time_agenda1[$i];
        //         $attendeedetail->atdt_time_to     =  $request->time_agenda2[$i];
        //         $attendeedetail->save();
        //     }
        // }
       
        return redirect('eventtemplate')->with('success','Edit Attendee  Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendee = Attendee::destroy($id);
        $attendeedetail = AttendeeDetail::where('atdt_agd_id',$id)->delete();
        if($attendee && $attendeedetail){
            echo 1;
        }
    }

    public function attendee($id,$status,$type){
        
        $attendees  = DB::table('tb_attendee')->leftjoin('tb_projects','tb_attendee.atd_pj_id','=','tb_projects.pj_id')->where('atd_pj_id','=',$id)->get();
        // dd($attendees);
        $data = array(
            'attendees' => $attendees,
            'status' => $status,
            'id' => $id,
        );
        return view('register',$data);
    }

    public function  showdateandttime(Request $request){
        $html = "";
        
        if($request->myselect != "" || $request->myselect != null){
            $myselect = $request->myselect;
            $im_myselect = implode(',',$myselect);
        }else{
            $im_myselect = "";
        }
       
        $events  = DB::table('tb_events')->whereIn('ev_id',explode(',',$im_myselect))->get();
        $html .= view('backoffice.attendee.list', compact('events'))->render();


        return $html;
    }

    public function showcolor(Request $request){
        // $attendee = Attendee::where('atd_id',$request->att_id)->frist();
        $color = Color::where('cl_name',$request->border_agenda)->first();
        // if($attendee->atd_use_color == 1){
            return $color->cl_name;
        // }else{
        //     return "#871619";
        // }
        
    }
    public function showlink(Request $request){
        $id = $request->id;
        
        $html = "";
        $html .= view('backoffice.attendee.link', compact('id'))->render();
        return $html;
    }
    
    public function CreateBG($id){
        $projects = Projects::find($id);
        $data = array(
            'projects' => $projects 
        );
        return view('backoffice.attendee.createbg',$data,compact('id'));
    }

    public function AddBG(Request $request){

        if($request->hasFile('images_bg')){
            $filename1 = insertSingleImage($request->images_bg, 'event');
        }else{
            $filename1 = "";
        }
        $project = Projects::find($request->project_id);
        $project->pj_image  = $filename1;
        $project->save();
        return redirect('eventtemplate')->with('success','Add Background images Success');
    }

    public function EditBG(Request $request){
        $project = Projects::find($request->project_id);
        $test = Storage::delete('event/'.$project->pj_image);
       
        if($request->hasFile('images_bg')){
            $filename1 = insertSingleImage($request->images_bg, 'event');
        }else{
            $filename1 = "";
        }

        $project = Projects::find($request->project_id);
        $project->pj_image  = $filename1;
        $project->save();
        return redirect('eventtemplate')->with('success','Edit Background images Success');
    }
    
}
