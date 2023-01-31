<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required',  'min:5'],
            'email' => ['required', 'email', Rule::unique('users',  'email')],
            'password' => 'required|confirmed|min:8',
            'g-recaptcha-response' => ['required', new ReCaptcha] // -------RECAPTCHA -----------------------------------
        ]);
        $formFields['password'] = bcrypt($formFields['password'] );
        $user = User::create($formFields);
        // -------------------------------------------------------------
        // Una volta che l'utente è stato autenticato,
        // verranno creati i cookie di sessione necessari per mantenere
        // l'utente autenticato durante la navigazione del sito.
        auth()->login($user);
        // -------------------------------------------------------------
        return redirect('/')->with('message', 'Nuovo utente creato con successo');
    }
    public function logout(Request $request){
        auth()->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        session(['userLoggato' => ' ']);
        return view('/auth/login');
    }
    public function login(){
        return view('/auth/login');
    }
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        // -------------------------------------------------------------------------------------
        // se dopo tutti i tentativi (attempt) risulta autenticato
        if(auth() ->attempt($formFields)){
            $request->session()->regenerate();
            $userLoggato = auth()->user()->name;
            $emailLoggato = auth()->user()->email;
            $idLoggato = auth()->user()->id;
            session(['emailLoggato' => $emailLoggato]);
            session(['userLoggato' => $userLoggato]);
            session(['idLoggato' => $idLoggato]);
            return view('contents/content0');
        }
        // -------------------------------------------------------------------------------------
        // se dopo tutti i tentativi (attempt) NON risulta autenticato
        return back()->withErrors(['email' => 'Credenziiali non valide']) ->onlyInput('email');
        // -------------------------------------------------------------------------------------
    }
    public function registration()
    {
        return view('auth/registration');
    }
    public function customRegistration(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("login")->with('success','Registrazione utente avvenuta.');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
}
