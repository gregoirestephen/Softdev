<?php

namespace App\Http\Controllers;

use App\Antecedent;
use App\HistoriqueAntecedent;
use App\LigneAntecedent;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Gate;

class LigneAntecedentController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $antecedent=Antecedent::all();
        $patient=Patient::all();
        return view('Ligne Antecedent.index',compact('antecedent','patient'));
    }

    //fonction retournant une ligne antecedent
    public function getAntecedent(LigneAntecedent $antecedent){
        return response()->json($antecedent);
    }

    //fonction retournant une liste d'antecedent
    public function show(){
        $lm=DB::table('ligne_antecedents')->join('patients','patients.id','=','ligne_antecedents.patient_id')
            ->join('antecedents','antecedents.id','=','ligne_antecedents.antecedent_id')
            ->select('antecedents.lib_ant','patients.nom_patient','patients.prenom_patient','ligne_antecedents.id','ligne_antecedents.autre_info')
            ->where('ligne_antecedents.deleted_at','=',null);
        $listeAntecedents=$lm->get();

        return response()->json($listeAntecedents);
    }

    //fonction d'enregistrement
    public function store(){
        $i=\request('patient_id');
        $info=\request('autre_info');
        $day = Carbon::now()->format('Y-m-d');

        HistoriqueAntecedent::create([
            'patient_id'=>$i,
            'libelle'=>\request('antecedent_id'),
            'date_A'=>$day
        ]);

        DB::table('ligne_antecedents')
            ->where('patient_id', $i)
            ->delete();

        if (isset($info)){
            $antecedent=new LigneAntecedent();
            $antecedent->patient_id=\request('patient_id');
            $antecedent->antecedent_id=\request('antecedent_id');
            $antecedent->autre_info=$info;
            $antecedent->save();
        }
        else{
            $info='Aucune';
            $antecedent=new LigneAntecedent();
            $antecedent->patient_id=\request('patient_id');
            $antecedent->antecedent_id=\request('antecedent_id');
            $antecedent->autre_info=$info;
            $antecedent->save();
        }

    }

    //fonction de modification
    public function update(LigneAntecedent $antecedent){
        $data=\request()->validate([
            'antecedent_id'=>['required','integer'],
            'patient_id'=>['required','integer'],
            'autre_info'=>['required','string']
        ]);
        $antecedent->update($data);
    }

    //fonction de suppression
    public function destroy(LigneAntecedent $antecedent){
        $antecedent->delete();
    }

}
