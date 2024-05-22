@extends('users.layout.template')

@section('content')
    @include('users.components.500_error')

    <section>
        <div style="padding-top: 120px;">
            <div class="container">
                <div class="mb-5" data-aos="fade-down">
                    <p class="fs-2 fw-bold text-center text-dark">{{ ucfirst(auth()->user()->name) }}'s Profile</p>
                    <div class="card border-0 bg-azure shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('update_profile', auth()->user()->id) }}" method="POST">
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
                                        <input type="password" id="password" class="form-control border-info"
                                            name="password">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-info btn-sm mt-3 text-white">Update</button>
                                </div>
                            </form>
                        </div>
                        @if (session('profile'))
                            <div class="alert alert-sm alert-info mx-3">
                                {{ session('profile') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-azure" data-aos="fade">
                <p class="fs-2 fw-bold text-center text-dark pt-3">Your Order</p>
                <div class="container">
                    @if (session('order'))
                        <div class="alert alert-sm alert-info mx-3">
                            {{ session('order') }}
                        </div>
                    @endif
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
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">SHIPMENT</p>
                            </div>
                            <div class="col-sm-2">
                                <p class="mt-3 ms-3 fw-bold text-white">ORDER</p>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 border-top text-center">
                        @foreach ($orders as $item)
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="mt-3 ms-3 fw-bold text-dark">{{ Str::upper($item->product->name) }}</p>
                                </div>
                                <div class="col-sm-2">
                                    <div class="row mt-3">
                                        <div class="col-4">
                                            @if ($item->transaction->status == 'pending')
                                                <form action="{{ route('subtract_quantity', $item->id) }}" method="POST">
                                                    @csrf
                                                    <input hidden type="text" name="amount" value="1">
                                                    <button type="submit"
                                                        class="btn btn-info btn-sm rounded-circle text-white">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <p class="ms-2">{{ $item->amount }}</p>
                                        </div>
                                        <div class="col-4">
                                            @if ($item->transaction->status == 'pending')
                                                <form action="{{ route('add_quantity', $item->id) }}" method="POST">
                                                    @csrf
                                                    <input hidden type="text" name="amount" value="1">
                                                    <button type="submit"
                                                        class="btn btn-info btn-sm rounded-circle text-white">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <p class="mt-3 ms-3">IDR
                                        {{ number_format($item->product->price * $item->amount, '0', ',', '.') }},00</p>
                                </div>
                                <div class="col-sm-2">
                                    @if (!$item->is_created_shipment)
                                        <p class="mt-3 ms-3">Create shipment first!</p>
                                    @elseif($item->is_created_shipment)
                                        @if ($item->transaction->status != 'expired')
                                            <p class="mt-3 ms-3">{{ ucfirst($item->shipment->status) }}</p>
                                        @else
                                            <p class="mt-3 ms-3">Expired Order</p>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <div class="mt-3 ms-3">
                                        @if (!$item->is_created_shipment)
                                            @if ($item->transaction->status != 'expired')
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                                        data-bs-target="#shipment{{ $item->id }}">Create
                                                        Shipment</button>
                                                </div>
                                                <div class="modal fade" id="shipment{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="addNewProductLabel" aria-hidden="true">
                                                    <div class="modal-dialog border-top border-5 border-info">
                                                        <div class="modal-content border-0">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="addNewProductLabel">
                                                                    CREATE SHIPMENT -
                                                                    {{ Str::upper($item->product->name) }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('store_shipment') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input hidden type="text" name="order_id"
                                                                        value="{{ $item->id }}">
                                                                    <div>
                                                                        <label for="place_name" class="form-label">Place
                                                                            Name</label>
                                                                        <input type="text" id="place_name"
                                                                            name="place_name" class="form-control"
                                                                            required>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label for="city"
                                                                                class="form-label">City</label>
                                                                            <input type="text" id="city"
                                                                                class="form-control" name="city"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="province"
                                                                                class="form-label">Province</label>
                                                                            <input type="text" id="province"
                                                                                class="form-control" name="province"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <label for="postal_code"
                                                                                class="form-label">Postal
                                                                                Code</label>
                                                                            <input type="text" id="postal_code"
                                                                                class="form-control" name="postal_code"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div>
                                                                        <label for="address"
                                                                            class="form-label">Address</label>
                                                                        <textarea type="text" id="address" name="address" class="form-control" required></textarea>
                                                                    </div>
                                                                    <br>
                                                                    <div class="d-grid">
                                                                        <button type="submit"
                                                                            class="btn btn-info text-white">Submit
                                                                            Shipment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p>-</p>
                                            @endif
                                        @elseif($item->is_created_shipment)
                                            <div class="d-flex justify-content-center gap-1">
                                                @if ($item->shipment->status == 'payment pending')
                                                    @if ($item->transaction->status != 'expired')
                                                        <button class="btn btn-info btn-sm text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#shipment_edit{{ $item->id }}"
                                                            title="Edit Shipment">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    @else
                                                        <p>-</p>
                                                    @endif
                                                @endif
                                                @if ($item->transaction->status != 'expired')
                                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                                        data-bs-target="#shipment_detail{{ $item->id }}"
                                                        title="Shipment Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="modal fade" id="shipment_edit{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="addNewProductLabel" aria-hidden="true">
                                                <div class="modal-dialog border-top border-5 border-info">
                                                    <div class="modal-content border-0">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="addNewProductLabel">
                                                                EDIT SHIPMENT - {{ Str::upper($item->product->name) }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('update_shipment', $item->shipment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div>
                                                                    <label for="place_name" class="form-label">Place
                                                                        Name</label>
                                                                    <input type="text" id="place_name"
                                                                        name="place_name" class="form-control"
                                                                        value="{{ $item->shipment->place_name }}">
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label for="city"
                                                                            class="form-label">City</label>
                                                                        <input type="text" id="city"
                                                                            class="form-control" name="city"
                                                                            value="{{ $item->shipment->city }}">
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label for="province"
                                                                            class="form-label">Province</label>
                                                                        <input type="text" id="province"
                                                                            class="form-control" name="province"
                                                                            value="{{ $item->shipment->province }}">
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <label for="postal_code" class="form-label">Postal
                                                                            Code</label>
                                                                        <input type="text" id="postal_code"
                                                                            class="form-control" name="postal_code"
                                                                            value="{{ $item->shipment->postal_code }}">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div>
                                                                    <label for="address"
                                                                        class="form-label">Address</label>
                                                                    <input type="text" id="address"
                                                                        class="form-control" name="address"
                                                                        value="{{ $item->shipment->address }}">
                                                                </div>
                                                                <br>
                                                                <div class="d-grid">
                                                                    <button type="submit"
                                                                        class="btn btn-info text-white">Update
                                                                        Shipment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="shipment_detail{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="addNewProductLabel" aria-hidden="true">
                                                <div class="modal-dialog border-top border-5 border-info">
                                                    <div class="modal-content border-0">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="addNewProductLabel">
                                                                SHIPMENT DETAIL - {{ Str::upper($item->product->name) }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="rounded-0 shadow-sm">
                                                                <div class="border-top border-5 border-info">
                                                                    <p class="fw-bold py-2 border-bottom">
                                                                        SENDER</p>
                                                                </div>
                                                                <div class="d-flex px-3 border-bottom">
                                                                    <p>Name</p>
                                                                    <p class="ms-auto">{{ $item->customer_name }}</p>
                                                                </div>
                                                                <div class="d-flex px-3 pt-3 border-bottom">
                                                                    <p>Email</p>
                                                                    <p class="ms-auto">{{ $item->customer_email }}</p>
                                                                </div>
                                                                <div class="d-flex px-3 pt-3 border-bottom">
                                                                    <p>Phone</p>
                                                                    <p class="ms-auto">{{ $item->customer_phone }}</p>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="rounded-0 shadow-sm">
                                                                <div class="border-top border-5 border-info">
                                                                    <p class="fw-bold py-2 border-bottom">
                                                                        RECIPIENT</p>
                                                                </div>
                                                                <div class="d-flex px-3 border-bottom">
                                                                    <p>Place Name</p>
                                                                    <p class="ms-auto">{{ $item->shipment->place_name }}
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex px-3 pt-3 border-bottom">
                                                                    <p>Province - Postal Code</p>
                                                                    <p class="ms-auto">{{ $item->shipment->province }}
                                                                        - {{ $item->shipment->postal_code }}
                                                                    </p>
                                                                </div>
                                                                <div class="d-flex px-3 pt-3 border-bottom">
                                                                    <p>City</p>
                                                                    <p class="ms-auto">{{ $item->shipment->city }}</p>
                                                                </div>
                                                                <div class="d-flex px-3 pt-3 border-bottom">
                                                                    <p>Address</p>
                                                                    <p class="ms-auto">{{ $item->shipment->address }}</p>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            @if ($item->transaction->status == 'pending')
                                                                <div class="d-grid">
                                                                    <div class="badge text-bg-warning text-white py-2"
                                                                        style="opacity: 0.7">
                                                                        <span>Payment pending</span>
                                                                    </div>
                                                                </div>
                                                            @elseif($item->transaction->status == 'expired')
                                                                <div class="d-grid">
                                                                    <div class="badge text-bg-danger text-white py-2"
                                                                        style="opacity: 0.7">
                                                                        <span>Expired</span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="d-grid">
                                                                    <div class="badge text-bg-success text-white py-2"
                                                                        style="opacity: 0.7">
                                                                        <span>Paid</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="mt-3 ms-3">
                                        @if (!$item->is_created_shipment)
                                            <div class="d-flex justify-content-center gap-1">
                                                @if ($item->transaction->status == 'expired')
                                                    <button class="btn btn-danger btn-sm text-white"
                                                        @disabled(true)>Order
                                                        Expired</button>
                                                    <form id="deleteForm_{{ $item->id }}"
                                                        action="{{ route('cancel_order', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm text-white delete-order"
                                                            data-id="{{ $item->id }}" title="Cancel Order"><i
                                                                class="bi bi-calendar-x"></i></button>
                                                    </form>
                                                @else
                                                    <form id="deleteForm_{{ $item->id }}"
                                                        action="{{ route('cancel_order', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-info btn-sm text-white delete-order"
                                                            data-id="{{ $item->id }}">Cancel
                                                            Order</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @elseif($item->is_created_shipment)
                                            <div class="d-flex justify-content-center gap-1">
                                                @if ($item->transaction->status == 'pending')
                                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                                        data-bs-target="#order_edit{{ $item->id }}"><i
                                                            class="bi bi-pencil-square" title="Edit Order"></i></button>
                                                    <form id="deleteForm_{{ $item->id }}"
                                                        action="{{ route('cancel_order', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-info btn-sm text-white delete-order"
                                                            data-id="{{ $item->id }}" title="Cancel Order"><i
                                                                class="bi bi-calendar-x"></i></button>
                                                    </form>
                                                    <button class="btn btn-info btn-sm text-white pay-button"
                                                        data-transaction="{{ $item->transaction->snapToken }}"
                                                        data-transaction-id="{{ $item->transaction->id }}">Pay
                                                        Now</button>
                                                @else
                                                    @if ($item->transaction->status == 'done')
                                                        <button class="btn btn-success btn-sm text-white"
                                                            @disabled(true)>Payment
                                                            Successful</button>
                                                    @else
                                                        <button class="btn btn-danger btn-sm text-white"
                                                            @disabled(true)>Expired Order</button>
                                                        <form id="deleteForm_{{ $item->id }}"
                                                            action="{{ route('cancel_order', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm text-white delete-order"
                                                                data-id="{{ $item->id }}" title="Cancel Order"><i
                                                                    class="bi bi-calendar-x"></i></button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="modal fade" id="order_edit{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="addNewProductLabel" aria-hidden="true">
                                                <div class="modal-dialog border-top border-5 border-info">
                                                    <div class="modal-content border-0">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="addNewProductLabel">
                                                                EDIT ORDER - {{ Str::upper($item->product->name) }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('order.update', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="customer_name"
                                                                            class="form-label">Name</label>
                                                                        <input type="text" id="customer_name"
                                                                            class="form-control" name="customer_name"
                                                                            value="{{ $item->customer_name }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="customer_email"
                                                                            class="form-label">Email</label>
                                                                        <input type="text" id="customer_email"
                                                                            class="form-control" name="customer_email"
                                                                            value="{{ $item->customer_email }}">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="customer_phone"
                                                                            class="form-label">Phone Number</label>
                                                                        <input type="number" id="customer_phone"
                                                                            class="form-control" name="customer_phone"
                                                                            value="{{ $item->customer_phone }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="amount" class="form-label">Amount of
                                                                            Packet</label>
                                                                        <input type="number" id="amount"
                                                                            class="form-control" name="amount"
                                                                            value="{{ $item->amount }}" min="1">
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="d-grid">
                                                                    <button type="submit"
                                                                        class="btn btn-info text-white">Update
                                                                        Order</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('script-payment')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.pay-button').forEach(button => {
                button.addEventListener('click', function() {
                    const dataTransaction = this.getAttribute('data-transaction');
                    const dataTransactionId = this.getAttribute('data-transaction-id');
                    snap.pay(dataTransaction, {
                        onSuccess: function(result) {
                            window.location.href =
                                "/update_payment_status/" + dataTransactionId;
                        },
                        onPending: function(result) {
                            document.getElementById('result-json').innerHTML += JSON
                                .stringify(result, null, 2);
                        },
                        onError: function(result) {
                            document.getElementById('result-json').innerHTML += JSON
                                .stringify(result, null, 2);
                        }
                    });
                });
            });
        });
    </script>
@endsection
