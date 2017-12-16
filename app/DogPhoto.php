<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogPhoto extends Model
{
    public $timestamps=false;
    protected $fillable=array('dog_album_id', 'dog_id', 'description', 'photo', 'title'); 

    public function album(){
        return $this->belongsTo('App\DogAlbum');
    }
}
