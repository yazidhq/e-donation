@extends('auth.layout')

@section('content')
    <section>
        <div class="d-flex justify-content-center align-items-center vh-100"
            style="background-image: linear-gradient(to left, #1f6aeb, #24b9cc)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card border-0 shadow" style="background-color: #1f6aeb" data-aos="fade-left">
                            <div class="card-body py-5 px-md-5">
                                <form action="{{ route('store_register') }}" method="POST">
                                    @csrf

                                    <div class="text-white">
                                        <h1 class="fw-bold mb-5">E-Donation</h1>
                                        <h3 class="fw-bold">Create an account</h3>
                                        <p class="mb-3">Let's get started</p>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-4 text-white">
                                                <label for="name">Name</label>
                                                <input type="text"
                                                    class="form-control border border-white text-white @error('name') is-invalid @enderror"
                                                    id="name" name="name" value="{{ old('name') }}"
                                                    style="background-color: transparent;">
                                                @if ($errors->has('name'))
                                                    <span class="text-white">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-4 text-white">
                                                <label for="email">Email</label>
                                                <input type="text"
                                                    class="form-control border border-white text-white @error('email') is-invalid @enderror"
                                                    id="email" name="email" value="{{ old('email') }}"
                                                    style="background-color: transparent;">
                                                @if ($errors->has('email'))
                                                    <span class="text-white">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group mb-4 text-white">
                                                <label for="password">Password</label>
                                                <input type="password"
                                                    class="form-control border border-white text-white @error('password') is-invalid @enderror"
                                                    id="password" name="password" style="background-color: transparent;">
                                                @if ($errors->has('password'))
                                                    <span class="text-white">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group mb-4 text-white">
                                                <label for="password_confirmation">Password Confirmation</label>
                                                <input type="password"
                                                    class="form-control border border-white text-white @error('password') is-invalid @enderror"
                                                    id="password_confirmation" name="password_confirmation"
                                                    style="background-color: transparent;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-info text-light rounded-md">Sign
                                            Up</button>
                                    </div>
                                    <p class="text-center mt-3 text-white">Already have an account? <a href="/login"
                                            class="text-white">Sign In</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0 text-center">
                        <div class="my-5 display-3 fw-bold ls-tight" data-aos="fade-right">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
