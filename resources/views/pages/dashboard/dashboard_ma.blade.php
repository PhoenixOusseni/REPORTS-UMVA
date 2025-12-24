@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_ma') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tableau de bord MA</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row g-4">
            {{-- MA SUPERVISÉS --}}
            <div class="col-md-6 mt-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                👤 Liste des KAs <strong>{{ $totalKas ?? 0 }}</strong>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#GroupeBackdrop">
                                    <i class="bi bi-plus-lg"></i>&nbsp; Ajouter un KA
                                </a>
                            </div>
                        </div>
                    </div>

                        <!-- Modal -->
                        <div class="modal fade" id="GroupeBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="GroupeBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="GroupeBackdropLabel">Ajouter un nouveau KA</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="#" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="kaName" class="small">umva id</label>
                                                <input class="form-control" type="text" id="kaName" name="kaName"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kaName" class="small">nom</label>
                                                <input class="form-control" type="text" id="kaName" name="kaName"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kaLastName" class="small">prenom</label>
                                                <input class="form-control" type="text" id="kaLastName" name="kaLastName"
                                                    required>
                                            </div>
                                            <div class="mx-0">
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @forelse ($kas as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->umva_id }}</span>
                                    <span class="badge bg-primary rounded-pill">
                                        <a href="{{ route('gestions_utilisateurs.show', $item->id) }}"
                                            class="text-white text-decoration-none">
                                            <i class="bi bi-eye"></i>&nbsp;Voir
                                        </a>
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <em>Aucun KA supervisé pour le moment.</em>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            {{-- HISTORIQUE DES RAPPORTS --}}
            <div class="col-md-6 mt-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                📄 Historique de mes rapports
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    <i class="bi bi-plus-lg"></i>&nbsp; Charger un rapport
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Charger nouveau rapport</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('gestions_rapports_ma.store') }}"
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
                                            <input class="form-control" type="date" id="dateRapport"
                                                name="date_rapport" required>
                                        </div>
                                        <hr class="mt-4">
                                        <div class="mx-0">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-lg"></i>&nbsp; Valider
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i>&nbsp; Fermer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse ($rapportsMa as $item)
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rapport du {{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</strong><br>
                                                <small class="text-muted">Créé le {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="bi bi-download"></i>&nbsp;Télécharger
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item">Aucun rapport disponible.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
