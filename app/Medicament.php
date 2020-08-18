<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicament extends Model
{
    //
    use SoftDeletes;

    //champ modifiable
    protected $guarded=[];

    //relation avec la table ordonnance
    public function lignemedicaments(){
        return $this->hasMany('App\LigneMedicament');
    }


}
