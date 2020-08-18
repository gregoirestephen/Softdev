<?php

namespace App\Http\Controllers;

use App\Consultation;
use App\LigneMedicament;
use App\Medicament;
use App\Ordonnance;
use Illuminate\Http\Request;
use Gate;

class OrdonnanceController extends Controller
{
    //fonction renvoyant vers une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        $consultation=Consultation::all();
        $medicament=Medicament::all();
        return view('Ordonnance.index',compact('consultation','medicament'));
    }

    //fonction renvoyant un ordonnance
    public function getOrdonnance(Ordonnance $ordonnance){
       return response()->json($ordonnance);
    }

    //fonction permettant d'annuler une ordonnance
    public function annulerMe(Ordonnance $ordonnance){
        $ordonnance->update([
            'etat'=>3,
        ]);

    }

    //fonction renvoyant la liste des ordonnances
    public function show(){
        $ordonnance=Ordonnance::all();
        return response()->json($ordonnance);
    }

    //fonction renvoyent la ligne des medications
    public function getLigne($ordonnance){
        $medoc=LigneMedicament::all()->where('ordonnance_id',$ordonnance);
        return response()->json($medoc);
    }

    //fonction d'enregistrement
    public function store(){
        \request()->validate([
            'consultation_id'=>['required','integer'],
        ]);
        $ordonnance=new Ordonnance();
        $ordonnance->consultation_id=\request('consultation_id');
        $ordonnance->etat=2;
        $ordonnance->save();
        return response()->json($ordonnance->id);
    }

    //fonction de modification
    public function update(Ordonnance $ordonnance){
        $data=\request()->validate([
            'consultation_id'=>['required','integer'],
            'etat'=>['required','integer'],
        ]);
        $ordonnance->update($data);
        return response()->json($ordonnance->id);
    }

    //fonction de suppression
    public function destroy(Ordonnance $ordonnance){
        $ordonnance->delete();
    }
}
