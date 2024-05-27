<div class="pagetitle">
    <h1>
        @if (isset($user) && !isset($order))
            {{ Str::upper($user->name) }}'S
        @endif
        @if (isset($order))
            @if (Str::before(request()->route()->getName(), '_') == 'detail')
                DETAIL
            @else
                EDIT
            @endif
            {{ Str::upper($order->user->name) }}'S
            {{ Str::after(Str::after(Str::upper(Str::before(request()->route()->getName(), '.')), '_'), '_') }}
        @elseif(request()->route()->getName() == 'new_order')
            NEW ORDERS
        @elseif(request()->route()->getName() == 'dispatch_list')
            DISPATCH LIST
        @elseif(request()->route()->getName() == 'expired_orders')
            EXPIRED ORDERS
        @else
            {{ Str::after(Str::upper(Str::before(request()->route()->getName(), '.')), '_') }}
        @endif
    </h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            @if (isset($user) || isset($order))
                <li class="breadcrumb-item"><a href="/users">users</a></li>
            @endif
            @if (isset($user) && isset($order))
                <li class="breadcrumb-item"><a href="{{ route('user_orders', $user->id) }}">user's order</a></li>
            @endif
            <li class="breadcrumb-item active">
                @if (isset($order))
                    @if (Str::before(request()->route()->getName(), '_') == 'detail')
                        Detail
                    @else
                        Edit
                    @endif
                    {{ ucfirst(Str::after(Str::after(Str::before(request()->route()->getName(), '.'), '_'), '_')) }}
                @elseif(request()->route()->getName() == 'new_order')
                    New Orders
                @elseif(request()->route()->getName() == 'dispatch_list')
                    Dispatch List
                @elseif(request()->route()->getName() == 'expired_orders')
                    Expired Orders
                @else
                    {{ ucfirst(Str::after(Str::before(request()->route()->getName(), '.'), '_')) }}
                @endif
            </li>
        </ol>
    </nav>
</div>
