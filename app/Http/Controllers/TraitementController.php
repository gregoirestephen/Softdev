<?php

namespace App\Http\Controllers;

use App\Dent;
use App\LigneActe;
use App\Patient;
use App\Reglement;
use App\Traitement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TraitementController extends Controller
{
    //fonction retournant vers la vue
    public function index(){
        $ligneacte=LigneActe::all();
        $dent=Dent::all();
        $patient=Patient::orderBy('nom_patient','asc')->get();

        return view('Traitement.index',compact('ligneacte','dent','patient'));
    }

    //fonction renvoyant la liste des actes d'un patient
    public function getTacte($patient){

        $lActes=DB::table('ligne_actes')->join('patients','patients.id','=','ligne_actes.patient_id')
            ->join('actes','actes.id','=','ligne_actes.acte_id')
            ->select('actes.lib_actes','ligne_actes.id')
            ->where('ligne_actes.patient_id','=',$patient)
            ->where('ligne_actes.etat_ligne','=',1)
            ->where('ligne_actes.deleted_at','=',null)
            ->get();

        return response()->json($lActes);
    }

    //fonction retournant la liste des traitements
    public function show($patient){
        $traitement=DB::table('traitements')->join('dents','dents.id','=','traitements.dent_id')
            ->join('ligne_actes','ligne_actes.id','=','traitements.ligneacte_id')
            ->join('patients','patients.id','=','ligne_actes.patient_id')
            ->join('actes','actes.id','=','ligne_actes.acte_id')
            ->select('patients.nom_patient','patients.prenom_patient','traitements.observation_trait','actes.lib_actes','traitements.id','dents.designation_dent','traitements.date_trait')
            ->where('ligne_actes.patient_id','=',$patient)
            ->where('traitements.deleted_at','=',null)
            ->get();
        return response()->json($traitement);
    }

    //fonction retournant la liste des Actes effectues
    public function getActe($patient){
        $actes=DB::table('ligne_actes')->join('patients','patients.id','=','ligne_actes.patient_id')
            ->join('actes','actes.id','=','ligne_actes.acte_id')
            ->select('actes.lib_actes','ligne_actes.id')
            ->where('ligne_actes.patient_id','=',$patient)
            ->where('ligne_actes.etat_ligne','=',2)
            ->where('ligne_actes.deleted_at','=',null)
            ->get();
        return response()->json($actes);
    }

    //fonction de modification de l'etat traitement
    public function modifLigne(LigneActe $acte,$etat){
        $acte->update(['etat_ligne'=>$etat]);
        return response()->json($acte);
    }

    //fonction retournant un traitement
    public function getTraitement(Traitement $traitement){
        return response()->json($traitement);
    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
            'dent_id'=>['required','integer'],
            'ligneacte_id'=>['required','integer'],
            'observation_trait'=>['required','string'],
        ]);
        $day = Carbon::now()->format('Y-m-d');
        $data['date_trait']=$day;
        Traitement::create($data);
    }

    //fonction de modification
    public function update(Traitement $traitement){
        $data=\request()->validate([
            'dent_id'=>['required','integer'],
            'ligneacte_id'=>['required','integer'],
            'observation_trait'=>['required','string'],
            'date_trait'=>['required','date'],
        ]);
        $traitement->update($data);
    }

    //fonction de suppression
    public function destroy(Traitement $traitement){
        $traitement->delete();
    }
}
