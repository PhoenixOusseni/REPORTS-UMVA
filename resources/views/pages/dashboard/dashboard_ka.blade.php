@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_ka') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de bord KA</li>
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
                                👤 Liste des groupes <strong>{{ $totalGroups ?? 0 }}</strong>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#GroupeBackdrop">
                                    <i class="bi bi-plus-lg"></i>&nbsp; Ajouter un groupe
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
                                    <h5 class="modal-title" id="GroupeBackdropLabel">Ajouter un nouvel groupe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('gestions_groupes.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="groupeName" class="small">umva id</label>
                                            <input class="form-control" type="text" id="groupeName" name="nom"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="groupeDesc" class="small">Description du groupe</label>
                                            <textarea class="form-control" id="groupeDesc" name="description" rows="3"></textarea>
                                        </div>

                                        <hr class="mt-5">

                                        <div class="mx-0">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i>&nbsp; Ajouter le groupe
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
                            @forelse ($collections as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->nom }}</span>
                                    <span>{{ $item->created_at }}</span>
                                    <span class="badge bg-primary rounded-pill">
                                        <a href="{{ route('gestions_groupes.show', $item->id) }}"
                                            class="text-white text-decoration-none">
                                            <i class="bi bi-eye"></i>&nbsp; Voir
                                        </a>
                                    </span>
                                </li>
                            @empty
                                <div class="list-group-item">
                                    <em>Aucun rapport disponible.</em>
                                </div>
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
                                    <form method="POST" action="{{ route('gestions_rapports_ka.store') }}"
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
                                            <input class="form-control" name="date_rapport" type="date"
                                                id="dateRapport" required>
                                        </div>
                                        <hr class="mt-5">

                                        <div class="mx-0">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-upload"></i>&nbsp; Charger le rapport
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
                        <div class="p-3">
                            <div class="row mb-2 align-items-center">
                                <div class="col-md-3">
                                    <small class="text-muted fw-bold">Filtrer par période</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex" style="background-color: #f8f9fa; padding: 8px; border-radius: 5px; border: 1px solid #dee2e6;">
                                        <input type="date" class="form-control form-control-sm filter-date-start" id="dateDebut-kas"
                                            data-table="kas-table" placeholder="Date début">
                                        <input type="date" class="form-control form-control-sm filter-date-end ms-2" id="dateFin-kas"
                                            data-table="kas-table" placeholder="Date fin">
                                        <button type="button" class="btn btn-primary btn-sm ms-2 btn-filter" style="white-space: nowrap;"
                                            data-table="kas-table">
                                            <i class="bi bi-search"></i> Rechercher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush" id="rapports-ka-list">
                            @forelse ($rapportsKa as $item)
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rapport du
                                                    {{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</strong><br>
                                                <small class="text-muted">Créé le
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small>
                                            </div>
                                            <span>{{ $item->user->umva_id }}</span>
                                            <a href="{{ route('gestions_rapports_ka.download', $item->id) }}" class="text-decoration-none">
                                            <span class="badge bg-primary rounded-pill">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </span>
                                        </a>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <div class="list-group-item">
                                    <em>Aucun rapport disponible.</em>
                                </div>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.btn-filter[data-table="kas-table"]');
    
    if (button) {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const dateDebut = document.getElementById('dateDebut-kas');
            const dateFin = document.getElementById('dateFin-kas');
            const listRapports = document.getElementById('rapports-ka-list');
            
            if (!dateDebut || !dateFin) {
                alert('Erreur: Champs de date non trouvés!');
                return;
            }

            listRapports.innerHTML = '<li class="list-group-item text-center"><div class="spinner-border"></div> Chargement...</li>';

            fetch('{{ route("search-rapports-ka") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    date_debut: dateDebut.value,
                    date_fin: dateFin.value,
                    user_id: {{ Auth::id() }}
                })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success || data.data.length === 0) {
                    listRapports.innerHTML = '<li class="list-group-item text-center">Aucun rapport trouvé pour cette période</li>';
                    return;
                }

                let html = '';
                data.data.forEach(item => {
                    const dateRapport = new Date(item.date_rapport).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' });
                    const createdAt = new Date(item.created_at).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' });
                    const umvaId = item.user ? item.user.umva_id : '';
                    
                    html += `
                        <li>
                            <a href="#" class="text-decoration-none">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Rapport du ${dateRapport}</strong><br>
                                        <small class="text-muted">Créé le ${createdAt}</small>
                                    </div>
                                    <span>${umvaId}</span>
                                    <a href="/rapports/gestions_rapports_ka/${item.id}/download" class="text-decoration-none">
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="bi bi-download"></i>&nbsp; Télécharger
                                        </span>
                                    </a>
                                </div>
                            </a>
                        </li>`;
                });

                listRapports.innerHTML = html;
            })
            .catch(err => {
                console.error('Erreur:', err);
                listRapports.innerHTML = '<li class="list-group-item text-danger text-center">Erreur lors de la recherche: ' + err.message + '</li>';
            });
        });
    }
});
</script>
@endpush
@endsection
