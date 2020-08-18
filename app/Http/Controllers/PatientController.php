<?php

namespace App\Http\Controllers;

use App\Antecedent;
use App\Assurance;
use App\Consultation;
use App\LigneAntecedent;
use App\LigneMedication;
use App\Medication;
use App\Patient;
use App\Profession;
use App\Rdv;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    //fonction renvoyant vers une vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        $assurance=Assurance::all();
        $profession=Profession::all();

        return view('Patient.index',compact('assurance','profession'));
    }

    //fonction renvoyant la fiche patient
   public function fiche(){
       if (!Gate::allows('isMedecin')) {
           abort(404, 'you can do this actions');
       }
       $pt=Patient::all();

       return view('Patient.fiche',compact('pt'));
   }

   //fonction renvoyant le resultat d'une recherche
    public function search(Request $request){
        $patient=Patient::where('nom_patient',$request->nom_patient)->where('prenom_patient',$request->prenom_patient)->firstOrfail();
        $pAnt=LigneAntecedent::all()->where('patient_id',$patient->id);
        $pMed=LigneMedication::all()->where('patient_id',$patient->id);
        $antecedent=Antecedent::all();
        $medication=Medication::all();

        if (isset($pAnt) &&isset($pMed)){

            return view('Patient.fiche',compact('patient','antecedent','medication','pAnt','pMed'));
        }
        else{
            return view('Patient.fiche',compact('patient','antecedent','medication'));
        }

    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
            'assurance_id'=>['required','integer'],
            'nom_patient'=>['required','string'],
            'prenom_patient'=>['required','string'],
            'profession_id'=>['required','integer'],
            'adresse_patient'=>['required','string'],
            'date_naiss'=>['required','date'],
            'contact_patient'=>['required','integer'],
            'email_patient'=>['required','email'],
            'genre'=>['required','string'],
            'image'=>['sometimes'],
        ]);

        $patient=new Patient();
        $patient->assurance_id=\request('assurance_id');
        $patient->nom_patient=\request('nom_patient');
        $patient->prenom_patient=\request('prenom_patient');
        $patient->profession_id=\request('profession_id');
        $patient->adresse_patient=\request('adresse_patient');
        $patient->date_naiss=\request('date_naiss');
        $patient->contact_patient=\request('contact_patient');
        $patient->email_patient=\request('email_patient');
        $patient->genre=\request('genre');
        $patient->num_dossier='TER_';
        $patient->save();
    }

    //fonction renvoyant la liste patient
    public function show(){
        $patient=Patient::all();
        return response()->json($patient);
    }

    //fonction renvoyant une profession
    public function getProfession(Profession $profession){
        return response()->json($profession);
    }

    //fonction renvoyant une assurance
    public function getAssurance(Assurance $assurance){
        return response()->json($assurance);
    }

    //fonction renvoyant un Patient
    public function getPatient(Patient $patient){
        return response()->json($patient);
    }

    //fonction renvoyant les donness patient
    public function infoPatient( $patient){

        $p=DB::table('patients')
            ->where('deleted_at','=',null)
            ->where('nom_patient', 'like', '%'.$patient.'%')
            ->get();
        return response()->json($p);
    }

    //fonction de modification
    public function update(Patient $patient){
        \request()->validate([
            'assurance_id'=>['required','integer'],
            'nom_patient'=>['required','string'],
            'prenom_patient'=>['required','string'],
            'profession_id'=>['required','integer'],
            'adresse_patient'=>['required','string'],
            'date_naiss'=>['required','date'],
            'contact_patient'=>['required','integer'],
            'email_patient'=>['required','email'],
            'genre'=>['required','string'],
            'num_dossier'=>['required','string'],
            'image'=>['sometimes'],
        ]);

        $patient->assurance_id=\request('assurance_id');
        $patient->nom_patient=\request('nom_patient');
        $patient->prenom_patient=\request('prenom_patient');
        $patient->profession_id=\request('profession_id');
        $patient->adresse_patient=\request('adresse_patient');
        $patient->date_naiss=\request('date_naiss');
        $patient->contact_patient=\request('contact_patient');
        $patient->email_patient=\request('email_patient');
        $patient->genre=\request('genre');
        $patient->num_dossier=\request('num_dossier');
        $patient->update();
    }

    //fonction de verification
    public function verification($id){
        $rdv=count(Rdv::all()->where('patient_id',$id));
        $consultation=count(Consultation::all()->where('patient_id',$id));
        $lant=count(LigneAntecedent::all()->where('patient_id',$id));
        $lmed=count(LigneMedication::all()->where('patient_id',$id));

        if ($rdv>0 || $consultation>0 || $lant>0 || $lmed>0){
            return response()->json('Non');
        }
        else{
            return response()->json('Oui');
        }
    }

    //fonction de destruction
    public function destroy(Patient $patient){
        $patient->delete();
    }
}
