<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapportGroupe;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

        // Stocker le fichier
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('reports/rapportgroupe', $filename, 'public');
            $rapport->file = $path;
        }

        $rapport->save();

        return redirect()->back()->with('success', 'Rapport du ' . $rapport->date_rapport . ' créé avec succès.');
    }

    /**
     * Download the rapport file.
     */
    public function download(string $id)
    {
        $rapport = RapportGroupe::findOrFail($id);

        // Vérifier que l'utilisateur peut télécharger ce fichier
        // if (Auth::id() != $rapport->user_id) {
        //     abort(403, 'Non autorisé');
        // }

        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($rapport->file)) {
            abort(404, 'Fichier non trouvé');
        }

        // Extraire le nom du fichier et s'assurer qu'il a l'extension .txt
        $originalFilename = basename($rapport->file);
        $filenameWithoutExt = pathinfo($originalFilename, PATHINFO_FILENAME);
        $downloadFilename = $filenameWithoutExt . '.txt';

        // Télécharger le fichier avec l'extension .txt et le type MIME text/plain
        return Storage::disk('public')->download(
            $rapport->file,
            $downloadFilename,
            ['Content-Type' => 'text/plain']
        );
    }
}
