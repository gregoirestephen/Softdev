<?php

namespace App\Http\Controllers;

use App\Acte;
use App\LigneActe;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Gate;

class LigneActeController extends Controller
{
    //fonction retournant vers une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::all();
        $acte=Acte::all();
        return view('LigneActe.index',compact('patient','acte'));
    }

    //fonction retournant la liste des lignes actes
    public function getActe(LigneActe $acte){
        return response()->json($acte);
    }

    //fonction retournant une ligne acte
    public function show(){
        $lm=DB::table('ligne_actes')->join('patients','patients.id','=','ligne_actes.patient_id')
            ->join('actes','actes.id','=','ligne_actes.acte_id')
            ->select('actes.prix_actes','actes.lib_actes','actes.coef_actes','patients.nom_patient','patients.prenom_patient','ligne_actes.id','ligne_actes.date_execut')
            ->where('ligne_actes.deleted_at','=',null);
        $listeActe=$lm->get();

        return response()->json($listeActe);
    }

    //fonction d'enregistrement
    public function store(){
        $day = Carbon::now()->format('Y-m-d');
       \request()->validate([
           'acte_id'=>['required','integer'],
           'patient_id'=>['required','integer'],
        ]);
        $lActe=new LigneActe();
        $lActe->acte_id=\request('acte_id');
        $lActe->patient_id=\request('patient_id');
        $lActe->date_execut=$day;
        $lActe->etat_ligne=1;
        $lActe->save();
    }

    //fonction de modification
    public function update(LigneActe $acte){
        $data=\request()->validate([
            'acte_id'=>['required','integer'],
            'patient_id'=>['required','integer'],
            'date_execut'=>['required','date'],
            'etat_ligne'=>['required','integer']
        ]);
        $acte->update($data);
    }

    //fonction de suppression
    public function destroy(LigneActe $acte){
        $acte->delete();
    }
}
