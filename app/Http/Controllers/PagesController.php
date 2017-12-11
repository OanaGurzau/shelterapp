<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title="Bine ati venit!";
        return view ('pages.index')->with('title', $title);  //passing value to the view
    }

    public function about(){
        return view ('pages.about');
    }

    public function adoptables(){
        return view ('pages.adopt');
    }
}
