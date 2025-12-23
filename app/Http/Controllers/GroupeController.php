<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupe;

class GroupeController extends Controller
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
        // Create and save the new groupe
        $groupe = new \App\Models\Groupe();
        $groupe->nom = $request->input('nom');
        $groupe->description = $request->input('description') ?? null;
        $groupe->user_id = Auth::id();
        $groupe->save();

        return redirect()->back()->with('success', 'Groupe created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $findGroupe = Groupe::findOrFail($id);
        $rapports = $findGroupe->rapports()->orderBy('date_rapport', 'desc')->get();
        
        return view('pages.groupes.details_groupes', compact('findGroupe', 'rapports'));
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
