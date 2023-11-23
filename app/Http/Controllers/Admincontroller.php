<?php

namespace App\Http\Controllers;

use App\Mail\passentretien;
use App\Models\Departement;
use App\Models\admin;
use App\Models\candidat;
use App\Models\demande_emploi;
use App\Models\offre_emploi;
use App\Models\profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        return redirect()->back()->with('error', 'Profession non modifié !');
    }
}

// offres
  public function show_offres(){
        $profs = profession::all();
        $offres = DB::table('offre_emploi')
        ->join('profession', 'profession.id_prof', '=', 'offre_emploi.id_prof')
        ->join('departement', 'departement.id_depart', '=', 'profession.id_depart')
        ->select('profession.*', 'departement.*','offre_emploi.*')
        ->get();
        if (!empty($offres)) {
             return view('app-admin.offres', compact("profs","offres"));
            }
        return redirect('app-admin/home');
  }


  public function add_offre(Request $request){
   try {
    // Upload files and get their filenames    
    $filedt = $request->file('details');
    $filenamedt = time() . '.' . $filedt->getClientOriginalExtension();
    $filedt->move(public_path('uploads'), $filenamedt);
    
    // Create Candidat instance with form data and file names
    offre_emploi::create([
          "id_prof"=>$request->input('prof_id'),
          "details"=>$filenamedt,
          "type_emploi"=>$request->input('type_emploi'),
          "date_pub"=> now(),
          "date_termine"=>now(),
          "termine"=> 0,
    ]);
    return redirect()->back()->with('success', 'Offre est ajouté.');
   } catch (\Throwable $th) {
    return redirect()->back()->with('error', 'Offre non ajouté !');
   }
  }
  public function edit_offre(Request $request){
    try {
        $filedt = $request->file('details');
        $offre = offre_emploi::find($request->input('idoffre'));
            if (!empty($filedt)) {
                $filenamedt = time() . '.' . $filedt->getClientOriginalExtension();
                $filedt->move(public_path('uploads'), $filenamedt);
                $offre->details = $filenamedt;
                $offre->save();
            }
           $offre->id_prof = $request->input('prof_id');
           $offre->type_emploi = $request->input('type_emploi');
           $offre->save();
        return redirect()->back()->with('success', 'Offre est modifié.');
       } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'Offre non modifié !');
       }
  }    


  public function delete_offre($id){
      $offre = offre_emploi::find($id);
      if ($offre) {
          $offre->delete();
          return redirect()->back()->with('success', 'Offre est supprimé.');
      }
      return redirect()->back()->with('error', 'Offre introuvable !.');
  }
 public function offre_inactive($id){
    try {
        $offre = offre_emploi::find($id);
        $offre->termine = '1';
        $offre->date_termine = now();
        $offre->save();
       return back()->with('success', "Offre a été désactivé !");
   } catch (\Throwable $th) {
       return back()->with('error', 'Offre non désactivé !');
  }
 }
 public function offres_details($id){
    $offre = DB::table('offre_emploi')
            ->join('profession','profession.id_prof','=','offre_emploi.id_prof')
            ->join('departement','departement.id_depart','=','profession.id_depart')
            ->where('offre_emploi.id_offre',$id)
            ->get();
            $demandes = DB::table('demande_emploi')
            ->join('candidat', 'demande_emploi.id_candidat', '=', 'candidat.id_candidat')
            ->join('offre_emploi', 'demande_emploi.id_offre', '=', 'offre_emploi.id_offre')
            ->where('demande_emploi.id_offre', $id)
            ->whereNull('demande_emploi.accepted')  // Filter by accepted = null
            ->select('candidat.*')
            ->get();
    if (!empty($demandes)) {
        return view('app-admin.demandes_offre', compact("demandes","offre"));
       }
   return redirect('app-admin/home');
 }
 public function accepter_offre(request $request){
    try {
        $candidat = candidat::find($request->input('idcandidat'));
       demande_emploi::where('id_candidat', $request->input('idcandidat'))
        ->where('id_offre', $request->input('idoffre'))
       ->update([
            'accepted' => 1,
            'date_entretien' => $request->input('date_entretien')]);
            Mail::to($candidat->email)->send(new passentretien($request->input('nom_prof'),$request->input('nom_depart'),$request->input('date_entretien')));
         return redirect()->back()->with('success', 'Le candidat a été accepté !');
 
     } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'Error !');
   }
 }
 public function refuse_offre(request $request, $id_candidat){
     try {
      demande_emploi::where('id_candidat', $id_candidat)
      ->where('id_offre', $request->input('idoffre'))
      ->update(['accepted' => 0]);
         
          return redirect()->back()->with('success', 'Le candidat a été refusé !');
      } catch (\Throwable $th) {
          return redirect()->back()->with('error', 'Error !');
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
