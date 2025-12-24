@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Profil MA</h4>
                </div>
                <div class="card-body">
                    <!-- Informations du profil -->
                    <div class="mb-4">
                        <h5 class="card-title">Informations Personnelles</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Identifiant UMVA:</strong></label>
                                <p class="form-control-plaintext">{{ auth()->user()->umva_id }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Rôle:</strong></label>
                                <p class="form-control-plaintext">{{ auth()->user()->role->libelle ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Nom:</strong></label>
                                <p class="form-control-plaintext">{{ auth()->user()->nom }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Prénom:</strong></label>
                                <p class="form-control-plaintext">{{ auth()->user()->prenom }}</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Formulaire de changement de mot de passe -->
                    <div class="mt-4">
                        <h5 class="card-title">Changer le Mot de Passe</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('profile.update-password', auth()->user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                       id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-edit"></i>&nbsp; Mettre à jour le mot de passe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
