<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Antecedent extends Model
{
    use SoftDeletes;

    //champs de la table a remplir
    protected $guarded=[];

    //relation avec la table ligneAntecedent
    public function ligneantecedents(){
        return $this->hasMany('App\LigneAntecedent');
    }

}
