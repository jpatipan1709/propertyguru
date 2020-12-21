<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Session;
use DB;
use App\Http\Requests\Checkcountry;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countrys = Country::all();
        $data = array(
            'countrys' => $countrys
        );

        return view('backoffice.country.index',$data);
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
    public function store(Checkcountry $request)
    {
        $country = new Country;
        $country->ct_name = $request->country_name;
        $country->save();

        return redirect('country')->with('success','Add Country Success');
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
        $country = Country::find($id);
        $data = array(
            'country' => $country
        );

        return view('backoffice.country.edit',$data);
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
        $country = Country::find($id);
        $country->ct_name = $request->country_name;
        $country->save();

       return redirect('country')->with('success','Edit Country Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::destroy($id);

        if($country == 1){
           echo 1;
        }
    }
}
