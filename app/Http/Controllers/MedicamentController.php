<?php

namespace App\Http\Controllers;

use App\Medicament;
use Illuminate\Http\Request;
use Gate;

class MedicamentController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isMedecin')) {
            abort(404, 'you can do this actions');
        }
        return view('Medicament.index');
    }

    //fonction retournant la liste des medicaments
    public function show(){
        $medicament=Medicament::all();
        return response()->json($medicament);
    }

    //fonction renvoyant un medicament specifique
    public function getMedicament(Medicament $medicament){
        return response()->json($medicament);
    }

    //fonction d'enregistrement
    public function store(){
       $data=\request()->validate([
           'nom_m'=>['required','string'],
       ]);
       Medicament::create($data);
    }

    //fonction de modification
    public function update(Medicament $medicament){
        $data=\request()->validate([
            'nom_m'=>['required','string'],
        ]);

        $medicament->update($data);
    }

    //fonction de suppression
    public function destroy(Medicament $medicament){
        $medicament->delete();
    }
}
