@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">

                    <div class="card info-card sales-card">
                        <div class="card-body pt-3">
                            @if ($order->is_created_shipment)
                                <form
                                    action="{{ route('update_user_order', ['userId' => $user->id, 'orderId' => $order->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="fw-bold fs-5">CUSTOMER ORDER</p>
                                            <hr>
                                            <label class="form-label">Customer Name</label>
                                            <input type="text" class="form-control" name="customer_name"
                                                value="{{ $order->customer_name }}">
                                            <br>
                                            <label class="form-label">Customer Email</label>
                                            <input type="text" class="form-control" name="customer_email"
                                                value="{{ $order->customer_email }}">
                                            <br>
                                            <label class="form-label">Customer Phone</label>
                                            <input type="text" class="form-control" name="customer_phone"
                                                value="{{ $order->customer_phone }}">
                                        </div>
                                        <div class="col-md-6">
                                            <p class="fw-bold fs-5">SHIPMENT</p>
                                            <hr>
                                            <label class="form-label">Place Name</label>
                                            <input type="text" class="form-control" name="place_name"
                                                value="{{ $order->shipment->place_name }}">
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        value="{{ $order->shipment->city }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Province</label>
                                                    <input type="text" class="form-control" name="province"
                                                        value="{{ $order->shipment->province }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" class="form-control" name="postal_code"
                                                        value="{{ $order->shipment->postal_code }}">
                                                </div>
                                            </div>
                                            <br>
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $order->shipment->address }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-info btn-sm text-white">Update</button>
                                    </div>
                                </form>
                            @else
                                <h1 class="text-center mt-3">This order hasn't created a shipment yet</h1>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
