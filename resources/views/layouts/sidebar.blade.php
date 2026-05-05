<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-library</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @foreach ($menus as $menu)
        @php
            $isActiveParent = $menu->children->contains(function ($child) {
                return $child->route && request()->routeIs($child->route);
            });
        @endphp

        @if ($menu->children->count())
            <li class="nav-item {{ $isActiveParent ? 'active' : '' }}">

                <a class="nav-link {{ $isActiveParent ? '' : 'collapsed' }}" href="#" data-toggle="collapse"
                    data-target="#menu{{ $menu->id }}">

                    <i class="fas fa-fw fa-{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>

                <div id="menu{{ $menu->id }}" class="collapse {{ $isActiveParent ? 'show' : '' }}">

                    <div class="bg-white py-2 collapse-inner rounded">

                        @foreach ($menu->children as $child)
                            <a class="collapse-item 
                           {{ request()->routeIs($child->route) ? 'active' : '' }}"
                                href="{{ $child->route ? route($child->route) : '#' }}">

                                {{ $child->name }}
                            </a>
                        @endforeach

                    </div>
                </div>

            </li>
        @else
            <li class="nav-item {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                <a class="nav-link" href="{{ $menu->route ? route($menu->route) : '#' }}">
                    <i class="fas fa-fw fa-{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>
            </li>
        @endif
    @endforeach

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
