<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'umva_id' => $request->umva_id,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'supervisor_id' => $request->supervisor_id,
        ]);

        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$findUser = User::findOrFail($id);
        //$rapports = $findUser->rapportsKa()->orderBy('date_rapport', 'desc')->get();

        //return view('pages.kas.details_kas', compact('findUser', 'rapports'));
    }

    public function showKa(string $id)
    {
        $findUser = User::findOrFail($id);
        $rapports = $findUser->rapportsKa()
            ->orderBy('date_rapport', 'desc')
            ->get();

        return view('pages.kas.details_kas', compact('findUser', 'rapports'));
    }

    public function showMa(string $id)
    {
        $findUser = User::findOrFail($id);
        $rapports = $findUser->rapportsMa()
            ->orderBy('date_rapport', 'desc')
            ->get();

        return view('pages.mas.details_mas', compact('findUser', 'rapports'));
    }

    /**
     * Display the specified resource.
     */
    public function showFp(string $id)
    {
        $findUser = User::findOrFail($id);
        $rapports = $findUser->rapportsFp()
            ->orderBy('date_rapport', 'desc')
            ->get();

        return view('pages.fps.details_fps', compact('findUser', 'rapports'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Update the password of the authenticated user.
     */
    public function updatePassword(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Vérifier que l'utilisateur modifie son propre password
        if (Auth::id() != $user->id) {
            return redirect()->back()->with('error', 'Non autorisé');
        }

        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect']);
        }

        // Vérifier que les nouveaux mots de passe correspondent
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withErrors(['password_confirmation' => 'Les mots de passe ne correspondent pas']);
        }

        // Mettre à jour le mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès');
    }
}
