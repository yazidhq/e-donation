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

                            <h1>ORDER</h1>
                            <p>{{ $order->customer_name }}</p>

                            @if ($shipment)
                                <h1>SHIPMENT</h1>
                                <p>{{ $shipment->place_name }}</p>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
