<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ADMIN - AUXFIN</title>
    <!-- Bootstrap 5 CSS -->
    @include('partials.style')
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh !important;
            min-height: 100vh !important;
            background-color: #ffffff !important;
            /* blanc */
        }

        .content {
            margin-left: 150px !important;
            margin-right: 150px !important;
            min-height: 100vh !important;
        }

        .top-bar {
            background: linear-gradient(40deg, #71f1d1, #026919);
            color: #fff;
            font-weight: bold;
            padding: 5px 0;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
        }

        .page-title {
            text-align: center;
            margin: 30px 0;
            font-weight: bold;
            font-size: 1.0rem;
        }

        .page-title::after {
            content: "";
            display: block;
            width: 100px;
            height: 2px;
            background: #f09103;
            margin: 10px auto 0;
        }

        ul li {
            list-style: none;
            font-size: 13px;
            font-weight: bold;
            margin-right: 20px;
        }

        .text-justify {
            text-align: justify !important;
        }

        /* Quand l'écran est petit (ex: < 768px), marges réduites */
        @media (max-width: 768px) {
            .content {
                margin-left: 20px !important;
                margin-right: 20px !important;
            }
        }
    </style>
    @include('layouts.login_style')

</head>

<body>
    @include('partials.topNav')

    <!-- Contenu principal -->
    <div class="content mx-5 mx-sm-5 mx-md-5 mx-lg-5 mx-xl-5 mx-xxl-5">
        @if (session('success') || session('error'))
            <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
                <div class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                    role="alert" aria-live="assertive" aria-atomic="true" id="statusToast" data-bs-delay="5000">
                    <div class="d-flex">
                        <div class="toast-body">
                            @if (session('success'))
                                <div class="text-center">
                                    <h3 class="mb-2 text-white">Succès !</h3>
                                    <h5 class="mt-3 text-white">{{ session('success') }}</h5>
                                </div>
                            @else
                                <div class="text-center">
                                    <h3 class="mb-2 text-white">Erreur !</h3>
                                    <h5 class="mt-3 text-white">{{ session('error') }}</h5>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')

    </div>

    <!-- FOOTER -->
    <footer class="text-center">
        <p>Copyright © {{ date('Y') }} <span class="highlight">AUXFIN BURKINA</span>Tous droits réservés.</p>
        <p>Tel : +226 61346554 | Mail : ousseni.ouedraogo@auxfin.com</p>
        <p>Tel : +226 04541987 | Mail : messifa.nayodah@auxfin.com</p>
    </footer>

    <!-- Bootstrap JS -->
    @include('partials.script')

    @stack('scripts')

    <script>
        // Initialiser et afficher le toast automatiquement
        document.addEventListener('DOMContentLoaded', function() {
            const toastElement = document.getElementById('statusToast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement, {
                    autohide: true,
                    delay: 5000
                });
                toast.show();
            }
        });
    </script>
</body>

</html>
