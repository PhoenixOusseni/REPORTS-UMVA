<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="icon" href="{{ asset('images/auxfin.png') }}" type="image/x-icon">

<style>
    /* Option A — "Warm multi-stop" : doux dégradé chaud à plusieurs arrêts + léger halo */
    :root {
        --g1: #ff7a59;
        /* corail */
        --g2: #ff9a76;
        /* pêche */
        --g3: #ffc46b;
        /* doré */
        --g4: #ffd98f;
        /* clair */
        --accent: rgba(255, 255, 255, 0.06);
    }

    body,
    html {
        height: 100%;
        margin: 0;
        background-size: cover;
        background-position: center;
        font-family: 'Segoe UI', sans-serif;
        background-image:
            radial-gradient(circle at 15% 15%, var(--accent), transparent 18%),
            linear-gradient(135deg,
                var(--g1) 18%,
                #ff8f61 18%,
                var(--g2) 38%,
                var(--g3) 80%,
                var(--g4) 5%);
    }

    .login-container {
        min-height: 100vh !important;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 2rem;
    }

    .login-card {
        background: white;
        border-radius: 5px;
        padding: 2rem;
        width: 100%;
        height: 80vh;
        max-width: 350px;
        position: relative;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .login-button {
        position: absolute;
        right: -25px;
        bottom: 20px;
        border: none;
        border-radius: 50%;
        width: 65px;
        height: 65px;
        display: flex;
        justify-content: center;
        align-items: center;

        background: linear-gradient(90deg, #ff9966 0%, #ffcc66 100%);
        border: none;
        font-weight: 700px;
        box-shadow: 0 4px 14px rgba(255, 153, 102, 0.11);
    }

    .login-button:hover {
        background: linear-gradient(90deg, #ffcc66 0%, #ff9966 100%);
    }

    .input-group-text {
        background: #fff8f1;
        color: #ff9966;
        border: none;
        font-size: 1.1rem;
    }

    .input-group .form-control {
        background: #f4f8ff;
    }

    .card-login .input-group {
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .login-container {
            justify-content: center;
            padding: 1rem;
        }

        .login-button {
            position: static;
            margin-top: 1.5rem;
            width: 100%;
            border-radius: 8px;
            font-size: 1rem;
            height: 45px;
        }
    }
</style>
