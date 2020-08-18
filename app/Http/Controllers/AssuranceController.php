<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Gate;

class AssuranceController extends Controller
{
    // fonction de validation des donnees
    public function validateData(){
        return \request()->validate([
            'nom_assurance'=>['required','string'],
            'adr_assurance'=>['required','string'],
        ]);
    }

    //fonction renvoyant une vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Assurance.index');
    }

    //fonction renvoyant la liste Assurance
    public function show(){
        $assurance=Assurance::all();
        return response()->json($assurance);
    }

    //fonction renvoyant une assurance
    public function getAssurance(Assurance $id){
        return response()->json($id);
    }

    //fonction d'enregistrement des donnees
    public function store(){
        $data=$this->validateData();
        Assurance::create($data);
    }

    //fonction de modification des donnees
    public function update(Assurance $assurance){
        $data=$this->validateData();
        $assurance->update($data);
    }

    //fonction de verification
    public function verification($id){
        $patient=count(Patient::all()->where('assurance_id',$id));
        return response()->json($patient);
    }

    //fonction de suppression des donnees
    public function destroy(Assurance $assurance){
        $assurance->delete();
    }
}
