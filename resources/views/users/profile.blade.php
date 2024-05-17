@extends('users.layout.template')

@section('content')
    <section>
        <div style="padding-top: 120px;">
            <div class="container">
                <div class="mb-5" data-aos="fade-down">
                    <p class="fs-2 fw-bold text-center text-dark">{{ ucfirst(auth()->user()->name) }}'s Profile</p>
                    <div class="card border-0 bg-azure shadow-sm">
                        <div class="card-body">
                            <form action="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name"
                                            class="form-label text-dark d-flex justify-content-center">Your
                                            Name</label>
                                        <input type="text" id="name" class="form-control border-info" name="name"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email"
                                            class="form-label text-dark d-flex justify-content-center">Your
                                            Email</label>
                                        <input type="text" id="email" class="form-control border-info" name="email"
                                            value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password"
                                            class="form-label text-dark d-flex justify-content-center">Your
                                            Password</label>
                                        <input type="text" id="password" class="form-control border-info"
                                            name="password">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-info btn-sm mt-3 text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-azure" data-aos="fade">
                <p class="fs-2 fw-bold text-center text-dark pt-3">Your Order</p>
                <div class="container">
                    <div class="bg-dark rounded-5 mb-3 text-center">
                        <div class="row">
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">PRODUCT TYPE</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">QUANTITY</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">TOTAL PRICE</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">SHIPPING STATUS</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="mt-3 ms-3 fw-bold text-white">ACTION</p>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 border-top text-center">
                        <div class="row ">
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3">Standard</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3">3</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3">Rp. 150.000</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3">Hasn't shipped yet</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-3 ms-3">
                                    {{-- <button class="btn btn-info text-white">Create Shipment</button> --}}
                                    <button class="btn btn-info btn-sm text-white">Edit Shipment</button>
                                    <button class="btn btn-info btn-sm text-white">Shipment Detail</button>
                                    <button class="btn btn-info btn-sm text-white">Pay the Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
@endsection
