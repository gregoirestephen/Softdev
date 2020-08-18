<?php

namespace App\Http\Controllers;

use App\Profil;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Gate;

class UserController extends Controller
{
    //fonction retournant une vue
    public function index(){
        if (!Gate::allows('isAdmin')) {
            abort(404, 'you can do this actions');
        }
        $profil=Profil::all();
        return view('User.index',compact('profil'));
    }

    //fonction retournant un utilisateur
    public function getUtilisateur(User $user){
        return response()->json($user);
    }

    //fonction retournant la liste des utilisateurs
    public function show(){
        $liste=DB::table('users')->join('profils','profils.id','=','users.profil_id')
            ->select('users.name','users.email','users.contact','users.id','profils.lib_p');
        $utilisateur=$liste->get();

        return response()->json($utilisateur);
    }

    //fonction d'enregistrement
    public function store(){
        $data=\request()->validate([
           'profil_id'=>['required','integer'],
           'name'=>['required','string'],
           'email'=>['required','email'],
           'contact'=>['required','integer'],
           'password'=>['required','string','min:8'],
        ]);

         User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact'=>$data['contact'],
            'profil_id'=>$data['profil_id'],
            'password' => Hash::make($data['password']),
        ]);


    }

    //fonction de modification
    public function update(User $user){
        $data=\request()->validate([
            'profil_id'=>['required','integer'],
            'name'=>['required','string'],
            'email'=>['required','email'],
            'contact'=>['required','integer'],
        ]);
        $data['password']=Hash::make(\request('password'));

        $user->update($data);
    }

    //fonction de suppression
    public function destroy(User $user){
        $user->delete();
    }

}
