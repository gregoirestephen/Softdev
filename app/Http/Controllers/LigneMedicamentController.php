<?php

namespace App\Http\Controllers;

use App\LigneMedicament;
use App\Medicament;
use App\Ordonnance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class LigneMedicamentController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }

        $ordonnance=Ordonnance::all()->where('etat','=',2);
        $medicament=Medicament::all();
        return view('LigneMedicament.index',compact('ordonnance','medicament'));
    }

    //fonction retournant la liste des lignes Medicaments
    public function show(){
        $lm=DB::table('ligne_medicaments')->join('medicaments','medicaments.id','=','ligne_medicaments.medicament_id')
            ->join('ordonnances','ordonnances.id','=','ligne_medicaments.ordonnance_id')
            ->select('ordonnances.consultation_id','ordonnances.etat','medicaments.nom_m','ligne_medicaments.ordonnance_id','ligne_medicaments.id','ligne_medicaments.posologie')
            ->where('ligne_medicaments.deleted_at','=',null);
        $listeMedicament=$lm->get();

        return response()->json($listeMedicament);
    }

    //fonction retournant une ligne Medicament
    public function getMedicament(LigneMedicament $medicament){
        return response()->json($medicament);
    }

    //fonction d'enregistrement
    public function store(){
        \request()->validate([
            'medicament_id'=>['required','integer'],
            'ordonnance_id'=>['required','integer'],
        ]);

        $info=\request('posologie');

        if (isset($info)){
            $medicament=new LigneMedicament();
            $medicament->medicament_id=\request('medicament_id');
            $medicament->ordonnance_id=\request('ordonnance_id');
            $medicament->posologie=\request('posologie');
            $medicament->save();
        }
        else{
            $medicament=new LigneMedicament();
            $medicament->medicament_id=\request('medicament_id');
            $medicament->ordonnance_id=\request('ordonnance_id');
            $medicament->posologie='Lire la notice';
            $medicament->save();
        }



    }

    //fonction de modification
    public function update(LigneMedicament $medicament){
        $data=\request()->validate([
            'medicament_id'=>['required','integer'],
            'ordonnance_id'=>['required','integer'],
            'posologie'=>['required','string']

        ]);
        $medicament->update($data);
    }

    //fonction de suppression
    public function destroy(LigneMedicament $medicament){
        $medicament->delete();
    }
}
