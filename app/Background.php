<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    protected $table = 'background';
    protected $guarded= ['id'];
    public $timestamps = false;
    protected $fillable = array('join_shelter_date');
    protected $dates = ['join_shelter_date'];

    public function dog()
    {
        return $this->belongsTo('App\Dog');
    }
}
