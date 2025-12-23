
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="background-color: #ffffff !important;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/auxfin.png') }}" alt="Auxfin" width="100" height="50">
        </a>
        <!-- Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#" style="font-weight: bold;">ITEM 1</a></li>
                <li class="nav-item"><a class="nav-link" href="#" style="font-weight: bold;">ITEM 2</a></li>
                <li class="nav-item"><a class="nav-link" href="#" style="font-weight: bold;">ITEM 3</a></li>
            </ul>

            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="font-weight: bold;">
                            <i data-feather="user"></i> &nbsp;&nbsp; Mon Compte
                        </a>
                    </li>
                @endguest
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            style="font-weight: bold;">
                            {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
