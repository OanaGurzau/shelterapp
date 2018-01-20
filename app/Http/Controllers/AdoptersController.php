<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adopter;

class AdoptersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
	{
		$this->middleware('auth');
	}
     public function index()
    {
        $adopter=Adopter::paginate(5);
        return view('adopters.table')
            ->with('adopters', $adopter);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adopters.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'county' => 'required',
            'city' => 'required',
            'phone_number' =>'required|digits:10',
            'email'=>'sometimes',
            'last_home_visit'=>'sometimes',
            'info'=>'sometimes'
        ]);

        //Create new adopter

        $adopter=new Adopter;
        $adopter->name=$request->input('name');
        $adopter->address=$request->input('address');
        $adopter->county=$request->input('county');
        $adopter->city=$request->input('city');
        $adopter->phone_number=$request->input('phone_number');
        $adopter->email=$request->input('email');
        $adopter->last_home_visit=$request->input('last_home_visit');
        $adopter->info=$request->input('info');
        $adopter->save();
        
        return redirect('/adopter')->with('success', 'Inregistrare adaugata cu succes!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $adopter=Adopter::find($id);
        return view('adopters.show')
             ->with('adopter', $adopter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $adopter=Adopter::find($id);
       return view('adopters.edit')->with('adopter', $adopter);
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
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'county' => 'required',
            'city' => 'required',
            'phone_number' =>'required|digits:10',
            'email'=>'sometimes',
            'last_home_visit'=>'sometimes',
            'info'=>'sometimes'
        ]);


        $adopter=Adopter::find($id);
        $adopter->name=$request->input('name');
        $adopter->address=$request->input('address');
        $adopter->county=$request->input('county');
        $adopter->city=$request->input('city');
        $adopter->phone_number=$request->input('phone_number');
        $adopter->email=$request->input('email');
        $adopter->last_home_visit=$request->input('last_home_visit');
        $adopter->info=$request->input('info');
        $adopter->save();
        
        return redirect('/adopter')->with('success', 'Inregistrare editata cu succes!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adopter=Adopter::find($id);
        $adopter->delete();

        return redirect('/adopter')->with('success', 'Inregistrare Stearsa!');
    }
}
