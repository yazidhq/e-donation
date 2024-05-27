@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">

                    @if (session('order'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "{{ session('order') }}",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif

                    @if (session('failed_order'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "{{ session('failed_order') }}",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif

                    <div class="col-12">
                        <div class="card info-card sales-card">
                            <div class="card-body pt-3">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Account Name</th>
                                            <th scope="col">Sender Name</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Total Price (QTY)</th>
                                            <th scope="col">Shipment Status</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $item)
                                            <tr>
                                                <td>
                                                    <p class="fw-bold text-info">
                                                        {{ ucfirst($item->order->user->name) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="fw-bold text-info">
                                                        {{ ucfirst($item->order->customer_name) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    {{ ucfirst($item->order->product->name) }}
                                                </td>
                                                <td>
                                                    IDR
                                                    {{ number_format($item->order->amount * $item->order->product->price, '0', ',', '.') }},00
                                                    ({{ $item->order->amount }})
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('update_shipment_status', $item->order->shipment->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="d-flex gap-2">
                                                            <div class="input-group input-group-sm">
                                                                <select name="status" class="form-control">
                                                                    <option hidden
                                                                        value="{{ $item->order->shipment->status }}">
                                                                        {{ ucfirst($item->order->shipment->status) }}
                                                                    </option>
                                                                    @foreach ($shipment_status as $status)
                                                                        <option value="{{ $status->status }}">
                                                                            {{ ucfirst($status->status) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <button class="btn btn-info text-white">
                                                                    <i class="bi bi-arrow-right-square"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="d-grid">
                                                        <button class="btn btn-success btn-sm" @disabled(true)>
                                                            <i class="bi bi-check-circle px-1"></i>
                                                            {{ ucfirst($item->status) }}
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('detail_user_order', ['userId' => $item->order->user_id, 'orderId' => $item->order->id]) }}"
                                                            class="btn btn-sm btn-info text-white" title="Order Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <form
                                                            @if ($item->order->shipment) action="{{ route('update_shipment_status', $item->order->shipment->id) }}" @endif
                                                            method="POST">
                                                            @csrf
                                                            <input hidden type="text" name="status" value="delivered">
                                                            <button type="submit" class="btn btn-sm btn-success text-white"
                                                                title="Finish the Order"
                                                                {{ $item->status != 'done' || ($item->order->shipment ? $item->order->shipment->status : '') == 'delivered' ? 'disabled' : '' }}>
                                                                <i class="bi bi-check-square"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
