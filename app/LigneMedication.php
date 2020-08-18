<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneMedication extends Model
{
    //
    use SoftDeletes;

    //champs remplissable
    protected $guarded=[];

    //relation avec la table patient
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //relation avec la table medication
    public function medication(){
        return $this->belongsTo('App\Medication');
    }
}
