@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">

                    <div class="card info-card sales-card">
                        <div class="card-body pt-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="rounded-0 shadow-sm">
                                        <div class="border-top border-5 border-info">
                                            <p class="fw-bold p-3 border-bottom">
                                                SENDER</p>
                                        </div>
                                        <div class="d-flex px-3 border-bottom">
                                            <p>Name</p>
                                            <p class="ms-auto">{{ $order->customer_name }}</p>
                                        </div>
                                        <div class="d-flex px-3 pt-3 border-bottom">
                                            <p>Email</p>
                                            <p class="ms-auto">{{ $order->customer_email }}</p>
                                        </div>
                                        <div class="d-flex px-3 pt-3 border-bottom">
                                            <p>Phone</p>
                                            <p class="ms-auto">{{ $order->customer_phone }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if ($order->shipment)
                                    <div class="col-md-6">
                                        <div class="rounded-0 shadow-sm">
                                            <div class="border-top border-5 border-info">
                                                <p class="fw-bold p-3 border-bottom">
                                                    RECIPIENT</p>
                                            </div>
                                            <div class="d-flex px-3 border-bottom">
                                                <p>Place Name</p>
                                                <p class="ms-auto">{{ $order->shipment->place_name }}
                                                </p>
                                            </div>
                                            <div class="d-flex px-3 pt-3 border-bottom">
                                                <p>Province - City - Postal Code</p>
                                                <p class="ms-auto">{{ $order->shipment->province }} -
                                                    {{ $order->shipment->city }}
                                                    - {{ $order->shipment->postal_code }}
                                                </p>
                                            </div>
                                            <div class="d-flex px-3 pt-3 border-bottom">
                                                <p>Address</p>
                                                <p class="ms-auto">{{ $order->shipment->address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="d-grid mt-4">
                                <a href="{{ route('user_orders', $user->id) }}"
                                    class="btn btn-info btn-sm text-white">BACK</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
