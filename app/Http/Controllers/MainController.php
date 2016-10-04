<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

use App\PhotoSubject;

class MainController extends Controller
{
	private static $fileUploadDirectory = 'uploads';

    public function getIndex()
    {
    	$allPhotos = Photo::all();
    	$allPhotoSubjects = PhotoSubject::all();
    	return view('index')->with('photos', $allPhotos)->with('photoSubjects', $allPhotoSubjects);
    }

    public function uploadPhoto(Request $request)
    {

		$this->validate($request, [
	        'photoTitle' => 'required',
	        'photoLocation' => 'required',
	        'photo' => 'required|image',
	        'photoSubject' => 'required'
	    ]);

    	$photo = Input::file('photo');
    	if (count($photo) == 1)
    	{
    		$mimeType = $photo->getMimeType();
    		if ($mimeType == 'image/jpeg' || $mimeType == 'image/png')
    		{
    			$savedPhoto = Photo::create(['title' => $request->input('photoTitle'), 'location' => $request->input('photoLocation'), 'subject_id' => 1]);
    			$fileExtension = '.' . $photo->guessClientExtension();
    			$originalFile = $savedPhoto->id . $fileExtension;
    			$compressedFile = $savedPhoto->id . '_compressed' . $fileExtension;
    			$thumbnailFile = $savedPhoto->id . '_thumb' . $fileExtension;

    			// Duplicate photo
    			$photo->move(self::$fileUploadDirectory, $originalFile);
    			copy(self::$fileUploadDirectory . '/' . $originalFile, self::$fileUploadDirectory . '/' . $compressedFile);
    			copy(self::$fileUploadDirectory . '/' . $originalFile, self::$fileUploadDirectory . '/' . $thumbnailFile);

    			// Resize photos
    			exec('cd uploads/ && mogrify -resize x700 -quality 70 ' . $thumbnailFile);
    			exec('cd uploads/ && mogrify -quality 70 ' . $compressedFile);

/*    			$savedPhoto->file_name_original = $originalFile;
    			$savedPhoto->file_name_compressed = $compressedFile;
    			$savedPhoto->file_name_thumbnail = $thumbnailFile;
    			$savedPhoto->save();
  */  		}
    	}

    	return redirect()->route('index');
    }
}
