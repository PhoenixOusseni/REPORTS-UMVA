@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Détails du KA</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_ma') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Détails KA</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('dashboard_ma') }}" class="btn btn-secondary">
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

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Filtres de recherche</h5>
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
                                                <a href="{{ route('gestions_rapports_ka.download', $item->id) }}" class="btn btn-primary btn-sm">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.btn-filter[data-table="kas-table"]');
    
    if (button) {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const dateDebut = document.getElementById('dateDebut-kas');
            const dateFin = document.getElementById('dateFin-kas');
            const listGroup = document.querySelector('.list-group');
            
            if (!dateDebut || !dateFin) {
                alert('Erreur: Champs de date non trouvés!');
                return;
            }

            listGroup.innerHTML = '<li class="list-group-item text-center"><div class="spinner-border"></div> Chargement...</li>';

            fetch('{{ route("search-rapports-ka") }}', {
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
                    
                    html += `
                        <li>
                            <a href="#" class="text-decoration-none">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Rapport du ${dateRapport}</strong><br>
                                        <small class="text-muted">Créé le ${createdAt}</small>
                                    </div>
                                    <div>
                                        <a href="/rapports/gestions_rapports_ka/${item.id}/download" class="btn btn-primary btn-sm">
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
