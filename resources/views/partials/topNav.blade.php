<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-bottom: 1px solid #e9ecef;">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/auxfin.png') }}" alt="Auxfin" width="100" height="50" class="me-3">
        </a>

        <!-- Menu Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu items center -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="font-weight: 600; color: #333; transition: all 0.3s;">
                        REPORT UMVA
                    </a>
                </li>
            </ul>

            <!-- User Section -->
            <ul class="navbar-nav align-items-center">
                @guest
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm" href="{{ route('login') }}" style="font-weight: 600; border-radius: 20px; border: 2px solid #667eea; color: #667eea;">
                            <i data-feather="user" style="width: 18px; height: 18px;"></i> Mon Compte
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" style="font-weight: 600; color: #333;">
                            <div class="avatar me-2" style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                                {{ substr(Auth::user()->nom, 0, 1) }}{{ substr(Auth::user()->prenom, 0, 1) }}
                            </div>
                            <span>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 10px; box-shadow: 0 5px 25px rgba(0,0,0,0.15); border: none;">
                            <li>
                                <h6 class="dropdown-header" style="color: #667eea; font-weight: 600;">
                                    <i data-feather="user" style="width: 16px; height: 16px;"></i> {{ Auth::user()->umva_id }}
                                </h6>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @if (Auth::user()->role_id == 1)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin_profile', ['id' => Auth::user()->id]) }}" style="padding: 10px 20px;">
                                        <i data-feather="grid" style="width: 16px; height: 16px; margin-right: 8px;"></i> Admin Dashboard
                                    </a>
                                </li>
                            @elseif (Auth::user()->role_id == 2)
                                <li>
                                    <a class="dropdown-item" href="{{ route('ka_profile', ['id' => Auth::user()->id]) }}" style="padding: 10px 20px;">
                                        <i data-feather="user-check" style="width: 16px; height: 16px; margin-right: 8px;"></i> Mon Profil
                                    </a>
                                </li>
                            @elseif (Auth::user()->role_id == 3)
                                <li>
                                    <a class="dropdown-item" href="{{ route('ma_profile', ['id' => Auth::user()->id]) }}" style="padding: 10px 20px;">
                                        <i data-feather="user-check" style="width: 16px; height: 16px; margin-right: 8px;"></i> Mon Profil
                                    </a>
                                </li>
                            @elseif (Auth::user()->role_id == 4)
                                <li>
                                    <a class="dropdown-item" href="{{ route('fp_profile', ['id' => Auth::user()->id]) }}" style="padding: 10px 20px;">
                                        <i data-feather="user-check" style="width: 16px; height: 16px; margin-right: 8px;"></i> Mon Profil
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="padding: 10px 20px; color: #dc3545;">
                                        <i data-feather="log-out" style="width: 16px; height: 16px; margin-right: 8px;"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-nav .nav-link:hover {
        color: #667eea !important;
    }

    .dropdown-item:hover {
        background-color: #f0f2f5;
        color: #667eea;
    }
</style>
