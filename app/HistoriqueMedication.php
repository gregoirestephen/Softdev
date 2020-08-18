<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoriqueMedication extends Model
{
    //utilisation du softdelete
    use SoftDeletes;
    //definition des champs protegees
    protected $guarded=[];
}
