<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    //
    use SoftDeletes;

    protected $guarded=[];
    public function patients(){
        return $this->hasMany('App\Patient');
    }
}
