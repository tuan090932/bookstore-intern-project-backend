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
    <li class="nav-item {{ $currentRoute=='dashboard' ? 'active':'' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ $currentRoute=='users.index' ? 'active':'' }}" href="{{ route('users.index') }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Users</span></a>
    </li>

    <li class="nav-item {{ $currentRoute=='books.index' ? 'active':'' }}" href="{{ route('books.index') }}">
        <a class="nav-link" href="{{ route('books.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Books</span></a>
    </li>

    <li class="nav-item {{ $currentRoute=='languages.index' ? 'active':'' }}" href="{{ route('languages.index') }}">
        <a class="nav-link" href="{{ route('languages.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Languages</span></a>
    </li>   
         
    <li class="nav-item {{ $currentRoute=='authors.index' ? 'active':'' }}" href="{{ route('authors.index') }}">
        <a class="nav-link" href="{{ route('authors.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Authors</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
