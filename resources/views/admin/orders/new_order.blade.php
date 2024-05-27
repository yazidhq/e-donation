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
                                            <th scope="col">Shipping</th>
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
                                                    @if ($item->order->is_created_shipment == false)
                                                        Not yet shipped
                                                    @elseif($item->order->is_created_shipment == true)
                                                        @if ($item->order->shipment)
                                                            @if ($item->order->shipment->status == 'payment pending')
                                                                Awaiting payment
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('edit_user_order', ['userId' => $item->order->user_id, 'orderId' => $item->order->id]) }}"
                                                            class="btn btn-sm btn-warning text-white" title="Edit Shipment"
                                                            @if ($item->status != 'pending' || !$item->order->is_created_shipment) style="pointer-events: none;opacity: 0.6;cursor: not-allowed;" @endif>
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <form
                                                            @if ($item->order->shipment != null) id="deleteForm_{{ $item->order->shipment->id }}_shipment"
                                                                action="{{ route('delete_shipment', $item->order->shipment->id) }}" @endif
                                                            method="POST">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger delete-product"
                                                                @if ($item->order->shipment != null) data-id="{{ $item->order->shipment->id }}_shipment" @endif
                                                                title="Delete Shipment"
                                                                {{ $item->status != 'pending' || !$item->order->is_created_shipment ? 'disabled' : '' }}>
                                                                <i class="bi bi-x-square"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('detail_user_order', ['userId' => $item->order->user_id, 'orderId' => $item->order->id]) }}"
                                                            class="btn btn-sm btn-info text-white" title="Order Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <form id="deleteForm_{{ $item->order->id }}_order"
                                                            action="{{ route('delete_order', $item->order->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger delete-product"
                                                                data-id="{{ $item->order->id }}_order" title="Delete Order"
                                                                {{ $item->status == 'done' ? 'disabled' : '' }}>
                                                                <i class="bi bi-x-square"></i>
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
