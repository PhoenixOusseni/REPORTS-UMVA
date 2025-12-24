@extends('layouts.master')

@section('content')
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_ma') }}">Accueil</a></li>
                         <li class="breadcrumb-item">Tableau de bord<datagrid></datagrid></li>
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
                                               <label for="maName" class="small">umva id</label>
                                                <input class="form-control" type="text" id="maName" name="maName"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maName" class="small">nom</label>
                                                <input class="form-control" type="text" id="maName" name="maName"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="maLastName" class="small">prenom</label>
                                                <input class="form-control" type="text" id="maLastName" name="maLastName"
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
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ka.kaya</span>
                                <span class="badge bg-primary rounded-pill">
                                    <a href="{{ route('ka.detail_kas') }}" class="text-white text-decoration-none">
                                        <i class="bi bi-eye"></i>&nbsp;Voir
                                    </a>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ka.korsimoro</span>
                                <span class="badge bg-primary rounded-pill">
                                    <a href="#" class="text-white text-decoration-none">
                                        <i class="bi bi-eye"></i>&nbsp;Voir
                                    </a>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ka.pensa</span>
                                <span class="badge bg-primary rounded-pill">
                                    <a href="#" class="text-white text-decoration-none">
                                        <i class="bi bi-eye"></i>&nbsp;Voir
                                    </a>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ka.pissila</span>
                                <span class="badge bg-primary rounded-pill">
                                    <a href="#" class="text-white text-decoration-none">
                                        <i class="bi bi-eye"></i>&nbsp;Voir
                                    </a>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>ka.boussouma</span>
                                <span class="badge bg-primary rounded-pill">
                                    <a href="#" class="text-white text-decoration-none">
                                        <i class="bi bi-eye"></i>&nbsp;Voir
                                    </a>
                                </span>
                            </li>
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
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="rapportFile" class="small">Sélectionner le fichier
                                                rapport</label>
                                            <input class="form-control" type="file" id="rapportFile" accept=".txt"
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

                    <div class="card-body p-0">
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
