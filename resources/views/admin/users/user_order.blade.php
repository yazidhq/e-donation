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
                                                    @if ($item->shipment->status == 'payment pending')
                                                        Awaiting payment
                                                    @endif
                                                    @if ($item->shipment && $item->shipment->status != 'payment pending')
                                                        {{ ucfirst($item->shipment->status) }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ ucfirst($item->transaction->status) }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('user_order_detail', $item->id) }}"
                                                        class="btn btn-sm btn-info text-white" title="Order Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $item->id }}"
                                                        action="{{ route('delete_order', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="button" class="btn btn-sm btn-danger delete-product"
                                                            data-id="{{ $item->id }}" title="Delete Order">
                                                            <i class="bi bi-x-square"></i>
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-success text-white"
                                                        title="Shipping Detail">
                                                        <i class="bi bi-check-square" title="Finish Order"></i>
                                                    </button>
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
