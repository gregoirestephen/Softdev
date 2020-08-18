<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //relation avec la table patient
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //relation avec la table ordonnance
    public function ordonnances(){
        return $this->hasMany('App\Ordonnance');
    }

}
