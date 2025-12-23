<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle the user login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_admin(Request $request)
    {
        // Valider les données reçues
        $credentials = $request->validate([
            'umva_id' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'integer'],
        ]);

        // Tenter l'authentification
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate(); // Protection contre fixation de session

            // Redirection selon le rôle de l'utilisateur connecté
            $user = Auth::user();
            if ($user) {
                switch ($user->role_id) {
                    case 1:
                        return redirect()->route('admin_dashboard')->with('success', 'Connexion réussie');
                    case 2:
                        return redirect()->route('dashboard_ka')->with('success', 'Connexion réussie');
                    case 3:
                        return redirect()->route('dashboard_ma')->with('success', 'Connexion réussie');
                    case 4:
                        return redirect()->route('dashboard_fp')->with('success', 'Connexion réussie');
                    default:
                        Auth::logout();
                        return back()->withErrors([
                            'umva_id' => 'Rôle utilisateur non reconnu.',
                        ])->onlyInput('umva_id');
                }
            }

            // Déconnexion si l'utilisateur ne peut pas être récupéré
            Auth::logout();
            return back()->withErrors([
                'umva_id' => 'Vous n\'êtes pas autorisé à accéder à cette section.',
            ])->onlyInput('umva_id');
        }

        // Échec : identifiants invalides
        return back()->withErrors([
            'umva_id' => 'Les identifiants sont invalides.',
        ])->onlyInput('umva_id');
    }


    /**
     * Handle the user logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Protection CSRF

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
