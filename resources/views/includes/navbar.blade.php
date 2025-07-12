<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ url('/admin/img/logo.png') }}" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
                    <a href="{{ route('kategori') }}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item {{ Request::is('keanggotaan') ? 'active' : '' }}">
                    <a href="{{ route('keanggotaan') }}" class="nav-link">Keanggotan</a>
                </li>
                <li class="nav-item {{ Request::is('tentang-kami') ? 'active' : '' }}">
                    <a href="{{ route('tentangKami') }}" class="nav-link">Tentang Kami</a>
                </li>


                @auth
                    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            Hi, {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <img src="{{ url('/assets/images/user/profile.gif') }}" class="rounded-circle profile-picture"
                                alt="User Profile">
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link px-4 text-white">Log Out</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                        <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
