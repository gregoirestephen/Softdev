<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordonnance extends Model
{
    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //relation avec la table patient
    public function consultation(){
        return $this->belongsTo('App\Consultation');
    }

    //relations avec la table lignemedicament
    public function lignemedicaments(){
        return $this->hasMany('App\LigneMedicament');
    }



}
