    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="{{ route('acceuil') }}" class="navbar-brand d-flex align-items-center text-center py-3 px-4 px-lg-5">
            {{-- <img src="{{ asset('img/logos/logo-ofppt-2.png') }}" alt="" style="width: 6rem"> --}}
            <img id="ofppt__logo" src="{{ asset('img/logos/logo-ofppt.png') }}" alt="ofppt">
        </a>

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('acceuil') }}"
                    class="nav-item nav-link  @if ($menu === '1') active @endif">Acceuil</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link @if ($menu === '2') active @endif">Objectifs</a>
                <div class="nav-item  @if ($menu === '31') active @endif dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Inscription</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('inscription') }}" class="dropdown-item">S'inscrire</a>
                        <a href="{{ route('reservationrdv') }}" class="dropdown-item">Prise de RDV</a>
                        <a href="{{ route('invitation') }}" class="dropdown-item">Imprimer invitation</a>
                    </div>
                </div>

                <a href="{{ route('contact') }}"
                    class="nav-item nav-link @if ($menu === '4') active @endif">Contact</a>
            </div>
            @if ($menu !== '0')
                <a href="{{ route('login') }}" id="espaceentr__btn"
                    class="btn btn-primary rounded-0 py-4 col-12 col-lg-4 px-lg-3 d-lg-block">Espace
                    Entreprise<i class="fa fa-arrow-right ms-3"></i></a>
            @endif
        </div>
    </nav>
    <!-- Navbar End -->
