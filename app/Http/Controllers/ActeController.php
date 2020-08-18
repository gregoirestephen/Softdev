<?php

namespace App\Http\Controllers;

use App\Acte;
use Illuminate\Http\Request;
use Gate;

class ActeController extends Controller
{
    //fonction de renvoie de vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Acte.index');
    }

    //fonction renvoyant une liste d'actes
    public function show(){
        $acte=Acte::all();
        return response()->json($acte);
    }

    //fonction de renvoie d'actes
    public function getActe(Acte $acte){
        return response()->json($acte);
    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
            'lib_actes'=>['required','string'],
            'coef_actes'=>['required','integer'],
            'prix_actes'=>['required','integer'],
        ]);

        Acte::create($data);
    }


    //fonction de modification
    public function update(Acte $acte){
        $data=\request()->validate([
            'lib_actes'=>['required','string'],
            'coef_actes'=>['required','integer'],
            'prix_actes'=>['required','integer'],
        ]);

        $acte->update($data);
    }

    //fonction de suppression de donnee
    public function destroy(Acte $acte){
        $acte->delete();
    }
}
