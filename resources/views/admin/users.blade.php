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
                                data-bs-toggle="modal" data-bs-target="#addNewProduct">Register new user</button></div>
                    </div>

                    <div class="modal fade" id="addNewProduct" tabindex="-1" aria-labelledby="addNewProductLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addNewProductLabel">NEW USER</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('store_users') }}" method="POST">
                                        @csrf

                                        <div class="form-group mb-4">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <span class="text-white">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-4">
                                                    <label for="name">Role</label>
                                                    <select class="form-control" name="role" required>
                                                        <option hidden value="">- Select Option -</option>
                                                        <option value="user">User</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mb-4">
                                                    <label for="email">Email</label>
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="email" name="email" value="{{ old('email') }}" required>
                                                    @if ($errors->has('email'))
                                                        <span class="text-white">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mb-4">
                                                    <label for="password">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" required>
                                                    @if ($errors->has('password'))
                                                        <span class="text-white">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group mb-4">
                                                    <label for="password_confirmation">Password Confirmation</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password_confirmation" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info text-light rounded-md">Submit</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    @if (session('users'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "{{ session('users') }}",
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
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            @if ($item->role !== 'user')
                                                <tr>
                                                    <td>
                                                        <p class="fw-bold text-info">{{ ucfirst($item->name) }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->email }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->role }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->created_at }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <button class="btn btn-sm btn-warning text-white"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUser{{ $item->id }}"><i
                                                                    class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <div class="modal fade" id="editUser{{ $item->id }}"
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
                                                                                action="{{ route('update_users', $item->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <label for="role"
                                                                                    class="form-label">Role</label>
                                                                                <select class="form-control"
                                                                                    name="role">
                                                                                    <option hidden
                                                                                        value="{{ $item->role }}">
                                                                                        {{ ucfirst($item->role) }}</option>
                                                                                    <option value="user">User</option>
                                                                                    <option value="admin">Admin</option>
                                                                                </select>
                                                                                <br>
                                                                                <label for="name"
                                                                                    class="form-label">Name</label>
                                                                                <input type="text" id="name"
                                                                                    class="form-control" name="name"
                                                                                    value="{{ $item->name }}">
                                                                                <br>
                                                                                <label for="email"
                                                                                    class="form-label">Email</label>
                                                                                <input type="text" id="email"
                                                                                    class="form-control" name="email"
                                                                                    value="{{ $item->email }}">
                                                                                <br>
                                                                                <label for="password"
                                                                                    class="form-label">Password</label>
                                                                                <input type="text" id="password"
                                                                                    class="form-control" name="password">
                                                                                <br>
                                                                                <button type="submit"
                                                                                    class="btn btn-info text-white">Update</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="deleteForm_{{ $item->id }}"
                                                                action="{{ route('delete_user', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-product"
                                                                    data-id="{{ $item->id }}">
                                                                    <i class="bi bi-x-square"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($users as $item)
                                            @if ($item->role !== 'admin')
                                                <tr>
                                                    <td>
                                                        <p class="fw-bold text-info">{{ ucfirst($item->name) }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->email }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->role }}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ $item->created_at }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <button class="btn btn-sm btn-warning text-white"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUser{{ $item->id }}"><i
                                                                    class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <div class="modal fade" id="editUser{{ $item->id }}"
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
                                                                                action="{{ route('update_users', $item->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <label for="role"
                                                                                    class="form-label">Role</label>
                                                                                <select class="form-control"
                                                                                    name="role">
                                                                                    <option hidden
                                                                                        value="{{ $item->role }}">
                                                                                        {{ ucfirst($item->role) }}</option>
                                                                                    <option value="user">User</option>
                                                                                    <option value="admin">Admin</option>
                                                                                </select>
                                                                                <br>
                                                                                <label for="name"
                                                                                    class="form-label">Name</label>
                                                                                <input type="text" id="name"
                                                                                    class="form-control" name="name"
                                                                                    value="{{ $item->name }}">
                                                                                <br>
                                                                                <label for="email"
                                                                                    class="form-label">Email</label>
                                                                                <input type="text" id="email"
                                                                                    class="form-control" name="email"
                                                                                    value="{{ $item->email }}">
                                                                                <br>
                                                                                <label for="password"
                                                                                    class="form-label">Password</label>
                                                                                <input type="text" id="password"
                                                                                    class="form-control" name="password">
                                                                                <br>
                                                                                <button type="submit"
                                                                                    class="btn btn-info text-white">Update</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="deleteForm_{{ $item->id }}"
                                                                action="{{ route('delete_user', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger delete-product"
                                                                    data-id="{{ $item->id }}">
                                                                    <i class="bi bi-x-square"></i>
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('user_orders', $item->id) }}"
                                                                class="btn btn-sm btn-info text-white"
                                                                title="{{ $item->name }}'s orders">
                                                                <i class="bi bi-bag-check"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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
