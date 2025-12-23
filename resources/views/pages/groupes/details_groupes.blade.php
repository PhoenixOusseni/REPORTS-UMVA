@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Détails du Groupe</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_ka') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Détails groupe</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('dashboard_ka') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h5>{{ $findGroupe->nom ?? 'Nom du Groupe' }}</h5>
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#GroupeDetailBackdrop">
                            <i class="bi bi-plus-lg"></i>&nbsp; Charger un nouveau rapport
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="GroupeDetailBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="GroupeDetailBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="GroupeDetailBackdropLabel">Charger nouveau rapport</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('gestions_rapports_groupes.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="rapportFile" class="small">Sélectionner le fichier
                                            rapport</label>
                                        <input class="form-control" name="file" type="file" id="rapportFile"
                                            accept=".txt" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dateRapport" class="small">Date du rapport</label>
                                        <input class="form-control" name="date_rapport" type="date" id="dateRapport"
                                            required>
                                    </div>

                                    <input type="text" name="groupe_id" value="{{ $findGroupe->id }}" hidden>

                                    <hr class="mt-5">

                                    <div class="mx-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-upload"></i>&nbsp; Charger le rapport
                                        </button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">
                                            <i class="bi bi-x-lg"></i>&nbsp; Fermer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush">
                            @forelse ($rapports as $item)
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rapport du {{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</strong><br>
                                                <small class="text-muted">Créé le {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small>
                                            </div>
                                            <span>{{ $item->groupe->nom }}</span>
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="bi bi-download"></i>&nbsp;Télécharger
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <div class="list-group-item">
                                        <em>Aucun rapport disponible pour ce groupe.</em>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
