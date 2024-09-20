<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <img src="{{ url('frontend/assets/img/logo.png') }}" alt="">
            <h1 class="sitename">RCS Angola</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#services">Funcionalidades</a></li>
                <li><a href="#pricing">Planos e Preços</a></li>
                <li><a href="#testimonials">Depoimentos</a></li>
                <li><a href="#contact">Contacto</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ route('login') }}">Aceder</a>

    </div>
</header>
