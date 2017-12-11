<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogAlbum extends Model
{
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'cover_image');

    public function photos(){
        return $this->hasMany('App\DogPhoto');
    }
}
