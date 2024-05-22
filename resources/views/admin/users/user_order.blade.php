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

                    <div class="card info-card sales-card">
                        <div class="card-body pt-3">
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Shipment Status</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Shipping</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->order as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>IDR
                                                {{ number_format($item->amount * $item->product->price, '0', ',', '.') }},00
                                            </td>
                                            <td>
                                                @if ($item->is_created_shipment == false)
                                                    Not yet shipped
                                                @elseif($item->is_created_shipment == true)
                                                    @if ($item->shipment)
                                                        @if ($item->shipment->status == 'payment pending')
                                                            Awaiting payment
                                                        @endif
                                                        @if ($item->shipment && $item->shipment->status != 'payment pending')
                                                            <form
                                                                action="{{ route('update_shipment_status', $item->shipment->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="d-flex gap-2">
                                                                    <div class="input-group input-group-sm">
                                                                        <select name="status" class="form-control">
                                                                            <option hidden
                                                                                value="{{ $item->shipment->status }}">
                                                                                {{ ucfirst($item->shipment->status) }}
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
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-grid">
                                                    <button
                                                        class="btn btn-{{ $item->transaction->status == 'done' ? 'success' : ($item->transaction->status == 'expired' ? 'danger' : 'warning') }} btn-sm"
                                                        @disabled(true)>
                                                        @if ($item->transaction->status == 'done')
                                                            <i class="bi bi-check-circle px-1"></i>
                                                        @elseif ($item->transaction->status == 'expired')
                                                            <i class="bi bi-exclamation-square px-1"></i>
                                                        @else
                                                            <i class="bi bi-arrow-clockwise px-1"></i>
                                                        @endif
                                                        {{ ucfirst($item->transaction->status) }}
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('edit_user_order', ['userId' => $user->id, 'orderId' => $item->id]) }}"
                                                        class="btn btn-sm btn-warning text-white" title="Edit Shipment"
                                                        @if ($item->transaction->status != 'pending' || !$item->is_created_shipment) style="pointer-events: none;opacity: 0.6;cursor: not-allowed;" @endif>
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $item->id }}_shipment"
                                                        action="{{ route('delete_shipment', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button" class="btn btn-sm btn-danger delete-product"
                                                            data-id="{{ $item->id }}_shipment" title="Delete Shipment"
                                                            {{ $item->transaction->status != 'pending' || !$item->is_created_shipment ? 'disabled' : '' }}>
                                                            <i class="bi bi-x-square"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('detail_user_order', ['userId' => $user->id, 'orderId' => $item->id]) }}"
                                                        class="btn btn-sm btn-info text-white" title="Order Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $item->id }}_order"
                                                        action="{{ route('delete_order', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button" class="btn btn-sm btn-danger delete-product"
                                                            data-id="{{ $item->id }}_order" title="Delete Order"
                                                            {{ $item->transaction->status == 'done' ? 'disabled' : '' }}>
                                                            <i class="bi bi-x-square"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        @if ($item->shipment) action="{{ route('update_shipment_status', $item->shipment->id) }}" @endif
                                                        method="POST">
                                                        @csrf
                                                        <input hidden type="text" name="status" value="delivered">
                                                        <button type="submit" class="btn btn-sm btn-success text-white"
                                                            title="Finish the Order"
                                                            {{ $item->transaction->status != 'done' || ($item->shipment ? $item->shipment->status : '') == 'delivered' ? 'disabled' : '' }}>
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
        </section>

    </main>
@endsection
