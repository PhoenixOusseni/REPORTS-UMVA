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
        $validated = $request->validate([
            'umva_id' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role_id' => ['required', 'integer'],
        ], [
            'umva_id.required' => 'L\'identifiant UMVA est requis.',
            'password.required' => 'Le mot de passe est requis.',
            'role_id.required' => 'Veuillez sélectionner un rôle.',
        ]);

        // Chercher l'utilisateur
        $user = User::where('umva_id', $validated['umva_id'])
                    ->where('role_id', $validated['role_id'])
                    ->first();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'umva_id' => 'Les identifiants ou le rôle est incorrect.',
            ])->withInput($request->only('umva_id', 'role_id'));
        }

        // Authentifier l'utilisateur
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();

        // Redirection selon le rôle de l'utilisateur connecté
        switch ($user->role_id) {
            case 1:
                return redirect()->route('dashboard')->with('success', 'Connexion réussie');
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
                ])->withInput($request->only('umva_id', 'role_id'));
        }
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
