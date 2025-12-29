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
                                    <input type="date"
                                        id="dateDebut-groupes"
                                        class="form-control filter-date-start"
                                        data-table="groupes-table">
                                    <input type="date"
                                        id="dateFin-groupes"
                                        class="form-control filter-date-end ms-2"
                                        data-table="groupes-table">
                                    <button type="button"
                                            class="btn btn-primary ms-2 w-100 btn-filter"
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
console.log('Script chargé !');

document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM chargé !');
    
    // NE PAS initialiser DataTables pour permettre le filtrage dynamique
    
    const searchRoutes = {
        'groupes-table': '{{ route("search-rapports-groupes", Auth::id()) }}',
        'kas-table': '{{ route("search-rapports-ka") }}',
        'mas-table': '{{ route("search-rapports-ma") }}',
        'fps-table': '{{ route("search-rapports-fp") }}'
    };

    console.log('Routes configurées:', searchRoutes);

    // Vérifier que les boutons existent
    const buttons = document.querySelectorAll('.btn-filter');
    console.log('Boutons trouvés:', buttons.length);

    // Fonction pour formater la date
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('fr-FR', options);
    }

    // Fonction pour obtenir le nom d'affichage
    function getDisplayName(item, tableId) {
        if (tableId === 'groupes-table') {
            return item.groupe ? item.groupe.nom : '-';
        } else {
            return item.user ? `${item.user.nom} ${item.user.prenom}` : '-';
        }
    }

    // Fonction pour obtenir l'URL de téléchargement
    function getDownloadUrl(item, tableId) {
        const routes = {
            'groupes-table': `/rapports/gestions_rapports_groupes/${item.id}/download`,
            'kas-table': `/rapports/gestions_rapports_ka/${item.id}/download`,
            'mas-table': `/rapports/gestions_rapports_ma/${item.id}/download`,
            'fps-table': `/rapports/gestions_rapports_fp/${item.id}/download`
        };
        return routes[tableId] || '#';
    }

    document.querySelectorAll('.btn-filter').forEach(button => {
        console.log('Ajout listener sur bouton:', button.dataset.table);
        
        button.addEventListener('click', (e) => {
            e.preventDefault();
            console.log('Bouton cliqué !');
            
            const tableId = button.dataset.table;
            console.log('Table ID:', tableId);
            
            // Obtenir le suffixe correct: groupes, kas, mas, fps
            const suffix = tableId.replace('-table', '');
            console.log('Suffix:', suffix);
            
            const dateDebut = document.getElementById(`dateDebut-${suffix}`);
            const dateFin = document.getElementById(`dateFin-${suffix}`);
            
            console.log('Elements trouvés:', dateDebut, dateFin);
            
            if (!dateDebut || !dateFin) {
                console.error('Champs de date non trouvés:', `dateDebut-${suffix}`, `dateFin-${suffix}`);
                alert('Erreur: Champs de date non trouvés!');
                return;
            }

            const tbody = document.querySelector(`#${tableId} tbody`);
            console.log('Tbody trouvé:', tbody);
            
            console.log('Valeurs:', dateDebut.value, dateFin.value);

            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="spinner-border"></div> Chargement...
                    </td>
                </tr>`;

            fetch(searchRoutes[tableId], {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    date_debut: dateDebut.value,
                    date_fin: dateFin.value
                })
            })
            .then(res => {
                console.log('Réponse reçue, status:', res.status);
                return res.json();
            })
            .then(data => {
                console.log('Données reçues:', data);
                
                if (!data.success || data.data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center">
                                Aucun rapport trouvé pour cette période
                            </td>
                        </tr>`;
                    return;
                }

                let html = '';
                data.data.forEach((item, index) => {
                    const displayName = getDisplayName(item, tableId);
                    const downloadUrl = getDownloadUrl(item, tableId);
                    
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${formatDate(item.date_rapport)}</td>
                            <td>${formatDate(item.created_at)}</td>
                            <td>${displayName}</td>
                            <td>
                                <a href="${downloadUrl}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-download"></i> Télécharger
                                </a>
                            </td>
                        </tr>`;
                });

                tbody.innerHTML = html;
            })
            .catch(err => {
                console.error('Erreur complète:', err);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-danger text-center">
                            Erreur lors de la recherche: ${err.message}
                        </td>
                    </tr>`;
            });
        });
    });
});
</script>

@endpush
@endsection
