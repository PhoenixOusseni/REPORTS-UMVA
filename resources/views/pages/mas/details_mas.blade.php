@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Détails du KA</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_fp') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Détails MA</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('dashboard_fp') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h5> Nom du MA</h5>
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