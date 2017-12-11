<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DogAlbum;

class DogsAlbumsController extends Controller


{
    public $timestamps = false;

    public function index(){
        $albums=DogAlbum::with('Photos')->get();
        return view('dogs.list_album')->with('albums', $albums);
    }

    public function create(){
        return view('dogs.create_album');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999'
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

        // Create Album
        $album=new DogAlbum;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;

        

        $album->save();

        return redirect('/albums')->with('success', 'Album Created');
    
    }


}
