<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    public $timestamps = false;
    protected $fillable = array('name', 'breed', 'color','sex','microchip', 'birthdate', 'notes', 'description');

    public function background() {
        return $this->hasMany('App\Background');
    }
        
    public function medicalRecord() {
        return $this->hasOne('App\MedicalRecord');
    }
    
    public function adopted() {
        return $this->hasMany('App\Adopted');
    }

    public function dogAlbum() {
        return $this->hasOne('App\DogAlbum');
    }

    public function message(){
        return $this->hasMany('App\Message');
    }
    
}
