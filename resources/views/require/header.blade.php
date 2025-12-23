<header class="page-header page-header-dark pb-10"
    style="background: linear-gradient(90deg, rgb(124, 243, 227) 0%, rgb(79, 168, 106) 50%, rgb(3, 112, 58) 100%);">
    <div class="container-xl px-3">
        <div class="page-header-content pt-3"></div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
</header>
