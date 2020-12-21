<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Registered;
use App\TypePersonal;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){

        $events = Events::where('ev_pj_id',Session::get('id_project'))->get();
        $registere_count = Registered::where('rg_pj_id',Session::get('id_project'))->count();
        $typepersonals = TypePersonal::all();
        $data = array(
            'events' => $events,
            'registere_count' => $registere_count,
            'typepersonals' => $typepersonals
        );
        return view('backoffice.dashboard',$data);
    }
}
