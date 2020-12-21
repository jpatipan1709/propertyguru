<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use App\Projects;
use App\Tickets;
use App\Registered;
use App\Badges;
use App\galadinner;
use Storage;
class GalaDinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = DB::table('tb_gala')->where('gl_pj_id','=',Session::get('id_project'))->get();
        
        $data = array(
            'tickets' => $tickets,
        );
        return view('backoffice.gala.index',$data);

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
        $tickets = DB::table('tb_gala')->where('gl_pj_id','=',Session::get('id_project'))->first();
        if( $tickets != "" ||  $tickets != null){
            $tickets = galadinner::where('gl_pj_id',Session::get('id_project'))->first();
            $tickets->gl_name_x                 = $request->width_box1;
            $tickets->gl_name_y                 = $request->heigth_box1;
            $tickets->gl_lastname_x             = $request->width_box2;
            $tickets->gl_lastname_y             = $request->heigth_box2;
            $tickets->gl_company_x              = $request->width_box3;
            $tickets->gl_company_y              = $request->heigth_box3;
            $tickets->gl_table_x                = $request->width_box4;
            $tickets->gl_table_y                = $request->heigth_box4;
            $tickets->gl_text_x                 = $request->width_box5;
            $tickets->gl_text_y                 = $request->heigth_box5;
            $tickets->gl_image_x                = $request->width_box6;
            $tickets->gl_image_y                = $request->heigth_box6;
            $tickets->gl_text                   = $request->text_content;
            if($request->hasFile('images_logo')){
                Storage::delete('gala/'.$tickets->gl_images);
                $filename2 = insertSingleImage($request->images_logo, 'gala');
                $tickets->gl_images                 = $filename2;
            }
            $tickets->gl_size                   = $request->font_size;
            $tickets->gl_color                  = $request->border_pick;
            $tickets->save();
            return redirect('gala')->with('success','Update Gala Dinner Tempalte  Success');
        }else{

            $tickets = new galadinner;
            $tickets->gl_pj_id                  = Session::get('id_project');
            $tickets->gl_name_x                 = $request->width_box1;
            $tickets->gl_name_y                 = $request->heigth_box1;
            $tickets->gl_lastname_x             = $request->width_box2;
            $tickets->gl_lastname_y             = $request->heigth_box2;
            $tickets->gl_company_x              = $request->width_box3;
            $tickets->gl_company_y              = $request->heigth_box3;
            $tickets->gl_table_x                = $request->width_box4;
            $tickets->gl_table_y                = $request->heigth_box4;
            $tickets->gl_text_x                 = $request->width_box5;
            $tickets->gl_text_y                 = $request->heigth_box5;
            $tickets->gl_image_x                = $request->width_box6;
            $tickets->gl_image_y                = $request->heigth_box6;
            $tickets->gl_text                   = $request->text_content;
            if($request->hasFile('images_logo')){
                $filename2 = insertSingleImage($request->images_logo, 'gala');
                $tickets->gl_images                 = $filename2;
            }
            $tickets->gl_size                   = $request->font_size;
            $tickets->gl_color                  = $request->border_pick;
            $tickets->save();
            return redirect('gala')->with('success','Add Gala Dinner Tempalte  Success');
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

    public function  PreviewGala(){

        return view('backoffice.gala.show');
    }
}
