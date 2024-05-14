@extends('users.layout.template')

@section('content')
    <section>
        <div class="container pb-5">
            <p class="fs-1 fw-bold text-dark text-center pb-3">Why E-Donation</p>
            <div class="row" data-aos="fade-top">
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4">
                        <div class="card-body text-white text-center">
                            <h1 class="card-title"><i class="bi bi-box2-heart"></i></h1>
                            <p class="h3 fw-bold card-text">Trustworthy</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4">
                        <div class="card-body text-white text-center">
                            <h1 class="card-title"><i class="bi bi-clipboard-heart"></i></h1>
                            <p class="h3 fw-bold card-text">Honest</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-info mb-3 border-0 shadow p-4">
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
                    <div class="col">
                        <div class="card h-100 rounded-0 shadow border-0">
                            <div class="card-body p-4 text-center border-top border-info border-3">
                                <h5 class="card-title fw-bold text-dark pt-3">ESSENTIAL</h5>
                                <p class="card-text">includes essential needs</p>
                                <p class="card-text mt-5">Rp. <strong
                                        class="display-6 fw-bold text-dark">450.000</strong>/packet
                                </p>
                                <p class="fw-bold text-info">+ Free reusable bag</p>
                            </div>
                            <div class="d-grid px-3 pb-3">
                                <button class="btn btn-info text-white">CheckOut</button>
                            </div>
                            <div class="card-footer border-0">
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 rounded-0 shadow border-0">
                            <div class="card-body p-4 text-center border-top border-info border-3">
                                <h5 class="card-title fw-bold text-dark pt-3">STANDARD</h5>
                                <p class="card-text">additional important items</p>
                                <p class="card-text mt-5">Rp. <strong
                                        class="display-6 fw-bold text-dark">670.000</strong>/packet
                                </p>
                                <p class="fw-bold text-info">+ Free hand sanitizer</p>
                            </div>
                            <div class="d-grid px-3 pb-3">
                                <button class="btn btn-info text-white">CheckOut</button>
                            </div>
                            <div class="card-footer border-0">
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 rounded-0 shadow border-0">
                            <div class="card-body p-4 text-center border-top border-info border-3">
                                <h5 class="card-title fw-bold text-dark pt-3">DELUXE</h5>
                                <p class="card-text">various items for wider</p>
                                <p class="card-text mt-5">Rp. <strong
                                        class="display-6 fw-bold text-dark">790.000</strong>/packet
                                </p>
                                <p class="fw-bold text-info">+ Free set of face masks</p>
                            </div>
                            <div class="d-grid px-3 pb-3">
                                <button class="btn btn-info text-white">CheckOut</button>
                            </div>
                            <div class="card-footer border-0">
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 rounded-0 shadow border-0">
                            <div class="card-body p-4 text-center border-top border-info border-3">
                                <h5 class="card-title fw-bold text-dark pt-3">GOLD</h5>
                                <p class="card-text">high-quality and diverse items</p>
                                <p class="card-text mt-5">Rp. <strong
                                        class="display-6 fw-bold text-dark">995.000</strong>/packet
                                </p>
                                <p class="fw-bold text-info">+ Free personal hygiene kit</p>
                            </div>
                            <div class="d-grid px-3 pb-3">
                                <button class="btn btn-info text-white">CheckOut</button>
                            </div>
                            <div class="card-footer border-0">
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
