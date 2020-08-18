<?php

namespace App\Http\Controllers;

use App\Consultation;
use App\Ordonnance;
use App\Patient;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    //fonction renvoyant une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::all();
        return view('Consultation.index',compact('patient'));
    }

    //fonction renvoyant vers une vue
    public function create(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::all();
        return view('Consultation.create',compact('patient'));

    }

    //fonction de rendu d'une recherche consultation
    public function getSearch(){
        return view('Consultation.search');
    }

    //fonction de recherche consultation
    public function search(Request $request){
        $consultation=DB::table('consultations')->join('patients','patients.id','=','consultations.patient_id')
            ->select('consultations.id','consultations.dateConsultation','consultations.observation','consultations.etape_consult','patients.nom_patient','patients.prenom_patient')
            ->where('consultations.deleted_at','=',null)
            ->whereBetween('consultations.dateConsultation',[$request->date1,$request->date2])->get();
        return view('Consultation.search',compact('consultation'));
    }

    //fonction renvoyant une consultation
    public function getConsultation(Consultation $consultation){
        return response()->json($consultation);
    }

    //fonction renvoyant la liste des consultations
    public function show(){
        $day = Carbon::now()->format('Y-m-d');
        $consultation=DB::table('consultations')->join('patients','patients.id','=','consultations.patient_id')
            ->select('consultations.id','consultations.dateConsultation','consultations.observation','consultations.etape_consult','patients.nom_patient','patients.prenom_patient')
            ->where('consultations.deleted_at','=',null)
            ->whereDate('consultations.dateConsultation','=',$day)->get();
        return response()->json($consultation);
    }

    //fonction d'annulation de consultation
    public function annuler(Consultation $consultation){
        $ordonnance=count(Ordonnance::all()->where('consultation_id',$consultation->id));

        if ($ordonnance>0){
            return response()->json('Non');
        }
        else{
            $consultation->update(['etape_consult'=>3]);
            return response()->json('Oui');
        }
    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
           'patient_id'=>['required','integer'],
        ]);
        $data['observation']='Aucune pour le moment';
        $data['etape_consult']=1;
        $day = Carbon::now()->format('Y-m-d');
        $data['dateConsultation']=$day;
        Consultation::create($data);
    }

    //fonction de modification
    public function update(Consultation $consultation){
        $data=\request()->validate([
            'patient_id'=>['required','integer'],
            'observation'=>['required','string'],
            'etape_consult'=>['required','integer'],
        ]);
        $consultation->update($data);
    }

    //fonction de verification
    public function verification($id){
        $ordonnance=count(Ordonnance::all()->where('consultation_id',$id));
        return response()->json($ordonnance);
    }

    //fonction de suppression
    public function destroy(Consultation $consultation){
        $consultation->delete();
    }
}
