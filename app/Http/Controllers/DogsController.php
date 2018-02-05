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
use Validator;
 

class DogsController extends Controller
{
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
        return view('dogs.create');
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
            'microchip' => 'digits:15|unique:dogs,microchip',
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
        $dogs->save();

        // Create Album
        $album=new DogAlbum;
        $album->name = $request->input('name');
        $album->dog_id = $dogs->id;
        $album->cover_image= $request->input('cover_image');

        // //Adding an image for the album cover

        //get entire name of the image with the extension
        if(!empty($request->cover_image)){
            $entireImageName=$request->file('cover_image')->getClientOriginalName();
            //get only the image name
            $imageName = pathinfo($entireImageName, PATHINFO_FILENAME);
        
                //get only image extension
                if(!empty($request->cover_image)){
                    $extension=$request->file('cover_image')->getClientOriginalExtension();
                }
        
                //create new name for the image file
                if($imageName==='default'){
                    $newImageName=$imageName.'.'.'jpg';
                }else{
                $newImageName=$imageName.'_'.time().'.'.$extension;
                }
        
                //save the new image
        
                  $path=$request-> file('cover_image');
                  if($path !==null){
                     $path->storeAs('public/album_covers', $newImageName);
                  }
        
                $album->cover_image = $newImageName;
        
        }


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
        $background=Background::With('Dog')->find($id); 
        return view('dogs.show')->with('background', $background);  
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
            $currentAdopterId = $timesAdopted[0]->adopter_id;
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
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'breed' => 'required',
            'color' => 'required|regex:/^[a-zA-Z ]+$/', //no number
            'microchip' => 'digits:15', //digits also verify if numeric
            'description'=> 'required|max:1000',
            'notes'=>'nullable'
        ]);

        $v->sometimes('adopter_id', 'required', function($input){
            return $input->adopted == 1;
        });

        if ($v->fails()) {
            return redirect()
                        ->action('DogsController@edit', ['id' => $id])
                        ->withErrors($v)
                        ->withInput();
        }


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
        $dogs->adopted=$request->input('adopted');
        $dogs->save();

        //Update dogs Background

        $background =new Background;
        $background->join_shelter_date = $request->input('join_shelter_date');
        $background->dog_id = $dogs->id;        
        $background->save();

        //Update adopter

        $adopted=new Adopted;
        $adopted->dog_id=$dogs->id;
        if($request->input('adopted') == '1')
        {
            $adopted->adopter_id=$request->input('adopter_id');
        }

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
        $dog=Dog::find($id);
        $dog->delete(); 
        return redirect('/dogs')->with('success', 'Inregistrare stearsa');
        
    }
}
