<div class="pagetitle">
    <h1>
        @if (isset($user))
            {{ Str::upper($user->name) }}'S
        @endif
        {{ Str::after(Str::upper(Str::before(request()->route()->getName(), '.')), '_') }}
    </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            @if (isset($user))
                <li class="breadcrumb-item"><a href="/users">users</a></li>
            @endif
            <li class="breadcrumb-item active">
                {{ ucfirst(Str::after(Str::before(request()->route()->getName(), '.'), '_')) }}
            </li>
        </ol>
    </nav>
</div>
