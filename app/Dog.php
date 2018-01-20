<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $table = 'dogs';
    protected $guarded= ['id'];
    public $timestamps = false;
    protected $fillable = array('name', 'breed', 'color','sex','microchip', 'birthdate', 'notes', 'description');
    protected $dates=['birthdate'];
    

    public function background() {
        return $this->hasOne('App\Background');
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
    
    
}
