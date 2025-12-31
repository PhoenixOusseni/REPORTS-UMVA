@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_fp') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Tableau de bord FP</li>
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
                                👤 Liste des MAs <strong>{{ $totalMas ?? 0 }}</strong>
                            </div>
                            <div>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#GroupeBackdrop">
                                    <i class="bi bi-plus-lg"></i>&nbsp; Ajouter un MA
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
                                        <input type="text" name="role_id" value="3" hidden>

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
                            @forelse ($mas as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $item->umva_id }}</span>
                                    <span class="badge bg-primary rounded-pill">
                                        <a href="{{ route('gestions_utilisateurs.show_ma', $item->id) }}"
                                            class="text-white text-decoration-none">
                                            <i class="bi bi-eye"></i>&nbsp;Voir
                                        </a>
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item">
                                    <em>Aucun MA supervisé pour le moment.</em>
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
                                    <form method="POST" action="{{ route('gestions_rapports_fp.store') }}"
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
                        <div class="p-3">
                            <div class="row mb-2 align-items-center">
                                <div class="col-md-3">
                                    <small class="text-muted fw-bold">Filtrer par période</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex"
                                        style="background-color: #f8f9fa; padding: 8px; border-radius: 5px; border: 1px solid #dee2e6;">
                                        <input type="date" class="form-control form-control-sm filter-date-start"
                                            id="dateDebut-fps" data-table="fps-table" placeholder="Date début">
                                        <input type="date" class="form-control form-control-sm filter-date-end ms-2"
                                            id="dateFin-fps" data-table="fps-table" placeholder="Date fin">
                                        <button type="button" class="btn btn-primary btn-sm ms-2 btn-filter"
                                            style="white-space: nowrap;" data-table="fps-table">
                                            <i class="bi bi-search"></i> Rechercher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush" id="rapports-fp-list">
                            @forelse ($rapportsFp as $item)
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Rapport du
                                                    {{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</strong><br>
                                                <small class="text-muted">Créé le
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</small>
                                            </div>
                                            <a href="{{ route('gestions_rapports_fp.download', $item->id) }}"
                                                class="text-decoration-none">
                                                <span class="badge bg-primary rounded-pill">
                                                    <i class="bi bi-download"></i>&nbsp; Télécharger
                                                </span>
                                            </a>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="list-group-item">Aucun rapport disponible.</li>
                            @endforelse
                        </ul>
                        @if ($rapportsFp->hasPages())
                            <div class="p-3 d-flex justify-content-center">
                                {{ $rapportsFp->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const button = document.querySelector('.btn-filter[data-table="fps-table"]');
                let currentFilters = {
                    dateDebut: '',
                    dateFin: '',
                    currentPage: 1
                };

                function loadRapports(page = 1) {
                    const dateDebut = document.getElementById('dateDebut-fps');
                    const dateFin = document.getElementById('dateFin-fps');
                    const listRapports = document.getElementById('rapports-fp-list');
                    const paginationContainer = document.querySelector('.card-body .p-3:last-child');

                    if (!dateDebut || !dateFin) {
                        alert('Erreur: Champs de date non trouvés!');
                        return;
                    }

                    listRapports.innerHTML =
                        '<li class="list-group-item text-center"><div class="spinner-border"></div> Chargement...</li>';
                    if (paginationContainer) paginationContainer.style.display = 'none';

                    fetch('{{ route('search-rapports-fp') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                date_debut: currentFilters.dateDebut || dateDebut.value,
                                date_fin: currentFilters.dateFin || dateFin.value,
                                user_id: {{ Auth::id() }},
                                page: page
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.success || data.data.length === 0) {
                                listRapports.innerHTML =
                                    '<li class="list-group-item text-center">Aucun rapport trouvé pour cette période</li>';
                                if (paginationContainer) paginationContainer.innerHTML = '';
                                return;
                            }

                            let html = '';
                            data.data.forEach(item => {
                                const dateRapport = new Date(item.date_rapport).toLocaleDateString(
                                'fr-FR', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                const createdAt = new Date(item.created_at).toLocaleDateString('fr-FR', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                html += `
                    <li>
                        <a href="#" class="text-decoration-none">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Rapport du ${dateRapport}</strong><br>
                                    <small class="text-muted">Créé le ${createdAt}</small>
                                </div>
                                <a href="/rapports/gestions_rapports_fp/${item.id}/download" class="text-decoration-none">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="bi bi-download"></i>&nbsp; Télécharger
                                    </span>
                                </a>
                            </div>
                        </a>
                    </li>`;
                            });

                            listRapports.innerHTML = html;

                            // Afficher la pagination
                            if (data.pagination && data.pagination.last_page > 1) {
                                let paginationHtml =
                                    '<nav><ul class="pagination pagination-sm justify-content-center mb-0">';

                                // Bouton Précédent
                                if (data.pagination.current_page > 1) {
                                    paginationHtml +=
                                        `<li class="page-item"><a class="page-link" href="#" data-page="${data.pagination.current_page - 1}">Précédent</a></li>`;
                                } else {
                                    paginationHtml +=
                                        '<li class="page-item disabled"><span class="page-link">Précédent</span></li>';
                                }

                                // Numéros de page
                                for (let i = 1; i <= data.pagination.last_page; i++) {
                                    if (i === data.pagination.current_page) {
                                        paginationHtml +=
                                            `<li class="page-item active"><span class="page-link">${i}</span></li>`;
                                    } else {
                                        paginationHtml +=
                                            `<li class="page-item"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                                    }
                                }

                                // Bouton Suivant
                                if (data.pagination.current_page < data.pagination.last_page) {
                                    paginationHtml +=
                                        `<li class="page-item"><a class="page-link" href="#" data-page="${data.pagination.current_page + 1}">Suivant</a></li>`;
                                } else {
                                    paginationHtml +=
                                        '<li class="page-item disabled"><span class="page-link">Suivant</span></li>';
                                }

                                paginationHtml += '</ul></nav>';

                                if (paginationContainer) {
                                    paginationContainer.innerHTML = paginationHtml;
                                    paginationContainer.style.display = 'block';

                                    // Ajouter les événements de clic sur les liens de pagination
                                    paginationContainer.querySelectorAll('a.page-link').forEach(link => {
                                        link.addEventListener('click', (e) => {
                                            e.preventDefault();
                                            const page = parseInt(e.target.getAttribute(
                                                'data-page'));
                                            currentFilters.currentPage = page;
                                            loadRapports(page);
                                        });
                                    });
                                }
                            } else if (paginationContainer) {
                                paginationContainer.innerHTML = '';
                            }
                        })
                        .catch(err => {
                            console.error('Erreur:', err);
                            listRapports.innerHTML =
                                '<li class="list-group-item text-danger text-center">Erreur lors de la recherche: ' +
                                err.message + '</li>';
                        });
                }

                if (button) {
                    button.addEventListener('click', (e) => {
                        e.preventDefault();

                        const dateDebut = document.getElementById('dateDebut-fps');
                        const dateFin = document.getElementById('dateFin-fps');

                        currentFilters.dateDebut = dateDebut.value;
                        currentFilters.dateFin = dateFin.value;
                        currentFilters.currentPage = 1;

                        loadRapports(1);
                    });
                }
            });
        </script>
    @endpush
@endsection
