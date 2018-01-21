<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';
    protected $guarded= ['id'];   
    public $timestamps = false;    
    public function dog() {
        return $this->HasMany('App\Dog', 'dog_id');
    }
}
