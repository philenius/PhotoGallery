<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

class MainController extends Controller
{
    public function getIndex()
    {
    	$allPhotos = Photo::all();
    	return view('index')->with('photos', $allPhotos);
    }
}
