<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MedicalRecord;
use App\Dog;
use DB;

class MedicalRecordsController extends Controller
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
        $medicalrecords = MedicalRecord::with('Dog')->paginate(5);
        
        return view('medical.table')
            ->with('medicalrecords', $medicalrecords)
            ;
    }

    // public function index()
    // {
    //     // $medicalrecords=MedicalRecord::all();
    //     $medicalrecords = DB::table('medicalrecord')
    //     ->join('dogs', 'medicalrecord.dog_id', '=', 'dogs.id')->paginate(5);
        
        
    //     return view('medical.table')
    //         ->with('medicalrecords', $medicalrecords)
    //         ;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dogs = Dog::pluck('name', 'id');
        return view('medical.create')->with('dogsView', $dogs);
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
            'rabies_vaccine_date' => 'sometimes',
            'next_rabies_vaccine_date' => 'required',
            'deworming_date' => 'sometimes',
            'next_deworming_date' => 'required'

        ]);

        //Link Dog

        // $dogs = DB::table('dogs')
        // ->join('medicalrecord', 'dogs.id', '=', 'medicalrecord.dog_id')
        // ->select('dogs.name')
        // ->get();

       
        $dogs = Dog::pluck('name', 'id');

        //Create Medical Record
        $medicalrecord= new MedicalRecord;
        $medicalrecord->rabies_vaccine_date=$request->input('rabies_vaccine_date');
        $medicalrecord->next_rabies_vaccine_date=$request->input('next_rabies_vaccine_date');
        $medicalrecord->deworming_date=$request->input('deworming_date');
        $medicalrecord->next_deworming_date=$request->input('next_deworming_date');
        $medicalrecord->sterilized = $request->input('sterilized');   
        $medicalrecord->dog_id =$request->input('dog_id');
        

        $medicalrecord->save();

        return redirect('/medicalrecords')->with('success', 'Istoric medical creat!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicalrecords=MedicalRecord::with('Dog')->find($id);
        // $medicalrecords=MedicalRecord::find($id);
        // $medicalrecords = DB::table('medicalrecord')
        // ->join('dogs', 'medicalrecord.dog_id', '=', 'dogs.id')->get();
        
        return view('medical.show')
            ->with('medicalrecords', $medicalrecords)
        
        ; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $medicalrecord=MedicalRecord::find($id);
        return view('medical.edit')-> with('medicalrecord', $medicalrecord);
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
            'rabies_vaccine_date' => 'sometimes',
            'next_rabies_vaccine_date' => 'required',
            'deworming_date' => 'sometimes',
            'next_deworming_date' => 'required'

        ]);

            //update Medical Record

            $medicalrecord =MedicalRecord::find($id);
            $medicalrecord->rabies_vaccine_date=$request->input('rabies_vaccine_date');
            $medicalrecord->next_rabies_vaccine_date=$request->input('next_rabies_vaccine_date');
            $medicalrecord->deworming_date=$request->input('deworming_date');
            $medicalrecord->next_deworming_date=$request->input('next_deworming_date');
            $medicalrecord->sterilized = $request->input('sterilized');            
            $medicalrecord->save();

            return redirect('/medicalrecords')->with('success', 'Istoric medical salvat!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalrecord=MedicalRecord::find($id);
        $medicalrecord->delete(); 

        // MedicalRecord::destroy($id);

        return redirect('/medicalrecords')->with('success', 'Inregistrare Stearsa!');
        
    }
}
