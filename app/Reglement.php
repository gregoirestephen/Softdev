<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reglement extends Model
{
    //
    use SoftDeletes;

    //champs modifiable
    protected $guarded=[];

    //relation avec la table Facture
    public function Facture(){
        return $this->belongsTo('App\Facture');
    }

//    //liaison avec la table traitement
//    public function traitements(){
//        return $this->hasMany('App\Traitement');
//    }


}
