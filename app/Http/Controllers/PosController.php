<?php

namespace App\Http\Controllers;


use App\Mail\ForgetPassMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;
use App\Models\candidat;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PosController extends Controller
{ 
   
    public function index()
    {
        $candidat = Session::get('candidat');
        $data = candidat::find($candidat['id']);
        if (!empty($data)) {
            return view('candidat.home', compact("data"));
        }
        return redirect('login');
    }
   public function login(Request $request)
    { 
        if(!empty($request->input('email'))){
            $p = candidat::where('email',$request->input('email'))->get();
            if($p->isNotEmpty() && ($p[0]->password == md5($request->input('password')) )){
             $request->session()->put('candidat', ["id"=>$p[0]->id_candidat, "nom"=>$p[0]->nom, "prenom"=> $p[0]->prenom, "cin"=> $p[0]->cin,"cv"=> $p[0]->cv, "lmv"=>$p[0]->lettre_motiv,"adresse"=>$p[0]->adresse,"email"=>$p[0]->email]); 
             return redirect('/');
            }else{
                return back()->withErrors(['login' => 'The email or password you entered is incorrect.'])->onlyInput('email');
                
            }
         } 
         
         if (!empty($request->input('semail'))) {
             $email = $request->input('semail');
 
             // Check if the email exists in the personnes table
             $candidat = FacadesDB::table('candidat')->where('email', $email)->first();
             
             if ($candidat) {
                 // Generate a 5-digit OTP
                 $otp = mt_rand(10000, 99999);
             
                 // Set the expiration date 1 minute from now
                 $expiryDate = now()->addMinute();
             
                 // Save the OTP and expiration date in the personnes table
                 FacadesDB::table('candidat')->where('email', $email)->update(['otp' => $otp, 'otp_expiry' => $expiryDate]);
             
                 // Send the OTP to the user's email
                 Mail::to($email)->send(new ForgetPassMail($otp));
             
                 // Store the email in the session
                 session(['email' => $email]);
             
                 return view('forget-pass');
             } else {
                 return back()->withErrors(['email'=> "Email introuvable !"])->onlyInput('semail');// Return a message indicating the email was not found
             }
         
          //modification de mot de passe  
         }elseif($request->input('nvpass') && $request->input('conpass')){
             $email = Session::get('email');
            if($request->input('nvpass')==$request->input('conpass')){
             FacadesDB::table('candidat')
             ->where('email', $email)
             ->update(['password'=>md5($request->input('nvpass'))]);
             return back()->with("success","mot de passe est modifiés !");
            }
             else{
                 return view('change-pass')->with('error', "Erreur !");
             }
         }
          else{
            //OTP saising
             $email = Session::get('email');
             $personne = candidat::where('email', $email)->first();
             $storedOtp = $personne->OTP;
             $generatedDate = $personne->OTP_expiry;
             $otp = $request->input('digit1') . $request->input('digit2') . $request->input('digit3') . $request->input('digit4') . $request->input('digit5');
             $generatedDate = Carbon::parse($generatedDate);
             if ($otp == $storedOtp && $generatedDate && $generatedDate->gt(now()->subMinute())) {
                 return view('change-pass');
             } else {
                 return view('forget-pass')->with('error', "Erreur !");
             }
          }
        }
      
    public function logout(Request $request)
    {
       
        $adminSession = session('admin');

        // Invalidate all sessions
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // Restore the 'admin' session data
        if ($adminSession) {
            $request->session()->put('admin', $adminSession);
        }
    
        return redirect('login');
    }
    public function register(Request $request){
            if ($request->has('signup')) {
                $validatedData = $request->validate([
                    'email' => 'required|unique:candidat,email',
                    'password' => 'required|min:6',
                    'confirm-password' => 'required|same:password',
                    'nom' => 'required',
                    'prenom' => 'required',
                    'cin' => 'required|unique:candidat,cin',
                    'adresse' => 'required',
                    'cv' => 'required|file|mimes:pdf,doc,docx', 
                    'lettre_motiv' => 'required|file|mimes:pdf,doc,docx', 
                ]);
                
                // Upload files and get their filenames
                $fileCV = $request->file('cv');
                $filenameCV = time() . '.' . $fileCV->getClientOriginalExtension();
                $fileCV->move(public_path('uploads'), $filenameCV);
                
                $fileLMV = $request->file('lettre_motiv');
                $filenameLMV = time() . '.' . $fileLMV->getClientOriginalExtension();
                $fileLMV->move(public_path('uploads'), $filenameLMV);
                
                // Create Candidat instance with form data and file names
                candidat::create([
                    'email' => $validatedData['email'],
                    'password' => md5($validatedData['password']),
                    'nom' => $validatedData['nom'],
                    'prenom' => $validatedData['prenom'],
                    'cin' => $validatedData['cin'],
                    'adresse' => $validatedData['adresse'],
                    'cv' => $filenameCV, 
                    'lettre_motiv' => $filenameLMV,
                ]);
                // Redirect to a success page or perform any other actions
                return redirect('/login')->with('success', 'Registration successful');
            }
      
       
    }
    public function download_offre($file){
        return response()->download(public_path('uploads/'.$file));
    }
}
