<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    protected $table = 'adopters';
    protected $guarded= ['id'];

    public function adopted() {
        return $this->hasMany('AppAdopted');
    }

    

}
