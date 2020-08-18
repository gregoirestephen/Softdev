<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;
use Gate;

class ProfilController extends Controller
{

    //fonction renvoyant vers une vue
    public function index(){
        if (!Gate::allows('isAdmin')) {
            abort(404, 'you can do this actions');
        }
        return view('profil.admin');
    }

    //fonction retournant la liste des profils
    public function show(){
        $profil=Profil::all();
        return response()->json($profil);
    }

    //fonction retournant un profil specifiaque
    public function getProfil(Profil $profil){
        return response()->json($profil);
    }

    //fonction d'enregistrement de donnee
    public function store(){
        $data=\request()->validate([
            'lib_p'=>['required','string'],
        ]);
        Profil::create($data);
    }

    //fonction de modification de donnees
    public function update(Profil $profil){
            $data=\request()->validate([
                'lib_p'=>['required','string'],
            ]);
            $profil->update($data);
    }

    //fonction de suppression de donnees
    public function destroy(Profil $profil){
        $profil->delete();
    }
}
