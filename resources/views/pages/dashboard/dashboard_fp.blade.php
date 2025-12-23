@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">
            {{-- MA SUPERVISÉS --}}
            <div class="col-md-6 mt-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">
                        👤 MA supervisés
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush mb-3">
                            @forelse($subordinateMAs ?? [] as $ma)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $ma->prenom ?? '' }} {{ $ma->nom ?? '' }}</span>
                                    @if (isset($ma->subordinates) && $ma->subordinates->count() > 0)
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $ma->subordinates->count() }} KAs
                                        </span>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center">
                                    Aucun MA supervisé
                                </li>
                            @endforelse
                        </ul>

                        {{-- STATISTIQUES --}}
                        <div class="row text-center border-top pt-3">
                            <div class="col-4">
                                <strong>MAs</strong><br>
                                <span class="fs-5 text-primary">{{ $totalMAs ?? 0 }}</span>
                            </div>
                            <div class="col-4">
                                <strong>KAs</strong><br>
                                <span class="fs-5 text-success">{{ $totalKAs ?? 0 }}</span>
                            </div>
                            <div class="col-4">
                                <strong>Groupes</strong><br>
                                <span class="fs-5 text-warning">{{ $totalGroups ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HISTORIQUE DES RAPPORTS --}}
            <div class="col-md-6 mt-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">
                        📄 Historique des rapports
                    </div>

                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($recentReports ?? [] as $report)
                                <li class="list-group-item">
                                    {{ $report->title ?? 'Rapport #' . ($report->id ?? '-') }}
                                </li>
                            @empty
                                <li class="list-group-item text-muted text-center">
                                    Aucun rapport récent
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
