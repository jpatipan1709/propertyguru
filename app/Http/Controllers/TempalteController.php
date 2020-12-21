<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
use App\TypeInput;
use App\Template;
use App\Regisform;
use App\Events;
use App\Attendee;
use App\AttendeeDetail;
use App\Projects;
use App\Http\Requests\CheckTemplate;
use App\Http\Requests\CheckAgenda;

class TempalteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeinputs = TypeInput::all();
        $templates = DB::table('tb_regis_template')
                        ->leftjoin('tb_type_input', 'tb_regis_template.rgt_type_input', '=', 'tb_type_input.tip_id')
                        // ->where('rgf_pj_id','=',Session::get('id_project'))
                        ->get();
        // $events = Events::where('ev_pj_id',Session::get('id_project'))->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->get();
        $events = Events::where('ev_pj_id',Session::get('id_project'))->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->first();
        $data = array(
            'typeinputs' => $typeinputs,
            'templates' => $templates,
            'events' => $events
        );
        return view('backoffice.template.index',$data);
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
        // if(count($request->myselect) > 0){
            $im_myselect = implode(',',$request->myselect);
            $regisform = new Regisform;
            $regisform->rgf_rgt_id  = $im_myselect;
            $regisform->rgf_pj_id   = Session::get('id_project');
            $regisform->save();
        // }else{
        //     return redirect('tempalte')->with('danger','Add Form Error');
        // }
      
            return redirect('tempalte')->with('success','Add Regiter Form Success');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("test2");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $templates = DB::table('tb_regis_template')
                        ->leftjoin('tb_type_input', 'tb_regis_template.rgt_type_input', '=', 'tb_type_input.tip_id')
                        ->get();
        $projects = Projects::where('pj_id',Session::get('id_project'))->first();
        if($projects->pj_status == 1){
            $events = Events::where('ev_pj_id',$id)->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->first();
        }else{
            $events = Events::where('ev_id',$id)->leftjoin('tb_projects','tb_events.ev_pj_id','=','tb_projects.pj_id')->first();
        }
        
     
        $data = array(
            'templates' => $templates,
            'events' => $events,
        );

        return view('backoffice.template.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckTemplate $request, $id)
    {
        // dd($request->myselect);
        if(count($request->myselect) > 0){
            $im_myselect = implode(',',$request->myselect);
 
            $regisform = Regisform::where('rgf_pj_id',$id)->first();
           
            if( $regisform != null){
               
                $regisform->rgf_rgt_id  = $im_myselect;
                $regisform->rgf_pj_id   = Session::get('id_project');
                $regisform->rgf_ev_id   = $id;
                $regisform->save();
                return redirect('tempalte')->with('success','Update Regiter Form Success');
            }else{
                $regisform = new Regisform;
                $regisform->rgf_rgt_id  = $im_myselect;
                $regisform->rgf_pj_id   = Session::get('id_project');
                $regisform->rgf_ev_id   = $id;
                $regisform->save();
                return redirect('tempalte')->with('success','Add Regiter Form Success');
            }
          
        }else{
            return redirect('tempalte')->with('danger','Add Form Error');
        }
      
            
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




}
