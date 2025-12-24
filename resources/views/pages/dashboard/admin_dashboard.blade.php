@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tableau de bord Administrateur</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statistiques des utilisateurs</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-info h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">NOMBRE DES GROUPES G50</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-primary h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">NOMBRE DES PF</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-success h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">NOMBRE DES KAS</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-warning h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">NOMBRE DES MAS</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Statistiques des rapports</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-danger h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">RAPPORT G50</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-secondary h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">RAPPORT PF</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-warning h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">RAPPORT KA</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-4">
                                <div class="card text-white bg-info h-100">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h5 class="card-title">RAPPORT MA</h5>
                                        <p class="card-text display-4">0114</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-5">
            {{-- MA SUPERVISÉS --}}
            <div class="col-md-6 mt-5">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                👤 Liste des Pfs <strong>{{ $totalPfs ?? 0 }}</strong>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#PfBackdrop">
                                    <i class="bi bi-plus-lg"></i>&nbsp; Ajouter un PF
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="PfBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="PfBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="PfBackdropLabel">Ajouter un nouveau PF</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('gestions_utilisateurs.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="umva_id" class="small">umva id</label>
                                            <input class="form-control" type="text" id="umva_id" name="umva_id"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nom" class="small">Nom</label>
                                            <input class="form-control" type="text" id="nom" name="nom"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="prenom" class="small">Prénom</label>
                                            <input class="form-control" type="text" id="prenom" name="prenom"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="prenom" class="small">Mot de passe</label>
                                            <input class="form-control" type="password" id="password" name="password"
                                                value="123123">
                                        </div>

                                        <input type="text" name="supervisor_id" value="{{ Auth::id() }}" hidden>
                                        <input type="text" name="role_id" value="4" hidden>

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

                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @forelse ($pfs as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->umva_id }}</span>
                                    <span class="badge bg-primary rounded-pill">
                                        <a href="{{ route('gestions_utilisateurs.show_fp', $item->id) }}"
                                            class="text-white text-decoration-none">
                                            <i class="bi bi-eye"></i>&nbsp; Voir
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
        </div>
    </div>
@endsection
