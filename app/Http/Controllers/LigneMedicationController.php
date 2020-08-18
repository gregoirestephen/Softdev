<?php

namespace App\Http\Controllers;

use App\HistoriqueMedication;
use App\LigneMedication;
use App\Medication;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Gate;

class LigneMedicationController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $medication=Medication::all();
        $patient=Patient::all();
        return view('Ligne Medication.index',compact('patient','medication'));
    }

    //fonction retournant la liste des medications
    public function show(){
        $lm=DB::table('ligne_medications')->join('patients','patients.id','=','ligne_medications.patient_id')
            ->join('medications','medications.id','=','ligne_medications.medication_id')
            ->select('medications.lib_med','patients.nom_patient','patients.prenom_patient','ligne_medications.id')
            ->where('ligne_medications.deleted_at','=',null);
        $listeMedications=$lm->get();

        return response()->json($listeMedications);
    }

    //fonction retournant une medication
    public function getLigne(LigneMedication $medication){
        return response()->json($medication);
    }

    //fonction d'enregistrement
    public function store(){

        $day = Carbon::now()->format('Y-m-d');
        $i=\request('patient_id');

        HistoriqueMedication::create([
            'patient_id'=>$i,
            'libelle'=>\request('medication_id'),
            'date_M'=>$day
        ]);

        DB::table('ligne_medications')
            ->where('patient_id', $i)
            ->delete();

        $data=\request()->validate([
            'patient_id'=>['required','integer']
        ]);

            $medication=new LigneMedication();
            $medication->patient_id=\request('patient_id');
            $medication->medication_id=\request('medication_id');
            $medication->save();

    }

    //fonction de modification
    public function update(LigneMedication $medication){
        $data=\request()->validate([
            'medication_id'=>['required','integer'],
            'patient_id'=>['required','integer']
        ]);

        $medication->update($data);
    }

    //fonction de suppression
    public function destroy(LigneMedication $medication){
        $medication->delete();
    }

}
