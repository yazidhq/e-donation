<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center
    justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" class="img-fluid">
            <span class="d-none d-lg-block fw-bold text-info fs-5">E-DONATION</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span
                        class="d-none d-md-block dropdown-toggle text-dark">{{ Str::ucfirst(auth()->user()->name) }}</span>
                    <img src="{{ asset('img/logo.png') }}" alt="Profile" class="rounded-circle ps-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Str::upper(auth()->user()->name) }}</h6>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>

</header>
