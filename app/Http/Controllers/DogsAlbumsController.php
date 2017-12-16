<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DogAlbum;
use App\Dog;
use App\Background;


class DogsAlbumsController extends Controller
{
    public $timestamps = false;

    public function index(){
        $albums=DogAlbum::with('Photos')->get();
        $albums=DogAlbum::paginate(15);
        return view('dogs.list_album')->with('albums', $albums);
    }

    public function create(){
        $dogs = Dog::pluck('name', 'id');
       return view('dogs.create_album')->with('dogsView', $dogs);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'nullable|image|max:1999',
            'breed' => 'required',
            'color' => 'required|regex:/^[a-zA-Z ]+$/', //no number
            'microchip' => 'digits:15', //digits also verify if numeric
            'description'=> 'required',
            'notes'=>'nullable',
        ]);

            //Get the filename with the extension
        $filenameWithExt = $request-> file('cover_image')->getClientOriginalName();
            //Get only the filename
        $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get only the extension of the file
        $extension = $request->file('cover_image')->getClientOriginalExtension();

          //Create custom filename

        $filenameToStore=$filename.'_'.time().'.'.$extension;

          //Upload image

        $path= $request-> file('cover_image')->storeAs('public/album_covers', $filenameToStore);
   

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
        $album->cover_image = $filenameToStore;
        $album->dog_id = $dogs->id;
        $album->save();
 
        
        //Dogs Background

        $background = new Background;
        $background->join_shelter_date = $request->input('join_shelter_date');
        $background->save();

        return redirect('/albums')->with('success', 'Album Created');
    
    }


    public function show($id){
        $album=DogAlbum::with('Photos')->find($id);
        $dogs=Dog::with('DogAlbum')->find($id);
        
        return view('dogs.show_album')
                        ->with('album', $album)
                        ->with('dogs', $dogs);
        
    }


    // public function edit($id){
    //     return view('dogs.edit_album');
    // }





}
