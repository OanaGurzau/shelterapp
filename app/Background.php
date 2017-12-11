<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $table = 'background';
    protected $guarded= ['id'];


    public function dog()
    {
        return $this->belongsTo('App\Dog');
    }
}
