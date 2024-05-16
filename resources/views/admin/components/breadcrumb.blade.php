<div class="pagetitle">
    <h1>{{ Str::upper(Str::before(request()->route()->getName(), '.')) }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">{{ ucfirst(Str::before(request()->route()->getName(), '.')) }}</li>
        </ol>
    </nav>
</div>
