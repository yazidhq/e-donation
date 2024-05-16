@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">

                    <div class="d-flex mb-3">
                        <div><a href="" class="btn btn-info px-5 text-white">Refresh</a></div>
                        <div class="ms-auto"><button type="button" class="btn btn-info text-white px-5 text-end"
                                data-bs-toggle="modal" data-bs-target="#addNewProduct">Add new product</button></div>
                    </div>

                    <div class="modal fade" id="addNewProduct" tabindex="-1" aria-labelledby="addNewProductLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addNewProductLabel">NEW PRODUCT</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('product.store') }}" method="POST">
                                        @csrf
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" required>
                                        <br>
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" id="description" class="form-control" name="description"
                                            required>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" id="price" class="form-control" name="price"
                                                    required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="number" id="stock" class="form-control" name="stock"
                                                    required>
                                            </div>
                                        </div>
                                        <br>
                                        <label for="free" class="form-label">Free</label>
                                        <input type="text" id="free" class="form-control" name="free"
                                            value="Free ">
                                        <br>
                                        <button type="submit" class="btn btn-info text-white">Submit</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if (session('product'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "{{ session('product') }}",
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Free</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>
                                                    <p class="text-info fw-bold">{{ Str::upper($item->name) }}</p>
                                                </td>
                                                <td>{{ $item->description }}</td>
                                                <td>IDR {{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>
                                                    <p class="text-info fw-bold">+ {{ ucfirst($item->free) }}</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-sm btn-warning text-white"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editProduct{{ $item->id }}"><i
                                                                class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <div class="modal fade" id="editProduct{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="addNewProductLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="addNewProductLabel">
                                                                            {{ Str::upper($item->name) }}</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('product.update', $item->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <label for="name"
                                                                                class="form-label">Name</label>
                                                                            <input type="text" id="name"
                                                                                class="form-control" name="name"
                                                                                value="{{ $item->name }}">
                                                                            <br>
                                                                            <label for="description"
                                                                                class="form-label">Description</label>
                                                                            <input type="text" id="description"
                                                                                class="form-control" name="description"
                                                                                value="{{ $item->description }}">
                                                                            <br>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label for="price"
                                                                                        class="form-label">Price</label>
                                                                                    <input type="number" id="price"
                                                                                        class="form-control"
                                                                                        name="price"
                                                                                        value="{{ $item->price }}">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="stock"
                                                                                        class="form-label">Stock</label>
                                                                                    <input type="number" id="stock"
                                                                                        class="form-control"
                                                                                        name="stock"
                                                                                        value="{{ $item->stock }}">
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                            <label for="free"
                                                                                class="form-label">Free</label>
                                                                            <input type="text" id="free"
                                                                                class="form-control" name="free"
                                                                                value="{{ $item->free }}">
                                                                            <br>
                                                                            <button type="submit"
                                                                                class="btn btn-info text-white">Update</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form id="deleteForm_{{ $item->id }}"
                                                            action="{{ route('product.destroy', $item->id) }}"
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
