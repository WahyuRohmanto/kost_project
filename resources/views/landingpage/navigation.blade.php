<nav class="navbar navbar-expand-lg fixed-top navbar-static-top navbar-light bg-light ">
    <a class="navbar-brand mr-auto mr-lg-0 d-inline" href="{{url('/')}}">
        <img src="{{url('assets/image/logo-brand.png')}}" alt="" srcset="">
    </a>
    <div class="container navbar-wrapper mr-auto">
        <button class="navbar-toggler p-0 border-0 ml-auto" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-2">
                <li class="nav-item active">
                    <a class="nav-link " href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#rek">Rekomendasi Kos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#kost">Kost</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#tes">Testimoni</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#tentang">About</a>
                </li>
            </ul>
            <div class="ml-auto button-navbar d-flex">
                <!-- Added -->
                @guest
                <a class="btn btn-custom" href="{{url('login')}}" type="button">Login</a>
                <a class="btn daftar" href="{{url('daftar')}}" type="button">Daftar</a>
                @endguest
                @auth
                <div class="dropdown">
                    <button class=" btn name dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('customer-profile.index')}}" class="dropdown-item"><i
                                class="fas fa-street-view"></i>
                            Profile</a>
                        @if(Auth::user()->role === "customer")
                        <a href="{{route('history')}}" class="dropdown-item"><i class="bi bi-hourglass-bottom"></i>
                            Riwayat Transaksi</a>
                        @endif
                        @php
                        $role = Auth::user()->role
                        @endphp
                        @if( $role === "pemilik")
                        <a class="dropdown-item" href="{{url('dashboards')}}"><i class="fas fa-user-edit"></i> Dashboard
                            Pemilik</a>
                        @elseif($role === "admin")
                        <a class="dropdown-item" href="{{url('administrator')}}"><i class="fas fa-user-edit"></i>
                            Dashboard
                            Admin</a>
                        @endif
                        <a class="dropdown-item" href="#" onclick="document.getElementById('form-logout').submit()"><i
                                class="fas fa-power-off"></i> Logout</a>
                        <form action="{{ route('logout') }}" method="post" id="form-logout">
                            @csrf
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>