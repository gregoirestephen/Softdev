<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dent extends Model
{
    //
    use SoftDeletes;

    //champs remplissable
    protected $guarded=[];

    //liaison avec la table traitement
    public function traitements(){
        return $this->hasMany('App\Traitement');
    }



}
