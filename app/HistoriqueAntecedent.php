<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriqueAntecedent extends Model
{
    //utilisation du softdelete
    use SoftDeletes;
    //definition des champs modifiable
    protected $guarded=[];
}
