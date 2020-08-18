<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assurance extends Model
{

    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //relation avec le modele patient
    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}
