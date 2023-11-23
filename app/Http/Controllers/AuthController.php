<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\candidat;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $p = candidat::where('email',$request->input('email'))->get();
        if (Auth::attempt($credentials)) {
            $request->session()->put('candidat', ["id"=>$p[0]->id_candidat, "nom"=>$p[0]->nom, "prenom"=> $p[0]->prenom, "cin"=> $p[0]->cin,"cv"=> $p[0]->cv, "lmv"=>$p[0]->lettre_motiv,"adresse"=>$p[0]->adresse,"email"=>$p[0]->email]); 
            return redirect()->intended('/');
        }
    
        // Authentication failed
        return back()->withErrors(['login' => 'The email or password you entered is incorrect.'])->onlyInput('email');
    }

}
