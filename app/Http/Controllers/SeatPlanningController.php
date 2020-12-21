<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables;
use App\Seats;
use App\Registered;
use Session;
use DB;
class SeatPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $seats = DB::table('tb_seats')->where('s_pj_id','=',Session::get('id_project'))->get();
      $tb_tables = DB::table('tb_tables')->where('tb_pj_id','=',Session::get('id_project'))->get();
      $data = array(
          'seats' => $seats,
          'tb_tables' => $tb_tables,
      );
      return view('backoffice.seating.index',$data);
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
      
        $seats = DB::table('tb_seats')->where('s_pj_id','=',Session::get('id_project'))->count();

        if($seats <= 0){
            $seats                 =      new Seats;
            $seats->s_pj_id        =      Session::get('id_project');
            $seats->s_stage_x      =      $request->stage_x;
            $seats->s_stage_y      =      $request->stage_y;
            $seats->s_width        =      $request->width_stage;
            $seats->s_height       =      $request->height_stage;
            $seats->save();
            return redirect('seatplanning')->with('success','Add  Seat Planning Tempalte  Success');
        }else{
            // dd(Session::get('id_project'));
            // dd($request->stage_y);
            $seats                 =      Seats::where('s_pj_id',Session::get('id_project'))->first();
            $seats->s_stage_x      =      $request->stage_x;
            $seats->s_stage_y      =      $request->stage_y;
            $seats->s_width        =      $request->width_stage;
            $seats->s_height       =      $request->height_stage;
            $seats->save();
            return redirect('seatplanning')->with('success','Update Seat Planning Tempalte  Success');
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

    public function addseat(Request $request){
    
      $tables                     =      new Tables;
      $tables->tb_pj_id           =      Session::get('id_project');
      $tables->tb_no              =      $request->table_no;
      $tables->tb_name            =      $request->table_name;
      $tables->tb_position_x      =      0;
      $tables->tb_position_y      =      0;
      $tables->tb_person          =      $request->seats;
      $tables->save();

      echo $tables;
    }

    public function updateseat($no,$x,$y){
        // echo $no;
        $tables                     =      Tables::where('tb_no',$no)->where('tb_pj_id',Session::get('id_project'))->first();
    //    print_r($tables);
    //    exit();
        $tables->tb_position_x      =      $x;
        $tables->tb_position_y      =      $y;
        $tables->save();
    }

    public function addseat_register(Request $request){
       
        $tables  = Tables::where('tb_no',$request->table_no)->first();
        if(count($request->check_del) > $tables->tb_person ){
            return redirect('AddRegisterSeat'.'/'.$request->table_no)->with('danger','Over Limit Person');
        }else{
            foreach($request->check_del as $items){
                $registered = Registered::find($items);
                $registered->rg_seat = 1;
                $registered->save();
            }
            $im_seat = implode(',',$request->check_del);
           
            if($tables->tb_seat !== null){
                $im_seat2 =  $im_seat.','.$tables->tb_seat;
            }else{
                $im_seat2 = $im_seat;
            }
            $tables                     =      Tables::where('tb_no',$request->table_no)->first();
            $tables->tb_seat            =     $im_seat2;
    
            $tables->save();
            return redirect('AddRegisterSeat'.'/'.$request->table_no)->with('success','Add Seating Success');
        }
        
    }   

    public function setsession($n){
        // $html = "";
        // $registereds = Registered::where('rg_seat','<>',1)->get();
        // $tables = Tables::where('tb_no', $n)->first();
        // $registereds2 = DB::table('tb_register')->whereIn('rg_seat',explode(',',$tables->tb_seat))->get();
        // echo '<table>';
        //     echo '<thead>';
        //         echo '<th>No.<th>';
        //         echo '<th>Name - LastName<th>';
        //         echo '<th>No.<th>';

        //     echo '</thead>';
        //     echo '<tbody>';
            
        //     echo '</tbody>';
        // echo '</table>';
        // // foreach ($registereds2 as $key2 => $registered2){
        // //     $html .='<option value='.$registered2->rg_id.'>'.$registered2->rg_name.' '.$registered2->rg_lastname.' '.$registered2->rg_company.'</option>';
        // // }
                                            
        //  echo $html;
                                    
                                        
                                       
        //                             //    return response()->json(['html' => $html]);
        // // echo $n.'  = = '.Session::get('key_no');
    }

    public function AddRegisterSeat ($id){
        $data = array(
            'id' => $id,
        );
        return view('backoffice.seating.manageseating',$data);
    }

    public function sorting_seat(Request $request){

        $im_seat = implode(',',$request->sorting_list);
        $tables                     =     Tables::where('tb_no',$request->table_no)->first();
        $tables->tb_seat            =     $im_seat;
        $tables->save();
        return redirect('AddRegisterSeat'.'/'.$request->table_no)->with('success','Sorting Seating Success');
    }

    public  function deletetable($id){
        $tables = DB::table('tb_tables')->where('tb_no', '=', $id)->first();
        if( $tables != null){
            $ex_tables = explode(',',$tables->tb_seat);
            foreach($ex_tables as $ex_table){
         
                DB::table('tb_register')
                    ->where('rg_id', $ex_table)
                    ->update(['rg_seat' => '0']);
            }
          
            DB::table('tb_tables')->where('tb_no', '=', $id)->delete();
        }
       
        return redirect('seatplanning')->with('danger','Delete table Success');
    }

    public  function editseat($id){
        $tables = DB::table('tb_tables')->where('tb_id', '=', $id)->first();
       
        $data = array(
            'tables' => $tables
        );
        return $data;
    }

    public  function  updateseat2($id,$limit,$name){
      
        $tables = Tables::where('tb_id', '=', $id)->first();
       
        $tables->tb_name = $name;
        $tables->tb_person = $limit;
        $tables->save();
  
        $data = array(
            'tables' => $tables
        );
        return $data;
    }

    public  function deleteseat($id,$seat){
      
        $tables = Tables::where('tb_id', '=', $id)->first();
        $ex_seat = explode(',',$tables->tb_seat);
        $b = array_diff($ex_seat,$seat);
        // $c = explode(',',$tables->tb_seat);
        // unset($c[$b]);
    }
}
