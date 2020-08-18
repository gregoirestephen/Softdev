<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    //
    use SoftDeletes;

    //ligne modifiable
    protected $guarded=[];

    //relation avec la table Ligne Medication
    public function lignemedications(){
        return $this->hasMany('App\LigneMedication');
    }
}
