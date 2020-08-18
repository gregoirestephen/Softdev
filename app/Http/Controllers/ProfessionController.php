<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Profession;
use Illuminate\Http\Request;
use Gate;

class ProfessionController extends Controller
{
    //fonction de validation
    public function validateData(){
        \request()->validate([
            'libelle'=>['required','string'],

        ]);
    }

    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('profession.index');
    }

    //fonction d'enregistrement
    public function store(){
        $data= \request()->validate([
            'libelle'=>['required','string'],

        ]);

        Profession::create($data);

    }

    //fonction renvoyant la liste des professions
    public function show(){
        $profession=Profession::all();

        return response()->json($profession);
    }

    //fonction qui renvoie une proffession
    public function getProfession(Profession $profession){
        return response()->json($profession);
    }

    //fonction de modification
    public function update(Profession $profession){
        $data= \request()->validate([
            'libelle'=>['required','string'],

        ]);

        $profession->update($data);
    }

    //fonction retournant la profession
    public function profession($id){
        $profession=Profession::all()->where('id',$id);
        return response()->json($profession);
    }

    //fonction de verification
    public function verification($id){
        $patient=count(Patient::all()->where('profession_id',$id));
        //renvoie de la response
        return response()->json($patient);
    }

    //fonction de suppression
    public function destroy(Profession $profession){
        $profession->delete();
    }
}
