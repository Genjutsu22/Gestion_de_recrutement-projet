<?php

namespace App\Http\Controllers;

use App\admin;
use App\Models\candidat;
use App\Models\demande_emploi;
use App\Models\offre_emploi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class candidatcontroller extends Controller
{
    public function show_profile(){
        $candidat = Session::get('candidat');
        $data = candidat::find($candidat['id']);
        if (!empty($candidat)) {
            return view('candidat.account', compact("data"));
        }
    }
    public function edit_candidat(Request $request){
        if ($request->has('update')) {
            $fileCV = $request->file('cv');
            $fileLMV = $request->file('lmv');
            $validatedData = $request->validate([
                'email' => 'required|unique:candidat,email',
                'cin'=>'required|unique:candidat,cin'
            ]);
           
            if (!empty($fileCV)) {
                $filenameCV = time() . '.' . $fileCV->getClientOriginalExtension();
                $fileCV->move(public_path('uploads'), $filenameCV);
                $candidat = candidat::find($request->input('idcandidat'));
                $candidat->cv = $filenameCV;
                $candidat->save();
            }
              if( !empty($fileLMV)){
                $filenameLMV = time() . '.' . $fileLMV->getClientOriginalExtension();
                $fileLMV->move(public_path('uploads'), $filenameLMV);
                $candidat = candidat::find($request->input('idcandidat'));   
                $candidat->lettre_motiv = $filenameLMV;
                $candidat->save();
              }
                
            
            // Create Candidat instance with form data and file names
            $candidat = Candidat::find($request->input('idcandidat'));

            if ($candidat) {
                $candidat->update([
                    'email' => $validatedData['email'],
                    'nom' => $request->input('nom'),
                    'prenom' =>$request->input('prenom'),
                    'cin' => $request->input('cin'),
                    'adresse' => $request->input('adresse'),
                ]);
              return back()->with('success','les données sont modifiés.');
            } 
            return back()->with('error','An error encountered !');
    }
   }
    public function show_offres(){
        $candidat = Session::get('candidat');
        $offres = offre_emploi::join('profession', 'offre_emploi.id_prof', '=', 'profession.id_prof')
        ->join('departement', 'profession.id_depart', '=', 'departement.id_depart')
        ->select(
            'offre_emploi.*',
            'profession.nom_prof as nom_profession',
            'departement.nom_depart as nom_departement'
        )
        ->where('offre_emploi.termine', '=', 0)
        ->whereNotIn('offre_emploi.id_offre', function ($query) use ($candidat) {
            $query->select('id_offre')
                ->from('demande_emploi')
                ->where('id_candidat', '=', $candidat['id']);
        })
        ->orderBy('offre_emploi.date_pub', 'desc')
        ->get();
    return view('candidat.offres', compact('offres'));
    }
    public function postuler(Request $request){
     
             $candidat = Session::get('candidat');
             $id_offre = $request->input('idoffre');
             try{
                demande_emploi::create([
                    'id_offre'=>$id_offre,
                    'id_candidat'=>$candidat['id'],
                    'accepted'=>null
                 ]);  
                 return back()->with('success','Votre demande à été enregistrer !');
             } catch (\Throwable $th) {
                 return back()->with('error','Votre demande n\'est pas enregistrer ! ');
             }
         
    }
    public function show_demandes(){
        $candidat = Session::get('candidat');

        $offres = offre_emploi::join('demande_emploi', 'offre_emploi.id_offre', '=', 'demande_emploi.id_offre')
            ->join('profession', 'offre_emploi.id_prof', '=', 'profession.id_prof')
            ->join('departement', 'profession.id_depart', '=', 'departement.id_depart')
            ->select(
                'offre_emploi.*',
                'demande_emploi.*',
                'profession.nom_prof as nom_profession',
                'departement.nom_depart as nom_departement'
            )
            ->where('offre_emploi.termine', '=', 0)
            ->where('demande_emploi.id_candidat', '=', $candidat['id'])
            ->orderBy('offre_emploi.date_pub', 'desc')
            ->get();
       return view('candidat.demandes', compact('offres'));
    }
    public function delete_demande(Request $request){
        $candidat = Session::get('candidat');
        $id_offre = $request->input('idoffre');
        try {
            Demande_Emploi::where('id_offre', $id_offre)
            ->where('id_candidat', $candidat['id'])
            ->delete();
            return back()->with('success','Votre demande est supprimée !');
        } catch (\Throwable $th) {
            return back()->with('error','Votre demande n\'est pas supprimée ! ');
        }

    }
    public function show_change_passe(){
        $candidat = Session::get('candidat');
        return view('candidat.change_motpasse', compact('candidat'));
    }
    public function change_passe(Request $request){
    
        $request->validate([
            'oldpass' => 'required|string',
            'nvpass' => 'required|string|min:6',
            'conpass' => 'required|string|same:nvpass',
        ]);
        $user = candidat::find($request->input('idemploye'));
        if ($user && md5($request->input('oldpass'), $user->password)) {
        $user->password = md5($request->input('nvpass'));
        $user->save();
        return back()->with('success', 'Mot de passe est changé');
        }
  
        return back()->withErrors(['oldpass'=> 'Invalid old password']);
  
       
    }
}
