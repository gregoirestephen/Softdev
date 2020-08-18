<?php

namespace App\Http\Controllers;

use App\Dent;
use Illuminate\Http\Request;
use Gate;

class DentController extends Controller
{
    //fonction retournant vers la vue
    public function index(){
        if (!Gate::allows('isSecretaire')) {
            abort(404, 'you can do this actions');
        }
        return view('Dent.index');
    }

    //fonction retournant la liste des dents
    public function show(){
        $dent=Dent::all();
        return response()->json($dent);
    }

    //fonction retournant une dent
    public function getDent(Dent $dent){
        return response()->json($dent);
    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
            'designation_dent'=>['required','string']
        ]);
        Dent::create($data);
    }

    //fonction de modification
    public function update(Dent $dent){
        $data=\request()->validate([
            'designation_dent'=>['required','string']
        ]);
        $dent->update($data);
    }

    //fonction de suppression
    public function destroy(Dent $dent){
        $dent->delete();
    }
}
