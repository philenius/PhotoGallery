<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

use App\PhotoSubject;

class MainController extends Controller
{
	private static $fileUploadDirectory = '';
	private static $photosPerPage = 8;

	public function __construct()
	{
		self::$fileUploadDirectory = public_path() . '/uploads';
	}

    public function getIndex($page = NULL)
    {
    	if (empty($page))
    	{
    		return redirect('/1');
    	}

    	// pagination
    	$totalImageCount = Photo::all()->count();
    	$totalPageCount = $totalImageCount / self::$photosPerPage;
    	if (($totalImageCount % self::$photosPerPage) > 0) {
    		$totalPageCount++;
    	}

    	$nextPage = false;
    	if ($page < floor($totalPageCount))
    	{
    		$nextPage = true;
    	}

		$intervalStart = ($page-1) * self::$photosPerPage;
    	$photos = Photo::offset($intervalStart)->limit(self::$photosPerPage)->get();
    	$allPhotoSubjects = PhotoSubject::all();

    	return view('index')->with('photos', $photos)->with('photoSubjects', $allPhotoSubjects)->with('page', $page)->with('nextPage', $nextPage);
    }

    public function uploadPhoto(Request $request)
    {
		$this->validate($request, [
	        'photoTitle' => 'required',
	        'photoLocation' => 'required',
	        'photo' => 'required|image',
	        'photoSubject' => 'required|integer'
	    ]);

		if ($request->hasFile('photo')) {
	    	
	    	$photo = Input::file('photo');
	    	
	    	if ($photo->isValid())
	    	{
	
				$mimeType = $photo->getMimeType();
				if ($mimeType == 'image/jpeg' || $mimeType == 'image/png')
				{
					$photoSubject = PhotoSubject::find($request->input('photoSubject'));

					$savedPhoto = Photo::create(['title' => $request->input('photoTitle'), 'location' => $request->input('photoLocation')]);
					$fileExtension = '.' . $photo->guessClientExtension();
					$originalFile = $savedPhoto->id . $fileExtension;
					$compressedFile = $savedPhoto->id . '_compressed' . $fileExtension;
					$thumbnailFile = $savedPhoto->id . '_thumb' . $fileExtension;

					// Duplicate photo
					$path = $photo->move(self::$fileUploadDirectory, $originalFile);
					copy($path, self::$fileUploadDirectory . '/' . $compressedFile);
					copy($path, self::$fileUploadDirectory . '/' . $thumbnailFile);

					// Resize photos
					exec('cd uploads/ && mogrify -resize x700 -quality 70 ' . $thumbnailFile);
					exec('cd uploads/ && mogrify -quality 70 ' . $compressedFile);

					$savedPhoto->file_name_original = $originalFile;
					$savedPhoto->file_name_compressed = $compressedFile;
					$savedPhoto->file_name_thumbnail = $thumbnailFile;
					$savedPhoto->save();

					$photoSubject->photos()->save($savedPhoto);
		   		}
			}

	   	}
    	return redirect()->route('index');
    }
}
