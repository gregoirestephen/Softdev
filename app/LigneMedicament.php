<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneMedicament extends Model
{
    //
    use SoftDeletes;
    //champs modifiable
    protected $guarded=[];

    //relation vers la table medicament
    public function medicament(){
        return $this->belongsTo('App\Medicament');
    }

    //relation avec la table ordonnance
    public function ordonnance(){
        return $this->belongsTo('App\Ordonnance');
    }
}
