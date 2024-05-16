@extends('admin.layout.template')

@section('content')
    <main id="main" class="main bg-azure">

        @include('admin.components.breadcrumb')

        <section class="section dashboard">
            <div class="row">
                <div class="col-12">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h6 class="fw-bold text-center card-title mt-4 text-dark">E-DONATIONS
                            </h6>
                            <div class="align-items-center">
                                <div class="text-center mt-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
