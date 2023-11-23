<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\admin;
use App\Models\candidat;
use App\Models\profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Admincontroller extends Controller
{
    public function download_offre($file){
        return response()->download(public_path('uploads/'.$file));
    }
    public function index()
    {
        $candidats = Candidat::all();
        $admin = Session::get('admin');
        $data = admin::find($admin['id']);
        if (!empty($data)) {
            return view('app-admin.home-admin', compact("data","candidats"));
        }
        return redirect('app-admin/login');
    }
    public function login_admin(Request $request)
    { 
        if(!empty($request->input('email'))){
            $p = admin::where('email', $request->input('email'))->get();
            if($p->isNotEmpty() && ($p[0]->password == md5($request->input('passe')) )){
             $request->session()->put('admin', ["id"=>$p[0]->id_admin, "nom"=>$p[0]->nom, "prenom"=> $p[0]->prenom, "adresse"=>$p[0]->adresse,"email"=>$p[0]->email]); 
             return redirect('app-admin/home');
            }else{
                return back()->withErrors(['login' => 'The email or password you entered is incorrect.'])->onlyInput('email');  
            }
         } 
    }
    public function logout_admin(Request $request)
    {
        $candidatSession = session('candidat');

        // Invalidate all sessions
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Restore the 'candidat' session data
        if ($candidatSession) {
            $request->session()->put('candidat', $candidatSession);
        }
    
        return redirect('app-admin/login');
    }
   
public function delete_candidat($id){
    $candidat = Candidat::find($id);
    if ($candidat) {
        $candidat->delete();
        return redirect()->route('app-admin/home')->with('success', 'Candidat est supprimé.');
    }
    return redirect()->route('app-admin/home')->with('error', 'Candidat introuvable !.');
}
    public function show_departements(){
        // $departs = Departement::all();
        $departs = Departement::select(['departement.*', 
        \Illuminate\Support\Facades\DB::raw('(SELECT COUNT(*) FROM profession WHERE departement.id_depart = profession.id_depart) AS professions_count')])
        ->get();

        if (!empty($departs)) {
        return view('app-admin.departements', compact("departs"));
        }
        return redirect('app-admin/home');
}
public function delete_departement($id){
    $depart = Departement::find($id);
    if ($depart) {
        $depart->delete();
        return redirect()->back()->with('success', 'Département est supprimé.');
    }
    return redirect()->back()->with('error', 'Département introuvable !.');
}
public function add_departement(Request $request){
        try {
            Departement::create(['nom_depart'=>$request->input('nom')]);
            return redirect()->back()->with('success', 'Département est ajouté.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Département non ajouter !.');
        }
}
public function edit_departement(Request $request){
    try {
        $depart = Departement::find($request->input('iddepart'));
        $depart->update(["nom_depart"=>$request->input('nom')]);
        return redirect()->back()->with('success', 'Département est modifié.');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Département non modifié !.');
    }
}
// professions
public function show_professions(){
 $departs = Departement::all();
$profs = DB::table('profession')
->join('departement', 'profession.id_depart', '=', 'departement.id_depart')
->select('profession.*', 'departement.*')
->get();
    if (!empty($profs)) {
    return view('app-admin.professions', compact("profs","departs"));
    }
    return redirect('app-admin/home');
}
public function delete_profession($id){
    $prof = profession::find($id);
    if ($prof) {
        $prof->delete();
        return redirect()->back()->with('success', 'Profession est supprimé.');
    }
    return redirect()->back()->with('error', 'Profession introuvable !.');
}
public function add_profession(Request $request){
        try {
            profession::create(['nom_prof'=>$request->input('nom'),
                                  'id_depart'=>$request->input('depart_id')]);
            return redirect()->back()->with('success', 'Profession est ajouté.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Profession non ajouter !.');
        }
}
public function edit_profession(Request $request){
    try {
        $prof = profession::find($request->input('id_prof'));
        $prof->update(["nom_prof"=>$request->input('nom'),
                        "id_depart"=>$request->input('depart_id')        ]);
        return redirect()->back()->with('success', 'Profession est modifié.');
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Profession non modifié !.');
    }
}
public function change_passe(Request $request){
    $admin = Session::get('admin');
    $request->validate([
        'oldpass' => 'required|string',
        'nvpass' => 'required|string|min:6',
        'conpass' => 'required|string|same:nvpass',
    ]);
    $user = admin::find($admin['id']);
    if ($user && md5($request->input('oldpass'), $user->password)) {
    $user->password = md5($request->input('nvpass'));
    $user->save();
    return back()->with('success', 'Mot de passe est changé');
    }

    return back()->withErrors(['oldpass'=> 'Invalid old password']);

   
}
}
