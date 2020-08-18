<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rdv extends Model
{
    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
