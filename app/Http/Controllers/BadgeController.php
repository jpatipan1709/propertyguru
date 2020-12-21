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
use Storage;
class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = DB::table('tb_badge')->where('b_pj_id','=',Session::get('id_project'))->get();
        
        $data = array(
            'tickets' => $tickets,
        );
        return view('backoffice.badge.index',$data);
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
        $tickets = DB::table('tb_badge')->where('b_pj_id','=',Session::get('id_project'))->first();
        if( $tickets != "" ||  $tickets != null){
            $tickets = Badges::where('b_pj_id',Session::get('id_project'))->first();
            $tickets->b_name_x              = $request->width_box1;
            $tickets->b_name_y              = $request->heigth_box1;
            $tickets->b_lastname_x          = $request->width_box2;
            $tickets->b_lastname_y          = $request->heigth_box2;
            $tickets->b_company_x           = $request->width_box3;
            $tickets->b_company_y           = $request->heigth_box3;
            $tickets->b_department_x        = $request->width_box4;
            $tickets->b_department_y        = $request->heigth_box4;
            $tickets->b_images_x            = $request->width_box5;
            $tickets->b_images_y            = $request->heigth_box5;
            $tickets->b_images_size         = $request->font_size_images;
            
            $tickets->b_width               = $request->width_size;
            $tickets->b_height              = $request->height_size;
            if($request->hasFile('images_logo')){
                Storage::delete('ticket/'.$tickets->b_images);
                $filename = insertSingleImage($request->images_logo, 'ticket');
                $tickets->b_images = $filename;
            }
            $tickets->b_color               = $request->border_pick;
            $tickets->b_size                = $request->font_size;
            $tickets->save();
            return redirect('badge')->with('success','Update Badge Tempalte  Success');
        }else{

            $tickets = new Badges;
            $tickets->b_pj_id             = Session::get('id_project');
            $tickets->b_name_x              = $request->width_box1;
            $tickets->b_name_y              = $request->heigth_box1;
            $tickets->b_lastname_x          = $request->width_box2;
            $tickets->b_lastname_y          = $request->heigth_box2;
            $tickets->b_company_x           = $request->width_box3;
            $tickets->b_company_y           = $request->heigth_box3;
            $tickets->b_department_x        = $request->width_box4;
            $tickets->b_department_y        = $request->heigth_box4;
            $tickets->b_images_x            = $request->width_box5;
            $tickets->b_images_y            = $request->heigth_box5;
            $tickets->b_images_size         = $request->font_size_images;
            $tickets->b_width               = $request->width_size;
            $tickets->b_height              = $request->height_size;
            if($request->hasFile('images_logo')){
                $filename = insertSingleImage($request->images_logo, 'ticket');
                $tickets->b_images = $filename;
            }
            $tickets->b_color               = $request->border_pick;
            $tickets->b_size                = $request->font_size;
            $tickets->save();
            return redirect('badge')->with('success','Add Badge Tempalte  Success');
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

    public function  PreviewBadge(){

        return view('backoffice.badge.show');
    }
}
