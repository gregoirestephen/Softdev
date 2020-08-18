<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use SoftDeletes;
    //champ modifiable
    protected $guarded=[];

    //liaison avec table reglements
    public function reglements(){
        return $this->hasMany('App\Reglement');
    }

    //liaison avec la table patient
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

}
