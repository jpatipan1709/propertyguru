<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registered;
use Session;
use DB;
class ShowDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    
    public function ShowRegister(){
        $registerds  =  DB::table('tb_register')
                             ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                             ->where('rg_pj_id',Session::get('id_project'))->get();
        $data = array(
         'registerds' => $registerds 
        );
 
        return view('backoffice.showdata.index',$data);
     }
    public function ShowCheckIn($id){
       $registerds  =  DB::table('tb_register')
                            ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                            ->where('rg_pj_id',Session::get('id_project'))
                            ->where('rg_type_personal',$id)
                            ->where('rg_status','=',1)->get();
       $data = array(
        'registerds' => $registerds 
       );

       return view('backoffice.showdata.index',$data);
    }

    public function ShowNotCheckIn($id){
        $registerds  =  DB::table('tb_register')
                             ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                             ->where('rg_pj_id',Session::get('id_project'))
                             ->where('rg_type_personal',$id)
                             ->where('rg_status','=',null)->get();
        $data = array(
         'registerds' => $registerds 
        );
 
        return view('backoffice.showdata.index',$data);
     }

     public function ShowTypePersonal($id){
        $registerds  =  DB::table('tb_register')
                        ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                        ->where('rg_pj_id',Session::get('id_project'))
                        ->where('rg_type_personal',$id)
                        ->get();

        $data = array(
        'registerds' => $registerds 
        );

        return view('backoffice.showdata.index',$data);
     }

     public function ShowLink($id){ 
        $registerds  =  DB::table('tb_register')
                        ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                        ->where('rg_pj_id',Session::get('id_project'))
                        ->where('rg_type_id',$id)
                        ->get();

        $data = array(
        'registerds' => $registerds 
        );

        return view('backoffice.showdata.index',$data);
     }

     public function ShowEvent($id){ 
       
        $registerds  =  DB::table('tb_register')
                            ->leftjoin('tb_typepersonal','tb_register.rg_type_personal','=','tb_typepersonal.tps_id')
                            ->where('rg_pj_id',Session::get('id_project'))
                            ->whereRaw("find_in_set($id,rg_event_id)")
                            ->get();

        $data = array(
        'registerds' => $registerds 
        );

        return view('backoffice.showdata.index',$data);
     } 
}
