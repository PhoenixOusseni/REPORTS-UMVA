<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapportGroupe;
use Illuminate\Support\Facades\Auth;

class RapportGroupeController extends Controller
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
        // store rapport groupe
        $rapport = new RapportGroupe();
        $rapport->groupe_id = $request->input('groupe_id') ?? null;
        $rapport->user_id = Auth::id();
        $rapport->date_rapport = $request->input('date_rapport');

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('reports/rapportgroupe', 'public');
            $rapport->file = $path;
        }

        $rapport->save();

        return redirect()->back()->with('success', 'Rapport du ' . $rapport->date_rapport . ' créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
