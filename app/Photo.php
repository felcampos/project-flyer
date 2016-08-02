<?php

namespace App;

use Illuminate\Database\Eloquent\Model; //Facade
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'savedflyers/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function named($name)
    {
        $photo = new static;

        return $photo->saveAs($name);

    }

    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;

    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        //Utiliza a biblioteca externa para criar um Thumbnail
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);

        return $this;
    }
}
