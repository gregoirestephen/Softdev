<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoriquePatient extends Controller
{
    //function de recherche d'historique
    public function getSearch(){
        $patient=Patient::orderBy('nom_patient','asc')->get();
        return view('Historique.patient',compact('patient'));
    }

    //fonction renvoyant un resultat suite a une recherche
    public function search(Request $request){

        $patient=Patient::orderBy('nom_patient','asc')->get();

        $pat=DB::table('historique_medications')
            ->join('patients','patients.id','=','historique_medications.patient_id')
            ->join('historique_antecedents','historique_antecedents.date_A','=','historique_medications.date_M')
            ->join('medications','medications.id','=','historique_medications.libelle')
            ->join('antecedents','antecedents.id','=','historique_antecedents.libelle')
            ->select('patients.nom_patient','patients.prenom_patient','medications.lib_med','antecedents.lib_ant','historique_medications.date_M')
            ->where('patients.id','=',$request->patient_id)
            ->orderBy('historique_medications.date_M','desc')
            ->get();

        return view('Historique.patient',compact('pat','patient'));


    }
}
