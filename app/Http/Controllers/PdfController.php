<?php

namespace App\Http\Controllers;
use App\Facture;
use App\Reglement;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{

    public function index(Facture $facture){

        $fact=DB::table('factures')->join('patients','patients.id','=','factures.patient_id')
            ->select('factures.id','factures.montant_fact','factures.montant_net','factures.remise','factures.montant_rest','factures.etat_facture','patients.nom_patient','patients.prenom_patient','patients.contact_patient')
          ->where('factures.id','=',$facture->id)
            ->get();

       $lActe=DB::table('ligne_actes')->join('actes','actes.id','=','ligne_actes.acte_id')
           ->join('patients','patients.id','=','ligne_actes.patient_id')
           ->select('actes.lib_actes','actes.coef_actes','actes.prix_actes')
           ->where('ligne_actes.patient_id','=',$facture->patient_id)
           ->where('ligne_actes.date_execut','=',$facture->date_fact)->get();


        $html=View::make('impression.index',compact('fact','lActe'));;
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream("facture.pdf",array("Attachment" => 0));


//       return view('impression.index',compact('fact','lActe'));
    }

    public function regler(Reglement $reglement){
        $fact=DB::table('factures')->join('patients','patients.id','=','factures.patient_id')
            ->select('factures.id','factures.montant_fact','factures.montant_net','factures.remise','factures.montant_rest','factures.etat_facture','patients.nom_patient','patients.prenom_patient','patients.contact_patient')
            ->where('factures.id','=',$reglement->facture_id)
            ->get();
        $reg=DB::table('reglements')->join('factures','factures.id','=','reglements.facture_id')
            ->select('reglements.id','reglements.montant_regle')
            ->where('reglements.etat','=',2)
            ->where('reglements.facture_id','=',$reglement->facture_id)
            ->where('reglements.deleted_at','=',null)
            ->get();

        $html=View::make('impression.payement',compact('fact','reg'));;
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream("reglement.pdf",array("Attachment" => 0));
    }

}
