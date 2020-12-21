<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Projects;
use App\Template;
use App\Regisform;
use App\Events;
use App\ProjectDetail;
use App\Http\Requests\CheckProject;

use DB;
use Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = DB::table('tb_projects')
                        ->leftjoin('tb_project_details','tb_projects.pj_id','=','tb_project_details.pjd_pj_id')
                        ->where('pj_id','<>',1)
                        ->get();
        $templates = DB::table('tb_regis_template')->leftjoin('tb_type_input', 'tb_regis_template.rgt_type_input', '=', 'tb_type_input.tip_id')->get();
        $data = array(
            'projects' => $projects,
            'templates' => $templates,
        );
        return view('backoffice.project.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = DB::table('tb_regis_template')
                            ->leftjoin('tb_type_input', 'tb_regis_template.rgt_type_input', '=', 'tb_type_input.tip_id')
                            ->get();
        $data = array(
            'templates' => $templates,
        );
        return view('backoffice.project.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckProject $request)
    {
        
        // if(count($request->myselect) > 0){
           
        //     foreach($request->myselect as $myselect2){
        //         $events = Events::find($myselect2);
        //         $events->ev_status = 1;
        //         $events->save();
        //     }
            
        // }
        if($request->final_project == 1){
            $project_name = $request->project_name;
        }else{
            $project_name = $request->project_name;
        }
        
        $projects = new Projects;
        $projects->pj_name = $project_name;
        $projects->pj_status = $request->final_project;
        $projects->pj_image = "";
        $projects->save();

        // if(count($request->myselect) > 0){
        //     $event_name = implode(", ", array_filter($request->myselect));
        // }else{
        //     $event_name = 0;
        // }

        // $projectdetail = new ProjectDetail;
        // $projectdetail->pjd_pj_id =  $projects->pj_id;
        // $projectdetail->pjd_ev_id = $event_name;
        // $projectdetail->save();


        return redirect('project')->with('success','Add Project Success');
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
       

        $projects = DB::table('tb_projects')
                        ->leftjoin('tb_project_details', 'tb_projects.pj_id', '=', 'tb_project_details.pjd_pj_id')
                        ->where('pj_id','=',$id)
                        ->first();
                        
        $events = DB::table('tb_events')->whereIn('ev_id',explode(',',$projects->pjd_ev_id))->get();
        $events_all = DB::table('tb_events')->whereNotIn('ev_id',explode(',',$projects->pjd_ev_id))->get();
        $data = array(
            'projects' => $projects,
            'events' => $events,
            'events_all' => $events_all
        );
        return view('backoffice.project.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckProject $request, $id)
    {
    

     
  
        // $event_name = implode(",", array_filter($request->myselect));
        if($request->final_project == 1){
            $project_name = $request->project_name."(Grand Final)";
        }else{
            $project_name = $request->project_name;
        }

        
        $projects = Projects::find($id);
        $projects->pj_name = $project_name;
        $projects->pj_status = $request->final_project;
        $projects->save();

      
        // $projectdetail = ProjectDetail::where('pjd_pj_id',$id)->first();
        // $projectdetail->pjd_ev_id = $event_name;
        // $projectdetail->save();

        return redirect('project/'.$id.'/edit')->with('success','Edit Project Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projects = Projects::destroy($id);
        echo  $projects;
    }

    public function changeproject(Request $request){
      
        if($request->status == 'project'){
            $projects = Projects::find($request->id);
            $projects2 = Projects::where('pj_id',$request->id)->leftjoin('tb_events','tb_projects.pj_id','=','tb_events.ev_pj_id')->first();
            session(['id_project' => $projects->pj_id]);
            session(['project_name' => $projects->pj_name]);
            session(['project_status' => $projects->pj_name]);
            session(['id_event' => $projects2->ev_id]);
            session(['event_name' => $projects2->ev_name]);
            if($request->id != "" || $request->id != null){
                echo $request->id;
            }
        }else{
            $events = Events::find($request->id);

            session(['id_event' => $events->ev_id]);
            session(['event_name' => $events->ev_name]);
            if($request->id != "" || $request->id != null){
                echo $request->id;
            }
        }
      
    }
}
