<?php
namespace App\Services;
use Intervention\Image\Facades\Image;

class ImageService {
    public $path;
    public $name;
    public $image;
    public $location;
    public $width;
    public $height;
    public $resize;

    public function __construct( $image = null, $path = null, $name = null, $location = null, $width = null, $height = null, $resize = false ) {
        $this->image = $image;
        $this->path = $path;
        $this->name = $this->uniqueName($image);
        $this->location = $location;
        $this->width = $width;
        $this->height = $height;
        $this->resize = false;
    }

    
    public function upload() {
        $this->location = $this->path . $this->name;
        // check if directory exists

        if ( !file_exists( $this->path ) ) {
            mkdir( $this->path, 0777, true );
        }
        if ( $this->resize == false ) {
            Image::make( $this->image )->save($this->location);
            return $this->location;
        } else {
            Image::make( $this->image )->resize( $this->width,  $this->height )->save($this->location);
            return $this->location;
        }
    }

    public static function delete($path)
    {
        if ( file_exists( $path ) ) {
            unlink(  $path );
        }
    }

    public static function update($image, $savePath ,$deletePath)
    {
        if ($deletePath)
            ImageService::delete($deletePath);

        $image = new ImageService( $image, $savePath);
        return  $image->upload();
    }

    public function getPath() {
        return $this->path;
    }

    public function getName() {
        return $this->name;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getImage() {
        return $this->image;
    }

    public function uniqueName($image) {
        $extension = $image->getClientOriginalExtension();
        return $uniqueName = time() . '_' . uniqid() . '.' . $extension;
    }
   
}
