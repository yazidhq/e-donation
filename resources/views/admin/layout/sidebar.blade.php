<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'dashboard' ? '' : 'collapsed' }}" href="/dashboard">
                <i class="bi bi-grid text-dark"></i>
                <span class="text-dark">Dashboard</span>
            </a>
        </li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'product.index' ? '' : 'collapsed' }}"
                href="/product">
                <i class="bi bi-cart-plus"></i>
                <span class="text-dark">Products</span>
            </a>
        </li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'shipment_status.index' ? '' : 'collapsed' }}"
                href="/shipment_status">
                <i class="bi bi-truck-front"></i>
                <span class="text-dark">Shipment Status</span>
            </a>
        </li>

        <li class="nav-heading mt-4">Transactions</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'users' ? '' : 'collapsed' }}" href="/users">
                <i class="bi bi-people"></i>
                <span class="text-dark">Users</span>
            </a>
        </li>

        <li class="nav-heading mt-4">Preferences</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'product' ? '' : 'collapsed' }}" href="/profile">
                <i class="bi bi-person text-dark"></i>
                <span class="text-dark">My Profile</span>
            </a>
        </li>

        <li class="nav-item shadow-sm">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="d-grid gap-2">
                    <button class="nav-link collapsed border-0">
                        <i class="bx bx-cog text-dark"></i>
                        <span class="text-dark">Sign Out</span>
                    </button>
                </div>
            </form>
        </li>

        <li class="nav-heading mt-4">Support</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'helpdesk' ? '' : 'collapsed' }}"
                href="https://api.whatsapp.com/send?phone=6281339999352&amp;text=Halo,%20saya%20butuh%20bantuan"
                target="_blank">
                <i class="bi bi-question-circle text-dark"></i>
                <span class="text-dark">Help & Support</span>
            </a>
        </li>

    </ul>

</aside>
