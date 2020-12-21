<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registered;
use App\Events;
use App\Projects;
use App\Country;
use App\Attendee;
use App\AttendeeDetail;
use App\Mails;
use App\Color;
use Session;
use DB;
use Excel;
use Storage;
use App\imports\UsersImport;
class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = Mails::where('tbm_pj_id',Session::get('id_project'))->first();
        $colors = Color::all();
        $id = Session::get('id_project');
        $data = array(
            'mails' =>$mails,
            'colors' =>$colors,
            'id' => $id
        );
        return view('backoffice.mail.index',$data);
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
        // dd($request);
        if($request->hasFile('images_logo')){
            $filename1 = insertSingleImage($request->images_logo, 'email');
        }else{
            $filename1 = "";
        }

        $project = Projects::where('pj_id',Session::get('id_project'))->first();
        $mails = Mails::where('tbm_pj_id',$request->id)->get();


        if(count($mails) > 0){
            return redirect('email')->with('danger','Not Add Template Duplication');
        }else{
            $mails = new Mails;
            $mails->tbm_pj_id        =  Session::get('id_project');
            $mails->tbm_ev_id        =  $request->id;
            $mails->tbm_logo         =  $filename1;
            $mails->tbm_content      =  $request->content;
            $mails->tbm_color      =  $request->border_pick;
            $mails->save();
            return redirect('email')->with('success','Add Email Tempalte  Success');
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
        $projects = Projects::find(Session::get('id_project'));
        if($projects->pj_status == 1){
            $mails = Mails::where('tbm_pj_id',$id)->first();
        }else{
            $mails = Mails::where('tbm_ev_id',$id)->first();
        }
      
        $data = array(
            'mails' =>$mails,
        );
        return view('backoffice.mail.show',$data,compact('id'));
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
        // $project = Projects::where('pj_id',Session::get('id_project'))->first();
        // if($project->pj_status == 1){
            $mails = Mails::where('tbm_pj_id',$id)->first();
            // dd($mails->tbm_logo);
           

            $mails = Mails::where('tbm_pj_id',$id)->first();
            $mails->tbm_pj_id        =  Session::get('id_project');
            $mails->tbm_ev_id        =  $request->id;
            if($request->hasFile('images_logo')){
                Storage::delete('email/'.$mails->tbm_logo);
                $filename1 = insertSingleImage($request->images_logo, 'email');
                $mails->tbm_logo         =  $filename1;
            }
            
        
            $mails->tbm_content      =  $request->content;
            $mails->tbm_color        =  $request->border_pick;
            $mails->save();
            return redirect('email')->with('success','Update Email Tempalte  Success');
        // }else{
        //     $mails = Mails::where('tbm_ev_id',$id)->first();
        //     // dd($mails);
        //     $mails->tbm_pj_id        =  Session::get('id_project');
        //     $mails->tbm_ev_id        =  $request->id;
        //     if($request->hasFile('images_logo')){
        //         $filename1 = insertSingleImage($request->images_logo, 'email');
        //         $mails->tbm_logo      =  $filename1;
        //     }
        //     $mails->tbm_content      =  $request->content;
        //     $mails->save();
        //     return redirect('email')->with('success','Update Email Tempalte  Success');
        // }
           
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
