@extends('layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h2 class="mb-1">Tous les utilisateurs</h2>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
                    </ol>
                </nav>
            </div>
            <div>
                <span class="badge bg-primary fs-6">Total: {{ $users->total() }}</span>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                <div>Liste des utilisateurs et total des rapports uploadés</div>
                <form action="{{ route('gestions_utilisateurs.search') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="umva_id" class="form-control form-control-sm" 
                           placeholder="UMVA ID" value="{{ request('umva_id') }}" style="width: 130px;">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('gestions_utilisateurs.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>UMVA ID</th>
                                <th>Nom et Prénoms</th>
                                <th>Sexe</th>
                                <th>Role</th>
                                <th>Superviseur</th>
                                <th>Total rapports</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                @php
                                    $totalRapports =
                                        $item->rapports_groupe_count +
                                        $item->rapports_ka_count +
                                        $item->rapports_ma_count +
                                        $item->rapports_fp_count;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $item->umva_id }}</td>
                                    <td>{{ $item->nom }} {{ $item->prenom }}</td>
                                    <td>{{ $item->sexe ?? '-' }}</td>
                                    <td>{{ $item->role->libelle ?? '-' }}</td>
                                    <td>
                                        @if ($item->supervisor)
                                            {{ $item->supervisor->nom }} {{ $item->supervisor->prenom }}
                                           <br> ({{ $item->supervisor->umva_id }})
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $totalRapports }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @if ($item->role_id == 2)
                                                <a href="{{ route('gestions_utilisateurs.show_ka', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Rapports
                                                </a>
                                                
                                            @elseif ($item->role_id == 3)
                                                <a href="{{ route('gestions_utilisateurs.show_ma', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Rapports
                                                </a>
                                                
                                            @elseif ($item->role_id == 4)
                                                <a href="{{ route('gestions_utilisateurs.show_fp', $item->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Rapports
                                                </a>
                                            @endif

                                            @if ($item->id !== Auth::id())
                                                <form action="{{ route('gestions_utilisateurs.destroy', $item->id) }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('Etes-vous sur de vouloir supprimer cet utilisateur ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Aucun utilisateur trouve.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
