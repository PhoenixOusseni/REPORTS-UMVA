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
                        <h5>{{ $findGroupe->nom ?? 'Nom du Groupe' }}</h5>
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#GroupeDetailBackdrop">
                            <i class="bi bi-plus-lg"></i>&nbsp; Charger un nouveau rapport
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="GroupeDetailBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="GroupeDetailBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="GroupeDetailBackdropLabel">Charger nouveau rapport</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('gestions_rapports_groupes.store') }}"
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
                                        <input class="form-control" name="date_rapport" type="date" id="dateRapport"
                                            required>
                                    </div>

                                    <input type="text" name="groupe_id" value="{{ $findGroupe->id }}" hidden>

                                    <hr class="mt-5">

                                    <div class="mx-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-upload"></i>&nbsp; Charger le rapport
                                        </button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">
                                            <i class="bi bi-x-lg"></i>&nbsp; Fermer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Filtres de recherche</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex" style="background-color: #c8cdd259; padding: 10px; border-radius: 5px;">
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
                                            <span>{{ $item->groupe->nom }}</span>
                                            <div>
                                                <a href="{{ route('gestions_rapports_groupes.download', $item->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-download"></i> Télécharger
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <div class="list-group-item">
                                        <em>Aucun rapport disponible pour ce groupe.</em>
                                    </div>
                                </li>
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
    const button = document.querySelector('.btn-filter[data-table="groupes-table"]');
    
    if (button) {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const dateDebut = document.getElementById('dateDebut-groupes');
            const dateFin = document.getElementById('dateFin-groupes');
            const listGroup = document.querySelector('.list-group');
            
            if (!dateDebut || !dateFin) {
                alert('Erreur: Champs de date non trouvés!');
                return;
            }

            listGroup.innerHTML = '<li class="list-group-item text-center"><div class="spinner-border"></div> Chargement...</li>';

            fetch('{{ route("search-rapports-groupes", $findGroupe->id) }}', {
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
            .then(res => res.json())
            .then(data => {
                if (!data.success || data.data.length === 0) {
                    listGroup.innerHTML = '<li class="list-group-item text-center">Aucun rapport trouvé pour cette période</li>';
                    return;
                }

                let html = '';
                data.data.forEach(item => {
                    const dateRapport = new Date(item.date_rapport).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' });
                    const createdAt = new Date(item.created_at).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' });
                    const groupeNom = item.groupe ? item.groupe.nom : '';
                    
                    html += `
                        <li>
                            <a href="#" class="text-decoration-none">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Rapport du ${dateRapport}</strong><br>
                                        <small class="text-muted">Créé le ${createdAt}</small>
                                    </div>
                                    <span>${groupeNom}</span>
                                    <div>
                                        <a href="/rapports/gestions_rapports_groupes/${item.id}/download" class="btn btn-primary btn-sm">
                                            <i class="bi bi-download"></i> Télécharger
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </li>`;
                });

                listGroup.innerHTML = html;
            })
            .catch(err => {
                console.error('Erreur:', err);
                listGroup.innerHTML = '<li class="list-group-item text-danger text-center">Erreur lors de la recherche: ' + err.message + '</li>';
            });
        });
    }
});
</script>
@endpush
@endsection
