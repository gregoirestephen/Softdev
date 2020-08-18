<?php

namespace App\Http\Controllers;

use App\Facture;
use App\Patient;
use App\Reglement;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\DB;

class ReglementController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        $patient=Patient::orderBy('nom_patient','asc')->get();
        $facture=Facture::all();
        return view('Reglement.index',compact('facture','patient'));
    }

    //fonction retournant la liste des reglements
    public function show(){
        $day = Carbon::now()->format('Y-m-d');
        $reglement=DB::table('reglements')
            ->join('factures','factures.id','=','reglements.facture_id')
            ->join('patients','patients.id','=','factures.patient_id')
            ->select('reglements.id','reglements.date_reg','reglements.montant_regle','reglements.etat','reglements.facture_id','patients.nom_patient','patients.prenom_patient')
            ->where('reglements.deleted_at','=',null)
            ->whereDate('reglements.date_reg','=',$day)
            ->get();
        return response()->json($reglement);
    }

    //fonction renvoyant les resultats d'un reglement precis
    public function factureMe(Facture $facture){
        return response()->json($facture);
    }

    //fonction retournant un reglement
    public function getReglement(Reglement $reglement){
        return response()->json($reglement);
    }

    //fonction de recherche de Rglements
    public function getSearch(){
        return view('Reglement.search');
    }

    //fonction retournant un resultat suite a une recherche
    public function search(Request $request){
        $reglement=DB::table('reglements')
            ->join('factures','factures.id','reglements.facture_id')
            ->select('reglements.*')
            ->whereBetween('reglements.date_reg',[$request->date1,$request->date2])
            ->where('reglements.deleted_at','=',null)
            ->get();

        return view('Reglement.search',compact('reglement'));

    }

    //fonction d'annulation d'un reglement
    public function annuler(Reglement $reglement,Facture $facture){
            $et=$reglement->etat;
            $mt=$facture->montant_fact;
            $reg=$reglement->montant_regle;
            if ($reg<$mt && $et==2){
                $somme=$facture->montant_rest+$reglement->montant_regle;
                $facture->update(['montant_rest'=>$somme]);
                $reglement->update(['etat'=>3]);
                return response()->json('ok');
            }
            else{
                $reglement->update(['etat'=>3]);
                return response()->json('ok');
            }

    }

    //fonction renvoyant les factures d'un patient
    public function factureShow($patient){
        $fact=DB::table('factures')
            ->join('patients','patients.id','=','factures.patient_id')
            ->select('factures.*')
            ->where('factures.patient_id','=',$patient)
            ->where('factures.montant_rest','<>',0)
            ->where('factures.etat_facture','=',2)
            ->where('factures.deleted_at','=',null)
            ->get();
        return response()->json($fact);
    }


    //fonction d'enregistrement
    public function store(){
        \request()->validate([
            'facture_id'=>['required','integer'],
            'montant_regle'=>['required','integer'],
        ]);
        $fact=\request('facture_id');
        $day = Carbon::now()->format('Y-m-d');
        $reglement=new Reglement();
        $reglement->facture_id=\request('facture_id');
        $reglement->montant_regle=\request('montant_regle');
        $reglement->date_reg=$day;
        $reglement->etat=2;
        $reglement->save();

        $prix=DB::table('reglements')->join('factures','factures.id','reglements.facture_id')
            ->where('reglements.facture_id',$fact)
            ->where('reglements.etat','=',2)
            ->where('reglements.deleted_at',null)
            ->sum('reglements.montant_regle');

        return response()->json($prix);
    }

    public function resteF(Facture $facture,$somme){
        $reste=$facture->montant_fact - $somme;
        DB::table('factures')
            ->where('factures.id',$facture->id)
            ->update(['montant_rest'=>$reste]);
    }

    //fonction de modification
    public function update(Reglement $reglement){
        $day = Carbon::now()->format('Y-m-d');
        $data=\request()->validate([
            'facture_id'=>['required','integer'],
            'montant_regle'=>['required','integer'],
            'etat'=>['required','integer'],
        ]);
        $data['date_reg']=$day;
        $reglement->update($data);
    }

    //fonction de suppression
    public function destroy(Reglement $reglement){
        $facture=Facture::all()->where('id',$reglement->facture_id)->count();
        if ($facture>0){
            return response()->json('Non');
        }
        else{
            $reglement->delete();
            return response()->json('Oui');
        }

    }
}
