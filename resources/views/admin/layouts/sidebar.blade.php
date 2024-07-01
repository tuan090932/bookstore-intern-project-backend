@php
$currentRoute = request()->route()->getName();
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $currentRoute=='admin.dashboard' ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::guard('admin')->check())
        @if(Auth::guard('admin')->user()->hasRole('ALL') || Auth::guard('admin')->user()->hasRole('MG'))
            <!-- Nav Item - Users -->
            <li class="nav-item {{ $currentRoute=='users.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Users</span></a>
            </li>

            <!-- Nav Item - Books -->
            <li class="nav-item {{ $currentRoute=='books.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('books.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span></a>
            </li>

            <!-- Nav Item - Authors -->
            <li class="nav-item {{ in_array($currentRoute, ['authors.index', 'authors.create', 'authors.edit', 'authors.trashed', 'authors.search']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('authors.index') }}">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span>Authors</span></a>
            </li>

            <li class="nav-item {{ $currentRoute=='languages.index' ? 'active':'' }}" href="{{ route('languages.index') }}">
                <a class="nav-link" href="{{ route('languages.index') }}">
                    <i class="fa-solid fa-language"></i>
                    <span>Languages</span></a>
            </li>

            <!-- Nav Item - Categories -->
            <li class="nav-item {{ $currentRoute=='categories.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Categories</span></a>
            </li>

            <!-- Nav Item - Orders -->
            <li class="nav-item {{ $currentRoute=='orders.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Orders</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('ALL'))
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Admins Account -->
            <li class="nav-item {{ in_array($currentRoute, ['admins.index', 'admins.create', 'admins.edit']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admins.index') }}">
                    <i class="fa-solid fa-gears"></i>
                    <span>Admins Account</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('CUST'))
            <!-- Nav Item - Users -->
            <li class="nav-item {{ $currentRoute=='users.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa-solid fa-user"></i>
                    <span>Users</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('BOOK'))
            <!-- Nav Item - Books -->
            <li class="nav-item {{ $currentRoute=='books.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('books.index') }}">
                    <i class="fa-solid fa-book"></i>
                    <span>Books</span></a>
            </li>
            <li class="nav-item {{ $currentRoute=='languages.index' ? 'active':'' }}" href="{{ route('languages.index') }}">
                <a class="nav-link" href="{{ route('languages.index') }}">
                    <i class="fa-solid fa-language"></i>
                    <span>Languages</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('AUTHO'))
            <!-- Nav Item - Authors -->
            <li class="nav-item {{ in_array($currentRoute, ['authors.index', 'authors.create', 'authors.edit', 'authors.trashed']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('authors.index') }}">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span>Authors</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('CAT'))
            <!-- Nav Item - Categories -->
            <li class="nav-item {{ $currentRoute=='categories.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Categories</span></a>
            </li>
        @endif

        @if(Auth::guard('admin')->user()->hasRole('ORD'))
            <!-- Nav Item - Orders -->
            <li class="nav-item {{ $currentRoute=='orders.index' ? 'active':'' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Orders</span></a>
            </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    @endif


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
