<?php

namespace App\Http\Controllers;

use App\Medication;
use Illuminate\Http\Request;
use Gate;

class MedicationController extends Controller
{

    //fonction renvoyant vers la vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Medication.index');
    }

    //fonction d'enregistrement
   public function store(){
       $data=\request()->validate([
           'lib_med'=>['required','string'],
       ]);

       Medication::create($data);

   }

    //fonction renvoyant la liste des medications
    public function show(){
        $medication=Medication::all();
        return response()->json($medication);
    }

    //fonction renvoyant une medication donnees
    public function getMedication(Medication $medication){
        return response()->json($medication);
    }

    //fonction de modification
    public function update(Medication $medication){
        $data=\request()->validate([
            'lib_med'=>['required','string'],
        ]);
        $medication->update($data);
    }

    //fonction de suppression
    public function destroy(Medication $medication){
        $medication->delete();
    }
}
