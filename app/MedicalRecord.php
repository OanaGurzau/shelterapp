<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $table = 'medicalrecord';
    protected $guarded= ['id'];


    public function dog()
    {
        return $this->belongsTo('App\Dog');
    }

}
