<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form action ="{{ route('books.search') }}" method="get"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>

        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        @if(auth()->guard('admin')->check())
            <!-- If admin is logged in, show admin information -->
            <li class="nav-item">
                <a class="nav-link"
                    <span class="mr-2 d-none d-lg-inline small" style="color: #747474;">{{ auth()->guard('admin')->user()->admin_name }}</span>
                    <img class="img-profile rounded-circle ml-2" src="{{ asset('/assets/img/undraw_profile.svg') }}" style="width: 30px; height: 30px;">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-300"></i>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-300"></i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @else
        <!-- If admin is not logged in, show login and register links -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.register') }}">Register</a>
        </li>
    @endif
</ul>

    </nav>
    <!-- End of Topbar -->
