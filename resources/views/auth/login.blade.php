@extends('auth.layout')

@section('content')
    <section>
        <div class="d-flex justify-content-center align-items-center vh-100"
            style="background-image: linear-gradient(to left, #24b9cc, #1f6aeb)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 text-center">
                        <div class="my-5 display-3 fw-bold ls-tight" data-aos="fade-left">
                            <img src="{{ asset('img/logo.png') }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card border-0 shadow" style="background-color: #1f6aeb" data-aos="fade-right">
                            <div class="card-body py-5 px-md-5">
                                <form action="{{ route('authenticate') }}" method="POST">
                                    @csrf

                                    <div class="text-white">
                                        <h1 class="fw-bold mb-5">E-Donation</h1>
                                        <h3 class="fw-bold">Login to your account</h3>
                                        <p class="mb-3">Let's get started</p>
                                    </div>

                                    @if (session('logout'))
                                        <div class="alert alert-sm alert-info">
                                            {{ session('logout') }}
                                        </div>
                                    @endif

                                    @if (session('authenticate'))
                                        <div class="alert alert-sm alert-danger">
                                            {{ session('authenticate') }}
                                        </div>
                                    @endif

                                    <div class="form-outline mb-4 text-white">
                                        <label class="form-label" for="typeEmailX-2">Email</label>
                                        <input type="email" id="typeEmailX-2"
                                            class="form-control border border-white text-white @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}"
                                            style="background-color: transparent;" />
                                    </div>

                                    <div class="form-outline mb-4 text-white">
                                        <label class="form-label" for="typePasswordX-2">Password</label>
                                        <input type="password" id="typePasswordX-2"
                                            class="form-control border border-white text-white" name="password"
                                            style="background-color: transparent;" />
                                        @if ($errors->has('password'))
                                            <span class="text-white">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-info text-light rounded-md">Sign
                                            In</button>
                                    </div>
                                    <p class="text-center mt-3 text-white">Dont have an account? <a href="/register"
                                            class="text-white">Sign Up</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
