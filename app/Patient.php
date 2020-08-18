<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    //champs de la table a remplir
    protected $guarded=[];

    //relation avec la table ligneAntecedent
    public function ligneantecedents(){
        return $this->hasMany('App\LigneAntecedent');
    }


    //relation avec le modele assurance
    public function assurance(){
        return $this->belongsTo('App\Assurance');
    }

    //relation avec la table consultation
    public function consultations()
    {
        return $this->hasMany('App\Consultation');
    }

    //relation avec la table rdvs
    public function rdvs()
    {
        return $this->hasMany('App\Rdv');
    }

    //relation avec la table facture
    public function factures(){
        return $this->hasMany('App\Facture');
    }

    //relation avec la table ligneActe
    public function ligneactes(){
        return $this->hasMany('App\LigneActe');
    }


    //relation avec la table Ligne Medication
    public function lignemedications(){
        return $this->hasMany('App\LigneMedication');
    }

    public function profession(){
        return $this->belongsTo('App\Profession');

    }




}
