<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapportMa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RapportMasController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Stocker le fichier
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFilename = $file->getClientOriginalName();

            // Vérifier si le nom du fichier commence par "SA_ma"
            if (!str_starts_with($originalFilename, 'SA_ma')) {
                return redirect()->back()
                    ->with('error', 'Seuls les rapports MA sont autorisés. Veuillez selectionner un fichier valide.');
            }

            $path = 'reports/rapportma/' . $originalFilename;

            // Vérifier si le fichier existe déjà
            if (Storage::disk('public')->exists($path)) {
                return redirect()->back()
                    ->with('error', 'Le fichier "' . $originalFilename . '" existe déjà. Veuillez selectionner un autre');
            }

            // Stocker le fichier avec son nom d'origine
            $file->storeAs('reports/rapportma', $originalFilename, 'public');

            // Créer le rapport
            $rapport_ma = new RapportMa();
            $rapport_ma->user_id = Auth::id();
            $rapport_ma->date_rapport = $request->input('date_rapport');
            $rapport_ma->file = $path;
            $rapport_ma->save();

            return redirect()->back()
                ->with('success', 'Rapport du ' . Carbon::parse($rapport_ma->date_rapport)->format('d F Y') . ' créé avec succès.');
        }

        return redirect()->back()
            ->with('error', 'Aucun fichier n\'a été téléchargé.');
    }

    /**
     * Download the rapport file.
     */
    public function download(string $id)
    {
        $rapport = RapportMa::findOrFail($id);

        // Vérifier que l'utilisateur peut télécharger ce fichier
        // if (Auth::id() != $rapport->user_id) {
        //     abort(403, 'Non autorisé');
        // }

        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($rapport->file)) {
            abort(404, 'Fichier non trouvé');
        }

        // Télécharger le fichier
        return Storage::disk('public')->download($rapport->file);
    }
}
