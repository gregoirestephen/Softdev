<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Rdv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class RdvController extends Controller
{
    //fonction renvoyant vers la vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::all();
        return view('Rdv.index',compact('patient'));
    }

    //fonction retournant la liste des rdv(Secretaire)
    public function listeRdv(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::all();
        return view('Rdv.liste',compact('patient'));
    }

    //fonction renvoyant la liste des rdv(Docteur)
    public function show(){
        $lm=DB::table('rdvs')->join('patients','patients.id','=','rdvs.patient_id')
            ->select('rdvs.objet_rdv','rdvs.date_rdv','rdvs.id','rdvs.heure_rdv','patients.nom_patient','patients.prenom_patient','rdvs.tache_rdv')
        ->where('rdvs.deleted_at','=',null);
        $rdv=$lm->get();
       return response()->json($rdv);
    }

    //fonction renvoyant un rdv
    public function getRdv(Rdv $rdv){
        return response()->json($rdv);
    }

    //fonction d'enregistrement de donnee
    public function store(){
        $data=\request()->validate([
            'patient_id'=>['required','integer'],
            'objet_rdv'=>['required','string'],
            'date_rdv'=>['required','date'],
            'heure_rdv'=>['required','integer'],
        ]);
        $data['tache_rdv']='Aucune';
        Rdv::create($data);
    }

    //fonction de modification d'un champ rdv
    public function todoRdv(Rdv $rdv,$tache){
//        dd(\request()->all);
        $rdv->update(['tache_rdv'=>$tache]);
    }

    //fonction de modification de donnees
    public function update(Rdv $rdv){
        $data=\request()->validate([
           'patient_id'=>['required','integer'],
           'objet_rdv'=>['required','string'],
           'date_rdv'=>['required','date'],
           'heure_rdv'=>['required','integer'],
        ]);
        $data['tache_rdv']='Aucune';
        $rdv->update($data);
    }

    //fonction de suppression de donnees
    public function destroy(Rdv $rdv){
        $rdv->delete();

    }
}
