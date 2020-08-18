<?php

namespace App\Http\Controllers;

use App\Antecedent;
use Illuminate\Http\Request;
use Gate;

class AntecedentController extends Controller
{
    //fonction de validation
    public function validateData(){
        return \request()->validate([
            'lib_ant'=>['required','string'],
        ]);
    }

    //fonction renvoyant une vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Antecedent.index');
    }

    //fonction d'enregistrement de donnee
    public function store(){

        $data=$this->validateData();
        Antecedent::create($data);
    }

    //fonction renvoyant la liste Antecedent
    public function show(){
        $antecedent=Antecedent::all();
        return response()->json($antecedent);
    }

    //fonction renvoyant un Antecedent
    public function getAntecedent(Antecedent $antecedent){
        return response()->json($antecedent);
    }

    //fonction de modification de donnees
    public function update(Antecedent $antecedent){
        $data=$this->validateData();
        $antecedent->update($data);
    }

    //fonction de destruction de donnees
    public function destroy(Antecedent $antecedent){
        $antecedent->delete();
    }
}
