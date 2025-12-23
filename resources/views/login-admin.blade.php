<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin auth</title>

    @include('layouts.login_style')
</head>

<body>
    <div class="login-container">
        <form class="login-card" action="{{ route('login_admin') }}" method="POST">
            @csrf
            <h4 class="text-dark fw-bold text-center mb-3">AUTHENTIFICATION</h4>
            <div class="mt-4 text-center">
                <img src="{{ asset('images/auxfin.png') }}" alt="logo auxfin"
                    style="width: 50%; margin-left: auto; margin-right: auto;">
            </div>
            <!-- Language Selection -->
            <div class="input-group mb-3 mt-5">
                <span class="input-group-text"><i class="bi bi-translate"></i></span>
                <select class="form-select">
                    <option>English</option>
                    <option>Français</option>
                    <option>العربية</option>
                </select>
            </div>
            <!-- Username -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" name="umva_id" placeholder="umva id">
            </div>
            <!-- Password -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-key"></i></span>
                <input type="password" class="form-control" name="password" id="passwordInput"
                    placeholder="Mot de passe">
                <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </span>
            </div>
            <!-- Role -->
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <select class="form-select" name="role_id" >
                    <option value="" disabled selected>Choisir un rôle</option>
                    @foreach (App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}">{{ $role->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="login-button">
                →
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const eye = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.remove('bi-eye');
                eye.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                eye.classList.remove('bi-eye-slash');
                eye.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
