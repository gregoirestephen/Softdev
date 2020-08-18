<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traitement extends Model
{
    use SoftDeletes;

    //definition des champs modifiables
    protected $guarded=[];

    //relation avec la table ligneActe
    public function ligneacte(){
        return $this->belongsTo('App\LigneActe');
    }

    //relation avec la table dent
    public function dent(){
        return $this->belongsTo('App\Dent');
    }

//    //relation avec la table facture
//    public function reglement(){
//        return $this->belongsTo('App\Reglement');
//    }

}
