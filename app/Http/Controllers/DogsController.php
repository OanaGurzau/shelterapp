<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Dog;
use App\DogAlbum;
use App\MedicalRecord;
use App\Background;
use App\Adopted;
use App\Adopter;
 

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
        $dogs = Dog::with(['background' => function($query)
        {
            $query->orderBy('id', 'desc');
        }
        ])->paginate(5);
        
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
            'cover_image' => 'sometimes|image|max:1999',
            
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

        // Create Album
        $album=new DogAlbum;
        $album->name = $request->input('name');
        $album->dog_id = $dogs->id;
        $album->cover_image= $request->input('cover_image');

        // //Add new cover image

        //get filename with extension

        if(!empty($request->cover_image)){
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
          }else{
            $filenameWithExt = 'storage/inc/default.jpg'; 
        }
        // $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
         
        //  if(!$filenameWithExt)
        //  {
        //     $filenameWithExt = 'storage/inc/default.jpg'; 
        //  }

        //get just the filename
        
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //get extension
        if(!empty($request->cover_image)){
            $extension=$request->file('cover_image')->getClientOriginalExtension();
        }
            
        // $extension=$request->file('cover_image')->getClientOriginalExtension();


        //create new file name
        if($filename==='default'){
            $filenameToStore=$filename.'.'.'jpg';
        }else{
        $filenameToStore=$filename.'_'.time().'.'.$extension;
        }

        //Upload Image

          $path=$request-> file('cover_image');
          if($path !==null){
             $path->storeAs('public/album_covers', $filenameToStore);
          }

        $album->cover_image = $filenameToStore;


        $album->save();

        

        //Dogs Background

        $background = new Background;
        $background->join_shelter_date = $request->input('join_shelter_date');
        $background->dog_id = $dogs->id;
        $background->save();

      
        

        return redirect('/dogs')->with('success', 'Caine adaugat cu succes!');
        
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
        $background=Background::With('Dog')->find($id);
        
        
        // return view('dogs.show')
        //         ->with('dog', $dog)
        //         ->with('background', $background);

        // $dog=Dog::find($id);
        // $background = Background::with('dog')->get();
        
        return view('dogs.show', compact('dog', 'background'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dog=Dog::with(['background' => function($query) 
        {
            $query->orderBy('id', 'desc');
        }, 
        'medicalrecord'])->find($id);

        $timesAdopted = Dog::join('adopted', 'adopted.dog_id', '=', 'dogs.id')
                            ->where('dogs.id', '=', $id)
                            ->orderBy('adopted.id', 'desc')
                            ->get(['adopted.id', 'adopted.adopter_id']);
        $background=$dog->background;
        $medicalrecord=$dog->medicalrecord;
        $currentAdopterId = null;
        if($timesAdopted !== null && count($timesAdopted) > 0)
        {
            $currentAdopterId = Adopter::find($timesAdopted[0]->adopter_id)->id;  //curentadopterid e un nr
        }
        
        $adopters = Adopter::pluck('name', 'id');

        return view('dogs.edit')->with('dog', $dog)
                                ->with('background', $background)
                                ->with('medicalrecord', $medicalrecord)
                                ->with('adopterView', $adopters)
                                ->with('currentAdopter', $currentAdopterId);
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
            'breed' => 'required',
            'color' => 'required|regex:/^[a-zA-Z ]+$/', //no number
            'microchip' => 'digits:15', //digits also verify if numeric
            'description'=> 'required',
            'notes'=>'nullable',
        ]); 


        //Update Dog

        $dogs=Dog::find($id);
        $dogs->name = $request->input('name');
        $dogs->breed = $request->input('breed');
        $dogs->color = $request->input('color');
        $dogs->sex = $request->input('sex');
        $dogs->microchip = $request->input('microchip');
        $dogs->birthdate = $request->input('birthdate');
        $dogs->notes = $request->input('notes');
        $dogs->description = $request->input('description');
        $dogs->save();


        //Update dogs Background

        $background =new Background;
        $background->join_shelter_date = $request->input('join_shelter_date');
        $background->dog_id = $dogs->id;        
        $background->save();

        // //Update adopter

        $adopter=Adopter::find($id);
        // $adopter->name=$request->input('name');
        // $adopter->address=$request->input('address');
        // $adopter->county=$request->input('county');
        // $adopter->city=$request->input('city');
        // $adopter->phone_number=$request->input('phone_number');
        // $adopter->email=$request->input('email');
        // $adopter->last_home_visit=$request->input('last_home_visit');
        // $adopter->info=$request->input('info');
        // $adopter->save();
        
        
        
        
        
        

        
        //Update adopted

        $adopted=new Adopted;
        $adopted->dog_id=$dogs->id;
        $adopted->adopter_id=$request->input('adopter_id');
        $adopted->date_adopted=$request->input('date_adopted');
        $adopted->save();


        
        return redirect('/dogs')->with('success', 'Inregistrare editata cu success');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        
        // $dogs=Dog::find($id);
        // $background=Background::find($id);
        // $medicalrecord=MedicalRecord::find($id);
        // $dogs->delete();

        Dog::destroy($id);

        return redirect('/dogs')->with('success', 'Inregistrare stearsa');
        
    }
}
