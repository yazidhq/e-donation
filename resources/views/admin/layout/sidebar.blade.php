<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'dashboard' ? '' : 'collapsed' }} border border-info"
                href="/dashboard">
                <i class="bi bi-grid text-dark"></i>
                <span class="text-dark">Dashboard</span>
            </a>
        </li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'product.index' ? '' : 'collapsed' }} border border-info"
                href="/product">
                <i class="ri-briefcase-2-fill text-dark"></i>
                <span class="text-dark">Products</span>
            </a>
        </li>

        <li class="nav-heading mt-4">Preferences</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'product' ? '' : 'collapsed' }} border border-info"
                href="/profile">
                <i class="bi bi-person text-dark"></i>
                <span class="text-dark">My Profile</span>
            </a>
        </li>

        <li class="nav-item shadow-sm">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="d-grid gap-2">
                    <button class="nav-link collapsed border border-info">
                        <i class="bx bx-cog text-dark"></i>
                        <span class="text-dark">Sign Out</span>
                    </button>
                </div>
            </form>
        </li>

        <li class="nav-heading mt-4">Support</li>

        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->route()->getName() == 'helpdesk' ? '' : 'collapsed' }} border border-info"
                href="https://api.whatsapp.com/send?phone=6281339999352&amp;text=Halo,%20saya%20butuh%20bantuan"
                target="_blank">
                <i class="bi bi-question-circle text-dark"></i>
                <span class="text-dark">Help & Support</span>
            </a>
        </li>

    </ul>

</aside>
