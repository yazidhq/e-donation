@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">

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

            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="border-top border-info border-5 rounded-top">
                                    <div class="d-flex align-items-center text-dark px-4">
                                        <div class="fs-6">
                                            <i class="bi bi-people fs-1"></i>
                                            ORDERS
                                        </div>
                                        <div class="fs-1 fw-bold ms-auto pt-1">
                                            {{ $orders->count() }}
                                        </div>
                                    </div>
                                    <div class="border-top border-1 px-4 pt-2 text-end">
                                        <a href="/new_order" class="text-dark">
                                            <span>view details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="border-top border-info border-5 rounded-top">
                                    <div class="d-flex align-items-center text-dark px-4">
                                        <div class="fs-6">
                                            <i class="bi bi-people fs-1"></i>
                                            DISPATCHS
                                        </div>
                                        <div class="fs-1 fw-bold ms-auto pt-1">
                                            {{ $dispatchs->count() }}
                                        </div>
                                    </div>
                                    <div class="border-top border-1 px-4 pt-2 text-end">
                                        <a href="/dispatch_list" class="text-dark">
                                            <span>view details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card info-card sales-card">
                                <div class="border-top border-info border-5 rounded-top">
                                    <div class="d-flex align-items-center text-dark px-4">
                                        <div class="fs-6">
                                            <i class="bi bi-people fs-1"></i>
                                            EXPIREDS
                                        </div>
                                        <div class="fs-1 fw-bold ms-auto pt-1">
                                            {{ $expireds->count() }}
                                        </div>
                                    </div>
                                    <div class="border-top border-1 px-4 pt-2 text-end">
                                        <a href="/expired_orders" class="text-dark">
                                            <span>view details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card info-card sales-card">
                        <div class="d-flex align-items-center text-dark px-4">
                            <div class="fw-bold fs-6  py-3  ">
                                Dispatch List
                            </div>
                        </div>
                        <div class="border-top border-1 px-4 pt-2">
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Sender</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Shipment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>
                                                <p class="fw-bold text-info">
                                                    {{ ucfirst($item->order->customer_name) }}
                                                </p>
                                            </td>
                                            <td>
                                                {{ ucfirst($item->order->product->name) }}
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('update_shipment_status', $item->order->shipment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <div class="input-group input-group-sm">
                                                            <select name="status" class="form-control">
                                                                <option hidden value="{{ $item->order->shipment->status }}">
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card info-card sales-card">
                        <div class="d-flex align-items-center text-dark px-4">
                            <div class="fw-bold fs-6  py-3  ">
                                Data Line Chart
                            </div>
                        </div>
                        <div class="border-top border-1 px-4 pt-2">
                            <canvas id="dataChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                    <div class="card info-card sales-card">
                        <div class="d-flex align-items-center text-dark px-4">
                            <div class="fw-bold fs-6  py-3  ">
                                Data Pie Chart
                            </div>
                        </div>
                        <div class="border-top border-1 px-4 pt-2">
                            <canvas id="dataPieChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var data = {
            labels: ["USERS", "ORDERS", "DISPATCHS", "EXPIREDS"],
            datasets: [{
                label: '',
                data: [{{ $users->count() }}, {{ $orders->count() }}, {{ $dispatchs->count() }},
                    {{ $expireds->count() }}
                ],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.5,
                fill: true
            }]
        };
        var config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };
        var myChart = new Chart(
            document.getElementById('dataChart'),
            config
        );
    </script>
    <script>
        var pieChartData = {
            labels: ["USERS", "ORDERS", "DISPATCHS", "EXPIREDS"],
            datasets: [{
                label: '',
                data: [{{ $users->count() }}, {{ $orders->count() }}, {{ $dispatchs->count() }},
                    {{ $expireds->count() }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };
        var pieChartConfig = {
            type: 'pie',
            data: pieChartData,
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        };
        var pieChart = new Chart(
            document.getElementById('dataPieChart'),
            pieChartConfig
        );
    </script>
@endsection
