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
        // store user all type
        $users = new User();
        $users->umva_id = $request->input('umva_id') ?? null;
        $users->nom = $request->input('nom') ?? null;
        $users->prenom = $request->input('prenom') ?? null;
        $users->role_id = $request->input('role_id') ?? null;
        $users->supervisor_id = $request->input('supervisor_id') ?? null;
        $users->password = Hash::make($request->input('password')) ?? null;

        $users->save();

        return redirect()->back()->with('success', 'Utilisateur ' . $users->umva_id . ' créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $findUser = User::findOrFail($id);
        $rapports = $findUser->rapportsKa()->orderBy('date_rapport', 'desc')->get();

        return view('pages.mas.details_mas', compact('findUser', 'rapports'));
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
}
