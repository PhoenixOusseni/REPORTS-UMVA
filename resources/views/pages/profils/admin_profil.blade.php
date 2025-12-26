@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>BIENVENUE {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item">Mon profil</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rapports des groupes G50</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex"
                                    style="background-color: #c8cdd259; padding: 10px; border-radius: 5px;">
                                    <input type="date" class="form-control filter-date-start" id="dateDebut-groupes"
                                        data-table="groupes-table" placeholder="Date début">
                                    <input type="date" class="form-control filter-date-end ms-2" id="dateFin-groupes"
                                        data-table="groupes-table" placeholder="Date fin">
                                    <button type="button" class="btn btn-primary ms-2 w-100 btn-filter"
                                        data-table="groupes-table">
                                        <i class="bi bi-search"></i> Rechercher
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="groupes-table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date du Rapport</th>
                                    <th>Créé le</th>
                                    <th>Groupe</th>
                                    <th>Télécharger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rapports as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                        <td>{{ $item->groupe->nom }}</td>
                                        <td>
                                            <a href="{{ route('gestions_rapports_groupes.download', $item->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Aucun rapport disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rapports des KAs</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex" style="background-color: #c8cdd259; padding: 10px; border-radius: 5px;">
                                    <input type="date" class="form-control filter-date-start" id="dateDebut-kas"
                                        data-table="kas-table" placeholder="Date début">
                                    <input type="date" class="form-control filter-date-end ms-2" id="dateFin-kas"
                                        data-table="kas-table" placeholder="Date fin">
                                    <button type="button" class="btn btn-primary ms-2 w-100 btn-filter"
                                        data-table="kas-table">
                                        <i class="bi bi-search"></i> Rechercher
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="kas-table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date du Rapport</th>
                                    <th>Créé le</th>
                                    <th>Kas</th>
                                    <th>Télécharger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rapportsKa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                        <td>{{ $item->user->nom }} {{ $item->user->prenom }}</td>
                                        <td>
                                            <a href="{{ route('gestions_rapports_groupes.download', $item->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Aucun rapport disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rapports des MAs</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex" style="background-color: #c8cdd259; padding: 10px; border-radius: 5px;">
                                    <input type="date" class="form-control filter-date-start" id="dateDebut-mas"
                                        data-table="mas-table" placeholder="Date début">
                                    <input type="date" class="form-control filter-date-end ms-2" id="dateFin-mas"
                                        data-table="mas-table" placeholder="Date fin">
                                    <button type="button" class="btn btn-primary ms-2 w-100 btn-filter"
                                        data-table="mas-table">
                                        <i class="bi bi-search"></i> Rechercher
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="mas-table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date du Rapport</th>
                                    <th>Créé le</th>
                                    <th>Mas</th>
                                    <th>Télécharger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rapportsMa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                        <td>{{ $item->user->nom }} {{ $item->user->prenom }}</td>
                                        <td>
                                            <a href="{{ route('gestions_rapports_groupes.download', $item->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Aucun rapport disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Rapports des FPs</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex"
                                        style="background-color: #c8cdd259; padding: 10px; border-radius: 5px;">
                                        <input type="date" class="form-control filter-date-start"
                                            id="dateDebut-fps" data-table="fps-table" placeholder="Date début">
                                        <input type="date" class="form-control filter-date-end ms-2"
                                            id="dateFin-fps" data-table="fps-table" placeholder="Date fin">
                                        <button type="button" class="btn btn-primary ms-2 w-100 btn-filter"
                                            data-table="fps-table">
                                            <i class="bi bi-search"></i> Rechercher
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="fps-table">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date du Rapport</th>
                                    <th>Créé le</th>
                                    <th>FPs</th>
                                    <th>Télécharger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rapportsFp as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date_rapport)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                        <td>{{ $item->user->nom }} {{ $item->user->prenom }}</td>
                                        <td>
                                            <a href="{{ route('gestions_rapports_groupes.download', $item->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Aucun rapport disponible.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser DataTable pour chaque table
        new simpleDatatables.DataTable(document.getElementById('groupes-table'));
        new simpleDatatables.DataTable(document.getElementById('kas-table'));
        new simpleDatatables.DataTable(document.getElementById('mas-table'));
        new simpleDatatables.DataTable(document.getElementById('fps-table'));

        // Configuration des routes de recherche
        const searchRoutes = {
            'groupes-table': '{{ route("search-rapports-groupes", $user->id) }}',
            'kas-table': '{{ route("search-rapports-ka") }}',
            'mas-table': '{{ route("search-rapports-ma") }}',
            'fps-table': '{{ route("search-rapports-fp") }}'
        };

        // Fonction pour formater la date au format d F Y
        function formatDate(dateStr) {
            const months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            const date = new Date(dateStr);
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            return `${day} ${month} ${year}`;
        }

        // Fonction pour générer la route de téléchargement appropriée
        function getDownloadRoute(item, tableId) {
            // Construire les URLs de téléchargement en fonction du type de table
            if (tableId === 'groupes-table') {
                return `/rapports/gestions_rapports_groupes/${item.id}/download`;
            } else if (tableId === 'kas-table') {
                return `/rapports/gestions_rapports_ka/${item.id}/download`;
            } else if (tableId === 'mas-table') {
                return `/rapports/gestions_rapports_ma/${item.id}/download`;
            } else if (tableId === 'fps-table') {
                return `/rapports/gestions_rapports_fp/${item.id}/download`;
            }
            return '#';
        }

        // Ajouter les événements de clic sur les boutons de filtre
        document.querySelectorAll('.btn-filter').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const tableId = this.getAttribute('data-table');
                const dateDebut = document.getElementById('dateDebut-' + tableId.replace('-table', '')).value;
                const dateFin = document.getElementById('dateFin-' + tableId.replace('-table', '')).value;
                const table = document.getElementById(tableId);

                // Afficher un message de chargement
                const tbody = table.querySelector('tbody');
                tbody.innerHTML = '<tr><td colspan="5" class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Chargement...</span></div></td></tr>';

                // Appel AJAX
                fetch(searchRoutes[tableId], {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        date_debut: dateDebut,
                        date_fin: dateFin
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let html = '';
                        if (data.data.length === 0) {
                            html = '<tr><td colspan="5" class="text-center">Aucun rapport disponible.</td></tr>';
                        } else {
                            data.data.forEach((item, index) => {
                                const downloadUrl = getDownloadRoute(item, tableId);
                                const displayName = item.groupe ? item.groupe.nom : (item.user ? item.user.nom + ' ' + item.user.prenom : '-');
                                html += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${formatDate(item.date_rapport)}</td>
                                        <td>${formatDate(item.created_at)}</td>
                                        <td>${displayName}</td>
                                        <td>
                                            <a href="${downloadUrl}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-download"></i>&nbsp; Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                `;
                            });
                        }
                        tbody.innerHTML = html;
                    } else {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Erreur lors de la recherche.</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Erreur lors de la recherche.</td></tr>';
                });
            });
        });

        // Ajouter le raccourci Entrée sur les champs de date
        document.querySelectorAll('.filter-date-start, .filter-date-end').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const tableId = this.getAttribute('data-table');
                    document.querySelector('.btn-filter[data-table="' + tableId + '"]').click();
                }
            });
        });
    });
</script>
@endpush
@endsection
