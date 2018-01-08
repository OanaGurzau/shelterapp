<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Dog;
 

class DogsController extends Controller
{
    public $timestamps = false;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dogs=Dog::paginate(5);
        return view('dogs.table')->with('dogs', $dogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dog = Dog::pluck('name', 'id');
        return view('dogs.create')->with('dogView', $dog);
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
            'breed' => 'required',
            'color' => 'required|regex:/^[a-zA-Z ]+$/', //no number
            'microchip' => 'digits:15', //digits also verify if numeric
            'description'=> 'required',
            'notes'=>'nullable',
        ]);
        
        //Create Dog

        $dogs=new Dog;
        $dogs->name = $request->input('name');
        $dogs->breed = $request->input('breed');
        $dogs->color = $request->input('color');
        $dogs->sex = $request->input('sex');
        $dogs->microchip = $request->input('microchip');
        $dogs->birthdate = $request->input('birthdate');
        $dogs->notes = $request->input('notes');
        $dogs->description = $request->input('description');
        $dogs->adopted = $request->input('adopted');
        
        $dogs->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dog=Dog::find($id);
        return view('dogs.show')
        ->with('dog', $dog);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dog=Dog::find($id);
        return view('dogs.edit')->with('dog', $dog);
        
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
        $dogs=Dog::find($id);
        $dogs->delete();

        return redirect('/dogs')->with('success', 'Inregistrare stearsa');
        
    }
}
