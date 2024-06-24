<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\login_table;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{

    // Login Formulaire Authentification
    public function Log(Request $request)
    {

        // Validation des entrées
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // Récupération des données du formulaire
        $credentials = $request->only('email', 'password');
        $user = login_table::where('email', $request->email)->first();
        if ($user) {
            // Tentative d'authentification
            if ($user->email == $request->email && $user->password == $request->password) {
                // Récupérer l'utilisateur authentifié
                Auth::login($user);

                // Redirection selon le rôle de l'utilisateur
                if ($user->role == "RH") {
                    return redirect()->intended(route('ResponsableRH'));
                } elseif ($user->role == "Employe") {
                    $employe = Employe::where('mail', $user->email)->first();
                    if (!$employe) {

                        return redirect()->route('login')->with('error', 'Employé inconnu.');
                    }
                    return redirect()->route('EmployeHome', ['id' => $employe]);
                } elseif ($user->role == "admin") {
                    return redirect()->intended(route('adminPannel'));
                } elseif ($user->role == 'Stagiaire') {
                    $Stagiaire = Stagiaire::where('mail', $user->email)->first();
                    if (!$Stagiaire) {

                        return redirect()->route('login')->with('error', 'Stagiaire inconnu.');
                    }
                    return redirect()->route('homeStagiaire', ['id' => $Stagiaire->idStagiaire]);
                }
            }
        }
        // Si l'authentification échoue
        return redirect()->route('login')->with('error', 'Email ou mot de passe incorrect.');
    }


    // Enregiste le nouvel utilisateur
    public function registrationpost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['password'] = Hash::make($request->password);
        $user = login_table::create($data);

        if (!$user) {
            return redirect(route('registration'))->with("error", "registration failed");
        }
        return redirect(route('login'))->with("success", "Registration completed");
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route("login"));
    }
}
