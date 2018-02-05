<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; //delete it from the library
use App\DogAlbum;
use App\Dog;
use App\MedicalRecord;
use App\Background;


class DogsAlbumsController extends Controller
{
    public $timestamps = false;

    public function index(Request $request){
        if($request->has('adoptat'))
        {
            if($request->input('adoptat') === 'adoptat')
            {
                $albums = DogAlbum::with(['dog'])->whereHas('dog', function($query){
                    $query->where('adopted', '=', '1');
                })->paginate(9)->appends('adoptat', $request->input('adoptat'));
                // select * from dog_albums inner join dogs on dog_albums.dog_id = dogs.id where dogs.adoptat = 1
            }
            else
            {
                $albums = DogAlbum::with(['dog'])->whereHas('dog', function($query){
                    $query->where('adopted', '=', '0');
                })->paginate(9)->appends('adoptat', $request->input('adoptat'));
            }
        }
        else
        {
            $albums = DogAlbum::with('Dog')->paginate(9);
        }
        
        return view('dogs.list_album')->with('albums', $albums);
    }

    public function create(){
        $dogs = Dog::whereNotIn('id', function($query) {
            $query->select('dog_id')->from('dog_albums');
        })->pluck('name', 'id');
       return view('dogs.create_album')->with('dogsView', $dogs);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cover_image' => 'sometimes|image|max:1999',
        ]);

        // Create Album
        $album=new DogAlbum;
        $album->name = $request->input('name');
        $album->dog_id = $request->input('dog_id');

         //Adding an image for the album cover
        //get entire name of the image with the extension
        $entireImageName = $request->file('cover_image')->getClientOriginalName();
        
        //get only the image name
        $imageName = pathinfo($entireImageName, PATHINFO_FILENAME);

        //get only image extension
        $extension=$request->file('cover_image')->getClientOriginalExtension();

        //create new name for the image file
        $newImageName=$imageName.'_'.time().'.'.$extension;

        //save the new image
        $path=$request->file('cover_image')->storeAs('public/album_covers', $newImageName); 

        $album->cover_image = $newImageName;
        $album->save();



        return redirect('/albums')->with('success', 'Album Created');

    }



    

 

    public function show($id){

        $album=DogAlbum::with('Photos')->find($id);
        $dogs=$album->dog;
        $background=Background::With('Dog')->find($dogs->id);
        $medicalrecord=MedicalRecord::With('Dog')->find($dogs->id);

        return view('dogs.show_album')
                        ->with('album', $album)
                        ->with('dogs', $dogs)
                        ->with('background', $background)
                        ->with('medicalrecord', $medicalrecord);
    }


    public function edit($id){
        $album=DogAlbum::with('dog')->find($id);
        return view('dogs.edit_album')->with('album', $album);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cover_image' => 'sometimes|image|max:1999',
        ]); 

        // Create Album
        $album=DogAlbum::find($id);

        //Update new album image upon editing

        if ($request->hasFile('cover_image')){
           //get imagename with extension
        
                $entireImageName = $request->file('cover_image')->getClientOriginalName();
                
                //get just the imagename
                $imageName = pathinfo($entireImageName, PATHINFO_FILENAME);

                //get extension
                $extension=$request->file('cover_image')->getClientOriginalExtension();

                //create new  name for the image
                
                $newImageName=$imageName.'_'.time().'.'.$extension;

                //Upload Image

                $path=$request->file('cover_image')->storeAs('public/album_covers', $newImageName);              
           
           
                       
            $oldImageNameToStore=$album->cover_image;

            //Update database with new photo
          $album->cover_image=$newImageName;

            //Delete old photo
            Storage::delete('public/album_covers/'.$oldImageNameToStore);            
        }
        

        $album->save();
 


        return redirect('/albums')->with('success', 'Album Updated');
    
    
       
    }

    public function destroy($id){
        $album=DogAlbum::with('dog')->find($id);
        $album->delete();
        return redirect('/albums')->with('success', 'Album sters');
        
    }




}
