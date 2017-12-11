<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $table = 'dogs';
    protected $guarded= ['id'];

    public function background() {
        return $this->hasOne('App\Background');
    }
        
    public function medicalRecord() {
        return $this->hasMany('App\MedicalRecord');
    }
    
    public function adopted() {
        return $this->hasMany('App\Adopted');
    }
    
    
}
