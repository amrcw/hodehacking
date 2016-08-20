<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $upload_dir = 'http://localhost/codehacking/public/images/';
    protected  $fillable =['file'];

    public function getFileAttribute($photo)
    {
        return $this->upload_dir.$photo;
    }
}
