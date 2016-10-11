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
    	$totalPageCount = floor($totalImageCount / self::$photosPerPage);
    	if (($totalImageCount % self::$photosPerPage) > 0) {
    		$totalPageCount++;
    	}

    	// Redirect if not existing page is being requested
    	if (($page != 1) && ($page > $totalPageCount))
    	{
    		return redirect('/1');
    	}

    	// Determines whether there exists a 'next' page
    	$nextPage = false;
    	if ($page < $totalPageCount)
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
	        'file' => 'required|image',
	        'photoSubject' => 'required|integer'
	    ]);

		if ($request->hasFile('file')) {
	    	
	    	$photo = Input::file('file');
	    	
	    	if ($photo->isValid())
	    	{
	
				$mimeType = $photo->getMimeType();
				if ($mimeType == 'image/jpeg')
				{
					$photoSubject = PhotoSubject::find($request->input('photoSubject'));

					$savedPhoto = Photo::create([
						'title' => $request->input('photoTitle'),
						'location' => $request->input('photoLocation'),
						'uploader' => $request->ip()
						]);
					$fileExtension = '.' . $photo->guessClientExtension();
					$originalFile = $savedPhoto->id . $fileExtension;
					$compressedFile = $savedPhoto->id . '_compressed' . $fileExtension;
					$thumbnailFile = $savedPhoto->id . '_thumb' . $fileExtension;

					// Save photo in different qualities & sizes
					try
					{
						$path = $photo->move(self::$fileUploadDirectory, $originalFile);					
						$successCopy1 = copy($path, self::$fileUploadDirectory . '/' . $compressedFile);
						if (!$successCopy1)
						{
							throw new Exception();
						}
						$successCopy2 = copy($path, self::$fileUploadDirectory . '/' . $thumbnailFile);
						if (!$successCopy2)
						{
							throw new Exception();
						}
						exec('cd uploads/ && mogrify -resize x500 -quality 70 ' . $thumbnailFile);
						exec('cd uploads/ && mogrify -quality 70 ' . $compressedFile);
						exec('cd uploads/ && zip -r allPhotos.zip ' . $originalFile);
					}
					catch (Exception $e)
					{
						$savedPhoto->delete();
						$request->session()->flash('error', 'There was an internal server error. Sorry for the inconvenience.');
						return redirect('/1');
					}

					$savedPhoto->file_name_original = $originalFile;
					$savedPhoto->file_name_compressed = $compressedFile;
					$savedPhoto->file_name_thumbnail = $thumbnailFile;
					$savedPhoto->save();

					$photoSubject->photos()->save($savedPhoto);
		   		}
		   		else
		   		{
		   			$request->session()->flash('error', 'Sorry, only .jpg / .jpeg files are allowed.');
					return redirect('/1');
		   		}
			}

	   	}

	   	$totalImageCount = Photo::all()->count();
    	$totalPageCount = floor($totalImageCount / self::$photosPerPage);
    	if (($totalImageCount % self::$photosPerPage) > 0) {
    		$totalPageCount++;
    	}
    	return redirect('/' . $totalPageCount);
    }
}
