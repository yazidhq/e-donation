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
                                        <label for="name"
                                            class="form-label text-dark d-flex justify-content-center">Your
                                            Name</label>
                                        <input type="text" id="name" class="form-control border-info" name="name"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name"
                                            class="form-label text-dark d-flex justify-content-center">Your
                                            Name</label>
                                        <input type="text" id="name" class="form-control border-info" name="name"
                                            value="{{ auth()->user()->name }}">
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
                <div class="container py-3">
                    <p class="fs-2 fw-bold text-center text-dark">Your Order</p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-dark">Product Type</th>
                                <th scope="col" class="text-dark">Quantity</th>
                                <th scope="col" class="text-dark">Total Price</th>
                                <th scope="col" class="text-dark">Shipping Status</th>
                                <th scope="col" class="text-dark">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Standard</td>
                                <td>3</td>
                                <td>Rp. 40.000</td>
                                <td>Hasn't shipped yet</td>
                                <td>
                                    {{-- <button class="btn btn-info text-white">Create Shipment</button> --}}
                                    <button class="btn btn-warning btn-sm text-white">Edit Shipment</button>
                                    <button class="btn btn-primary btn-sm text-white">Shipment Detail</button>
                                    <button class="btn btn-success btn-sm text-white">Pay the Order</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
