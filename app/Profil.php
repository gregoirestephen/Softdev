<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profil extends Model
{
    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //relation avec le modele user
    public function users(){
        return $this->hasMany('App\User');
    }

}
