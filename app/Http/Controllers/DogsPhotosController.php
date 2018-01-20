<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DogPhoto;

class DogsPhotosController extends Controller
{
    public $timestamps = false;
    public function create($dog_album_id){
        return view('dogs.create_photo')->with('dog_album_id', $dog_album_id);
    }

    public function store(Request $request){
        $this->validate($request, [
            // 'title' => 'required',
            'photo' => 'image|max:1999'
        ]);

            //Get the filename with the extension
        $filenameWithExt = $request-> file('photo')->getClientOriginalName();
            //Get only the filename
        $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get only the extension of the file
        $extension = $request->file('photo')->getClientOriginalExtension();

          //Create custom filename

        $filenameToStore=$filename.'_'.time().'.'.$extension;

          //Upload image

        $path= $request-> file('photo')->storeAs('public/photos/'.$request->input('dog_album_id'), $filenameToStore);

        // Upload Photo
        $photo=new DogPhoto;
        $photo->dog_album_id =$request->input('dog_album_id');
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->photo = $filenameToStore;

             

        $photo->save();

        return redirect('/albums/'.$request->input('dog_album_id'))->with('success', 'Photo Uploaded');
    
    
    }

    public function destroy($albumId, $photoId)
	{
		DogPhoto::destroy($photoId);
		return redirect('/albums/'.$albumId)->with('success', 'Photo deleted');
	}
}
