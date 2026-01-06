<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RapportFp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RapportFpsController extends Controller
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

            // Vérifier si le nom du fichier commence par "Mass_Meeting"
            if (!str_starts_with($originalFilename, 'Mass_Meeting')) {
                return redirect()->back()
                    ->with('error', 'Seuls les rapports PF sont autorisés. Veuillez selectionner un fichier valide.');
            }

            $path = 'reports/rapportfp/' . $originalFilename;

            // Vérifier si le fichier existe déjà
            if (Storage::disk('public')->exists($path)) {
                return redirect()->back()
                    ->with('error', 'Le fichier "' . $originalFilename . '" existe déjà. Veuillez selectionner un autre');
            }

            // Stocker le fichier avec son nom d'origine
            $file->storeAs('reports/rapportfp', $originalFilename, 'public');

            // Créer le rapport
            $rapport_fp = new RapportFp();
            $rapport_fp->user_id = Auth::id();
            $rapport_fp->date_rapport = $request->input('date_rapport');
            $rapport_fp->file = $path;
            $rapport_fp->save();

            return redirect()->back()
                ->with('success', 'Rapport du ' . Carbon::parse($rapport_fp->date_rapport)->format('d F Y') . ' créé avec succès.');
        }

        return redirect()->back()
            ->with('error', 'Aucun fichier n\'a été téléchargé.');
    }

    /**
     * Download the rapport file.
     */
    public function download(string $id)
    {
        $rapport = RapportFp::findOrFail($id);

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
