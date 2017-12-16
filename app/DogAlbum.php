<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DogAlbum extends Model
{
    public $timestamps = false;
    protected $fillable = array('dog_id','name','cover_image');

    public function photos(){
        return $this->hasMany('App\DogPhoto');
    }


    public function dog() {
        return $this->belongsTo('App\Dog', 'dog_id');
    }
}
