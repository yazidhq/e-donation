<section>
    <div class="fixed-top">
        <div class="bg-dark">
            <div class="container py-1">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start gap-3">
                        <p class="text-white mb-0"><i class="bi bi-whatsapp"></i> +62 333 4444 7777</p>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <p class="text-white mb-0"><i class="bi bi-instagram mx-2"></i> e-donation</p>
                        <p class="text-white mb-0"><i class="bi bi-linkedin"></i></i> e-donation</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg shadow-sm bg-azure">
            <div class="container">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid" width="30px">
                <a class="navbar-brand mx-2 fw-bold text-info" href="/">E-DONATION</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav">
                            @if (auth()->check())
                                <li class="nav-item">
                                    <a href="/profile"
                                        class="nav-link fw-bold text-info">{{ Str::upper(auth()->user()->name) }}</a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="nav-link fw-bold text-info">LOGOUT</button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link fw-bold text-info" href="/login">LOGIN</a>
                                </li>
                            @endif
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
    </div>
</section>
