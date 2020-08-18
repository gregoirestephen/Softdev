<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acte extends Model
{
    use SoftDeletes;

    //champs de la table a remplir
    protected $guarded=[];


    //relation avec la table ligneActe
    public function ligneactes(){
        return $this->hasMany('App\LigneActe');
    }

}
