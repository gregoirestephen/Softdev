<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneActe extends Model
{
    //
    use SoftDeletes;

    //champs modifiable
    protected $guarded=[];

    //relation avec la table actes
    public function acte(){
        return $this->belongsTo('App\Acte');
    }

    //relation avec la table patient
    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //relation avec la table traitement
    public function traitements(){
        return $this->hasMany('App\Traitement');
    }
}
