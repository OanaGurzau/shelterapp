<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Dog;
use App\DogAlbum;

class MessagesController extends Controller
{
    public function index(){
        $albumView = DogAlbum::pluck('name', 'dog_id');
        return view('pages.contact')->with('albumView', $albumView);
    }

    public function submit(Request $request){
        
        $this->validate($request, [
            'name' =>'required',
            'email' =>'required',
            'phone' => 'required',
            'message' => 'required'
        ]);
        
        // Create New Message
        $messages = new Message;
        $messages->name = $request->input('name');
        $messages->email = $request->input('email');
        $messages->phone = $request->input('phone');
        $messages->message = $request->input('message');
        $messages->dog_id=$request->input('dog_id');

        // Save Message
        $messages->save();

      // Redirect
      return redirect('/contact') ->with('success', 'Message Sent');
    }

    public function getMessages(){
        $messages = Message::paginate(5);
  
        return view('pages.messages')->with('messages', $messages);
      }
    
    public function destroy($id)
    {
        $messages=Message::find($id);
        $messages->delete(); 

        return redirect('/messages')->with('success', 'Mesaj Sters');
        
    }

}
