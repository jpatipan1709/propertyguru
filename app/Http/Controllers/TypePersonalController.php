<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypePersonal;
use App\Http\Requests\CheckTypeperson;
class TypePersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typepersonals = TypePersonal::all();
        $data = array(
            'typepersonals' => $typepersonals
        );
        return view('backoffice.typepersonal.index',$data);
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
    public function store(CheckTypeperson $request)
    {
        $typepersonal = new TypePersonal;
        $typepersonal->tps_name = $request->typepersonal_name;
        $typepersonal->save();

        return redirect('typeperson')->with('success','Add Type of person Success');

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
        $typepersonal = TypePersonal::find($id);
        $data = array(
            'typepersonal' => $typepersonal
        );
        return view('backoffice.typepersonal.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckTypeperson $request, $id)
    {
        $typepersonal = TypePersonal::find($id);
        $typepersonal->tps_name = $request->typepersonal_name;
        $typepersonal->save();

        return redirect('typeperson')->with('success','Update Type of person Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typepersonal = TypePersonal::destroy($id);

        if($typepersonal == 1){
           echo 1;
        }
    }
}
