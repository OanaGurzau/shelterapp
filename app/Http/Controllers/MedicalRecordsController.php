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
    public function show()
    {
        $medicalrecords=MedicalRecord::all();
        $medicalrecords = DB::table('medicalrecord')
        ->join('dogs', 'medicalrecord.dog_id', '=', 'dogs.id')->get();
        
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

            return redirect('/medicalrecord')->with('success', 'Istoric medical salvat!');

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

        return redirect('/medicalrecord')->with('success', 'Inregistrare Stearsa!');
        
    }
}
