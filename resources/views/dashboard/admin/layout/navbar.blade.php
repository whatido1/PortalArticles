<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Articles</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                Hi, {{ Str::title(Auth::User()->role->role) }} {{Auth::User()->name }}
                <img src="{{ asset(Auth::User()->photo) }}" style="max-width:30px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('user.show', [Auth::user()->id]) }}" class="dropdown-item">
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form class="dropdown-item" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn p-0">
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>