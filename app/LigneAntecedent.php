<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneAntecedent extends Model
{
    //
    use SoftDeletes;

    protected $guarded=[];

    //relation ligne antecedent et antecedent
    public function antecedent(){
        return $this->belongsTo('App\Antecedent');
    }

    //relation ligne antecedent et patient
    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
