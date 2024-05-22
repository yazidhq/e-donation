@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">

                    <div class="d-flex mb-3">
                        <div><a href="" class="btn btn-info px-5 text-white">Refresh</a></div>
                        <div class="ms-auto">
                            <form action="{{ route('shipment_status.store') }}" method="POST">
                                @csrf
                                <div class="d-flex input-group">
                                    <input type="text" name="status" class="form-control"
                                        placeholder="Create shipment status">
                                    <button type="submit" class="btn btn-info text-white">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('shipment_status'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "{{ session('shipment_status') }}",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif

                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <div class="pt-3">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shipment_status as $item)
                                            <tr>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-warning btn-sm text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editStatus{{ $item->id }}">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <div class="modal fade" id="editStatus{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="addNewProductLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('shipment_status.update', $item->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="d-flex input-group">
                                                                                <input type="text" name="status"
                                                                                    class="form-control"
                                                                                    value="{{ $item->status }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-info text-white">
                                                                                    Update
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form id="deleteForm_{{ $item->id }}"
                                                            action="{{ route('shipment_status.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger delete-product"
                                                                data-id="{{ $item->id }}">
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
