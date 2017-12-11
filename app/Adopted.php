<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopted extends Model
{
    protected $table = 'adopted';
    protected $guarded= ['id'];


    public function dog()
    {
        return $this->belongsTo('App\Dog');
    }

    public function adopters()
    {
        return $this->belongsTo('App\Adopters');
    }


}
