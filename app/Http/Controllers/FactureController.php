<?php

namespace App\Http\Controllers;

use App\Acte;
use App\Facture;
use App\LigneActe;
use App\Patient;
use App\Reglement;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
    //fonction renvoyant une vue
    public function  index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        $acte=Acte::all();
        $patient=Patient::all();

        return view('Facture.index',compact('patient','acte'));
    }

    //fonction renvoyant la fiche de consultation
    public function consultMe(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Facture.fiche');
    }

    //fonction d'annulation de facture
    public function annuler(Facture $facture){
        $reglement=Reglement::all()->where('facture_id',$facture->id)->count();

        if ($reglement>0){
            return response()->json('Non');
        }
        else{
            $facture->update([
                'etat_facture'=>3
            ]);
            return response()->json('ok');
        }
    }

    //fonction renvoyant le resultat d'une facture
    public function resultat(Request $request){
        $facture=DB::table('factures')->join('patients','patients.id','=','factures.patient_id')
            ->select('factures.id','factures.montant_fact','factures.montant_net','factures.remise','factures.montant_rest','factures.etat_facture','patients.nom_patient','patients.prenom_patient')
            ->whereBetween('factures.date_fact',[$request->date1,$request->date2])->where('factures.deleted_at','=',null)->get();
        return view('Facture.fiche',compact('facture'));

    }

    //fonction renvoyant la liste des actes
    public function getLigne( $facture){
        $pActe=LigneActe::all()->where('patient_id',$facture);
        return response()->json($pActe);
    }

    //fonction renvoyant un acte donnee
    public function getActe(Acte $acte){
        return response()->json($acte);
    }

    //fonction renvoyant un patient
    public function getPatient(Patient $patient){
        return response()->json($patient);
    }

    //fonction renvoyant une facture
    public function getFacture(Facture $facture){
        return response()->json($facture);
    }

    //fonction renvoyant la liste des factures
    public function show(){
        $day = Carbon::now()->format('Y-m-d');
        $facture=DB::table('factures')->join('patients','patients.id','=','factures.patient_id')
            ->select('factures.id','factures.montant_fact','factures.montant_net','factures.remise','factures.montant_rest','patients.nom_patient','patients.prenom_patient')
            ->whereDate('factures.date_fact','=',$day)
            ->where('factures.deleted_at','=',null)
            ->get();
        return response()->json($facture);
    }

    //fonction d'enregistrement
    public function store(){

        \request()->validate([
            'patient_id'=>['required','integer'],
            'montant_fact'=>['required','integer'],
            'montant_net'=>['required','integer'],
            'remise'=>['required','integer'],
        ]);

        $day = Carbon::now()->format('Y-m-d');
        $facture=new Facture();
        $facture->patient_id=\request('patient_id');
        $facture->montant_fact=\request('montant_fact');
        $facture->montant_net=\request('montant_net');
        $facture->remise=\request('remise');
        $facture->montant_rest=\request('montant_rest');
        $facture->date_fact=$day;
        $facture->etat_facture=2;
        $facture->save();
        return response()->json($facture->id);
    }

    //fonction de modification
    public function update(Facture $facture){

    }

    //fonction de verification
    public function verification($id){
        $reglement=count(Reglement::all()->where('facture_id',$id));
        return response()->json($reglement);
    }
    //fonction de suppression
    public function destroy(Facture $facture){
        $facture->delete();
    }

}
