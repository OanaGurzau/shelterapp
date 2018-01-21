<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopted extends Model
{
    protected $table = 'adopted';
    protected $guarded= ['id'];
    public $timestamps=false;
    protected $fillable = array('dog_id','adopter_id','date_adopted');

    public function dog()
    {
        return $this->belongsTo('App\Dog', 'dog_id');
    }

    public function adopter()
    {
        return $this->hasMany('App\Adopter', 'adopter_id'); //hasone
    }

}
