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
                        <h5>{{ $groupName ?? 'Nom du Groupe' }}</h5>
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#GroupeBackdrop">
                            <i class="bi bi-plus-lg"></i>&nbsp; Charger un nouveau rapport
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush">
                            <li>
                                <a href="#" class="text-decoration-none">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Rapport du 01 Janvier 2024</strong><br>
                                            <small class="text-muted">Créé le 01 Janvier 2024</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-download"></i>&nbsp;Télécharger
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-decoration-none">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Rapport du 01 Janvier 2024</strong><br>
                                            <small class="text-muted">Créé le 01 Janvier 2024</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-download"></i>&nbsp;Télécharger
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-decoration-none">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Rapport du 01 Janvier 2024</strong><br>
                                            <small class="text-muted">Créé le 01 Janvier 2024</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-download"></i>&nbsp;Télécharger
                                        </span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-decoration-none">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Rapport du 01 Janvier 2024</strong><br>
                                            <small class="text-muted">Créé le 01 Janvier 2024</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-download"></i>&nbsp;Télécharger
                                        </span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
