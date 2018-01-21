<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopter extends Model
{
    protected $table = 'adopters';
    protected $guarded= ['id'];
    protected $dates = ['last_home_visit'];
    public $timestamps=false;

    public function adopted() {
        return $this->hasMany('App\Adopted', 'id');
    }

    

}
