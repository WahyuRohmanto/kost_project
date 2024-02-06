<div class="col-2 px-1 shadow">
    @if(Auth::user()->role === "pemilik")
    <div class="nav flex-column flex-nowrap vh-100 overflow-auto p-2">
        <a href="{{url('dashboards')}}" class="nav-link side "><i class="bi bi-grid"></i>Dashboard</a>
        <a href="{{url('data-pemilik')}}" class="nav-link side"><i class="bi bi-house-door"></i>Kost</a>
        <a href="{{url('pesanan')}}" class="nav-link side"><i class="bi bi-cart3"></i>Orders</a>
    </div>
    @elseif(Auth::user()->role === "customer")
    <div class="nav flex-column flex-nowrap vh-100 overflow-auto p-2">
        <a href="{{url('history')}}" class="nav-link side "><i class="bi bi-hourglass-bottom"></i>Riwayat Transaksi</a>
    </div>
    @endif
</div>