@extends('users.layout.template')

@section('content')
    <section>
        <div class="container pb-5">
            <p class="fs-1 fw-bold text-dark text-center pb-3">Why E-Donation</p>
            <div class="row" data-aos="fade-top">
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4 card-pop">
                        <div class="card-body text-white text-center">
                            <h1 class="card-title"><i class="bi bi-box2-heart"></i></h1>
                            <p class="h3 fw-bold card-text">Trustworthy</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4 card-pop">
                        <div class="card-body text-white text-center">
                            <h1 class="card-title"><i class="bi bi-clipboard-heart"></i></h1>
                            <p class="h3 fw-bold card-text">Honest</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4 card-pop">
                        <div class="card-body text-white text-center">
                            <h1 class="card-title"><i class="bi bi-person-hearts"></i></h1>
                            <p class="h3 fw-bold card-text">Integrity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-azure py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('img/about.png') }}" class="img-fluid">
                    </div>
                    <div class="col-md-8 mt-5" data-aos="fade-right">
                        <p class="fs-1 fw-bold text-dark">About Us</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, quibusdam nam!
                            Placeat,
                            nisi,
                            consequuntur accusantium hic iusto ad nulla nostrum perspiciatis repudiandae dicta quia,
                            in
                            qui
                            sunt
                            vero fugit veniam incidunt quis iste officiis pariatur itaque voluptatem commodi vel!
                            Quos
                            officiis
                            excepturi minima at dolore, consequuntur architecto atque placeat reiciendis?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="py-5">
            <div class="container">
                <p class="fs-1 fw-bold text-dark text-center pb-3">Products</p>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($products as $item)
                        <div class="col">
                            <div class="card h-100 rounded-0 shadow border-0 card-pop">
                                <div class="card-body p-4 text-center border-top border-info border-3">
                                    <h5 class="card-title fw-bold text-dark pt-3">{{ Str::upper($item->name) }}</h5>
                                    <p class="card-text">{{ $item->description }}</p>
                                    <p class="card-text mt-5">Rp. <strong
                                            class="display-6 fw-bold text-dark">{{ number_format($item->price, 0, ',', '.') }}</strong>/packet
                                    </p>
                                    <p class="fw-bold text-info">+ {{ ucfirst($item->free) }}</p>
                                </div>
                                <div class="d-grid px-3 pb-3">
                                    <button class="btn btn-info text-white">Check Out</button>
                                </div>
                                <div class="card-footer border-0">
                                    <small class="text-body-secondary"></small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
