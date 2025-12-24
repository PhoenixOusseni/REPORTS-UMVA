@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Détails du MA</h2>
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
                        <h5>{{ $findUser->umva_id }}</h5>
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
                                            <div>
                                                <a href="{{ route('gestions_rapports_ma.download', $item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-download"></i> Télécharger
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    Aucun rapport disponible.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
