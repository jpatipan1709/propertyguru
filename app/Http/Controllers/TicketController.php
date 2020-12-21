<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use PDF;
use App\Projects;
use App\Tickets;
use App\Registered;
use Storage;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tickets = DB::table('tb_ticket')->where('tck_pj_id','=',Session::get('id_project'))->get();
        
        $data = array(
            'tickets' => $tickets,
        );

        return view('backoffice.ticket.index',$data);
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
        $tickets = DB::table('tb_ticket')->where('tck_pj_id','=',Session::get('id_project'))->first();
       
        if( $tickets != "" ||  $tickets != null){
            // dd(1);
            $tickets = Tickets::where('tck_pj_id',Session::get('id_project'))->first();
       
            $tickets->tck_pj_id = Session::get('id_project');
            if($request->hasFile('images_logo')){
                Storage::delete('ticket/'.$tickets->tck_images);

                $filename1 = insertSingleImage($request->images_logo, 'ticket');
                $tickets->tck_images = $filename1;
                sleep(2);
            }
           
            if($request->hasFile('images_agenda')){
                Storage::delete('ticket/'.$tickets->tck_agenda);

                $filename = insertSingleImage($request->images_agenda, 'ticket');
                $tickets->tck_agenda = $filename;
                sleep(2);
            }
            
            if($request->hasFile('images_agenda2')){
                Storage::delete('ticket/'.$tickets->tck_agenda);

                $filename2 = insertSingleImage($request->images_agenda2, 'ticket');
                $tickets->tck_agenda2 = $filename2;
                sleep(2);
            }
          
            if($request->hasFile('images_agenda3')){
                Storage::delete('ticket/'.$tickets->tck_agenda3);

                $filename3 = insertSingleImage($request->images_agenda3, 'ticket');
                $tickets->tck_agenda3 = $filename3;
                
            }
            
            $tickets->tck_name_x = $request->width_box1;
            $tickets->tck_name_y = $request->heigth_box1;
            $tickets->tck_lastname_x = $request->width_box2;
            $tickets->tck_lastname_y = $request->heigth_box2;
            $tickets->tck_company_x = $request->width_box3;
            $tickets->tck_company_y = $request->heigth_box3;
            $tickets->tck_qr_x = $request->width_box4;
            $tickets->tck_qr_y = $request->heigth_box4;
            $tickets->tck_width = $request->width_ticket;
            $tickets->tck_height = $request->heigth_ticket;
            $tickets->tck_color = $request->border_pick;
            $tickets->tck_size = $request->font_size;
            $tickets->tck_size_qr = $request->size_qr;
            $tickets->save();
            return redirect('ticket')->with('success','Update E-ticket Tempalte  Success');
        }else{

            $tickets = new Tickets;
            $tickets->tck_pj_id = Session::get('id_project');
            if($request->hasFile('images_logo')){
                $filename1 = insertSingleImage($request->images_logo, 'ticket');
                $tickets->tck_images = $filename1;
            }
            sleep(2);
            if($request->hasFile('images_agenda')){
                $filename2 = insertSingleImage($request->images_agenda, 'ticket');
                $tickets->tck_agenda = $filename2;
            }
            sleep(2);
            if($request->hasFile('images_agenda2')){
               

                $filename2 = insertSingleImage($request->images_agenda2, 'ticket');
                $tickets->tck_agenda2 = $filename2;
            }
            sleep(2);
            if($request->hasFile('images_agenda3')){

                $filename3 = insertSingleImage($request->images_agenda3, 'ticket');
                $tickets->tck_agenda3 = $filename3;
            }
            $tickets->tck_name_x = $request->width_box1;
            $tickets->tck_name_y = $request->heigth_box1;
            $tickets->tck_lastname_x = $request->width_box2;
            $tickets->tck_lastname_y = $request->heigth_box2;
            $tickets->tck_company_x = $request->width_box3;
            $tickets->tck_company_y = $request->heigth_box3;
            $tickets->tck_qr_x = $request->width_box4;
            $tickets->tck_qr_y = $request->heigth_box4;
            $tickets->tck_width = $request->width_ticket;
            $tickets->tck_height = $request->heigth_ticket;
            $tickets->tck_color = $request->border_pick;
            $tickets->tck_size = $request->font_size;
            $tickets->tck_size_qr = $request->size_qr;
            $tickets->save();
            return redirect('ticket')->with('success','Add E-ticket Tempalte  Success');
        }
        // print_r($request->box1['top']);
        
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

    public function showPDF($id){

        $registerd = Registered::where('rg_id',$id)->first();
        $registerd->rg_read = 1;
        $registerd->save();
        // dd($id);
        $tickets = tickets::where('tck_pj_id',$registerd->rg_pj_id)->first();
        $data = array(
            'registerd' => $registerd,
            'tickets' => $tickets,
        );
        return view('backoffice.mail.viewpdf',$data);

        // $pdf =  PDF::loadView('backoffice.mail.viewpdf',$data)->setPaper('A4', 'portrait');;
        // dd($pdf);
        // return $pdf->stream();
    }
}
