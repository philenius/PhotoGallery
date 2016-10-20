<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Imagick;

class Photo extends Model
{
    /**
     * All attributes which are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'location', 'author', 'uploader'];

    /**
     * The photo compression quality.
     *
     * @var int
     */
    private static $compressionQuality = 70;

    public function subject()
    {
        return $this->belongsTo('App\PhotoSubject');
    }

    /**
     *  Creates a thumbnail of this photo and saves it within the uploads folder.
     */
    public function createThumbnail()
    {
        $image = new Imagick($this->getAbsoluteFilePath());
        $image->setImageCompressionQuality(self::$compressionQuality);
        if ($this->isInPortraitFormat())
        {
            $image->thumbnailImage(555, 0);
        }
        else
        {
            $image->thumbnailImage(0, 500);
        }
        $image->writeImage(public_path() . '/uploads/' . $this->id . '_thumb.jpeg');
    }

    /**
     * Creates a compressed + downscaled version of this photo and saves it within the uploads folder.
     */
    public function createCompressedVersion()
    {
        $image = new Imagick($this->getAbsoluteFilePath());
        $image->setImageCompressionQuality(self::$compressionQuality);
        if ($this->isInPortraitFormat())
        {
            $image->resizeImage(0, 1080, Imagick::FILTER_POINT, 1);
        }
        else
        {
            $image->resizeImage(1920, 0, Imagick::FILTER_POINT, 1);
        }
        $image->writeImage(public_path() . '/uploads/' . $this->id . '_compressed.jpeg');
    }

    /**
     * @return string Returns the absolute file path of this photo.
     */
    private function getAbsoluteFilePath()
    {
        if (!isset($this->file_name_original))
        {
            throw new Exception('Cannot access the field `file_name_original`. Without the file name no operations can be executed on the photo.');
        }
        return public_path() . '/uploads/' . $this->file_name_original;
    }

    /**
     * Detects whether this photo was taken in landscape or portrait format. 
     *
     * @return bool Returns true, if the image is in portrait. Returns otherwise false.
     */
    private function isInPortraitFormat()
    {
        $image = new Imagick($this->getAbsoluteFilePath());
        $width = $image->getImageWidth();
        $height = $image->getImageHeight();
        if ($height >= $width)
        {
            return true;
        }
        return false;
    }
}
