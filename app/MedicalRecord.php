<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MedicalRecord extends Model
{
    protected $table = 'medicalrecord';
    protected $guarded= ['id'];
    protected $dates = ['rabies_vaccine_date', 'next_rabies_vaccine_date', 'deworming_date', 'next_deworming_date'];
    
    public $timestamps = false;
    

    public function dog()
    {
        return $this->belongsTo('App\Dog', 'dog_id');
    }

}
