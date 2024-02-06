@extends('landingpage.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col p-5" id="main">
            <div class="main-panel">
                <div class="content-wrapper" style="background: white!important">
                    <div class="row-12" style="width: 100%">
                        <div id="carouselExampleControls" class="carousel slide mb-4" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    @empty($kost_id->foto_kamar)
                                    <img src="{{url('admin/img/no_foto_kamar.jpg')}}" class="d-block w-100" alt="...">
                                    @else
                                    <img src="{{url('admin/img/'.$kost_id->foto_kamar)}}" class="d-block w-100"
                                        alt="...">
                                    @endif
                                </div>
                                <div class="carousel-item">
                                    @empty($kost_id->foto_kamar)
                                    <img src="{{url('admin/img/no_foto_kamar.jpg')}}" class="d-block w-100" alt="...">
                                    @else
                                    <img src="{{url('admin/img/'.$kost_id->foto_kamar)}}" class="d-block w-100"
                                        alt="...">
                                    @endif
                                </div>
                                <div class="carousel-item">
                                    @empty($kost_id->foto_kamar)
                                    <img src="{{url('admin/img/no_foto_kamar.jpg')}}" class="d-block w-100" alt="...">
                                    @else
                                    <img src="{{url('admin/img/'.$kost_id->foto_kamar)}}" class="d-block w-100"
                                        alt="...">
                                    @endif
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                    <!-- container -->
                    <div class="mt-5 detail-flex">
                        <div class="d-flex flex-column col-8 mr-4">
                            <h5 style="font-size: 24px;font-weight: 600;">
                                {{$kost_id->nama_kost ?? 'None'}}
                            </h5>
                            <div class="d-flex justify-content-start border-bottom my-4 mb-4">
                                <div class="p-2">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                        class="bi bi-geo-alt-fill"></i>&nbsp;&nbsp;&nbsp;{{$kost_id->alamat_kost ?? 'None'}}
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold">Kost dikelola oleh {{$kost_id->name ?? 'None'}}</h4>
                            </div>

                            <div class="d-flex justify-content-start align-items-center border-bottom">
                                <img style="width: 50px; height: 50px;" src="{{url('admin/img/users/wahyu.jpg')}}"
                                    class="rounded-circle " alt="...">
                                <div class="d-flex flex-column mx-4 my-4 mb-4">
                                    <a href="https://wa.me/+62{{$kost_id->telp ?? 'None'}}"
                                        style="border: 1px solid #11296B; color: #11296B;" class="btn bg-body rounded"
                                        type="submit">
                                        Tanya pemilik kost&nbsp;&nbsp;<i class="bi bi-chat-left-text"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-column col-8 mr-4 mt-4">
                                <h5 class="mt-4" style="font-size: 24px;font-weight: 600;">
                                    Spesifikasi Tipe Kamar</h5>
                                <div class="d-flex justify-content-start mb-2 mt-3">
                                    <i class="bi bi-aspect-ratio"></i>&nbsp;&nbsp;Luas kamar:
                                    {{$kost_id->luas_kamar ?? 'None'}}
                                    Meter
                                </div>
                                <div class=" d-flex justify-content-start">
                                    <i class="bi bi-bag-heart"></i>&nbsp;&nbsp;Fasilitas:
                                    {{$kost_id->fasilitas ?? 'None'}}
                                </div>

                                <div class="mt-5 row p-3">
                                    <h5 style="font-size: 24px;font-weight: 600;">Keterangan Lainnya</h5>
                                </div>
                                <br>
                                <div>
                                    <div class="col-8 mb-5">
                                        {{$kost_id->keterangan ?? 'None'}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <div class="shadow d-flex flex-column mb-3 p-5 pesan">
                                <form method="POST" action="{{route('pembayaran.store')}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <h4 class="fw-bold">Rp.
                                        {{number_format($kost_id->harga_kamar, 2, ',', '.')}}<span>/bln</span>
                                        <input type="input" hidden id="harga"
                                            value="{{$kost_id->harga_kamar ?? 'None'}}">
                                    </h4>
                                    {{-- Pembayaran --}}
                                    {{-- tangal masuk --}}
                                    <div class="mb-3">
                                        <label for="">Tanggal Masuk</label>
                                        <input name="tanggal_masuk" type="date" class="form-control" id="masuk"
                                            required>
                                    </div>
                                    {{-- tanggal keluar --}}
                                    <div class="mb-3">
                                        <label for="">Tanggal Keluar</label>
                                        <input name="tanggal_keluar" type="date" class="form-control" id="keluar"
                                            required>
                                        {{-- kode bayar --}}
                                        <input name="kode_bayar" hidden type="text" class="form-control" id="kode"
                                            required>
                                        {{-- Input id kamar --}}
                                        <input name="id_kamar" value="{{$kost_id->id}}" hidden type="number"
                                            class="form-control" id="kode" required>
                                        {{-- Input id user --}}
                                        <input name="id_user" value="{{$kost_id->id}}" hidden type="number"
                                            class="form-control" id="kode" required>
                                        {{-- Input nama unique_id kost --}}
                                        <input name="unique_id" value="{{$kost_id->unique_id}}" hidden type="text"
                                            class="form-control" id="">
                                        {{-- status pembayaran --}}
                                        <input name="status_pembayaran" value="diproses" hidden type="text"
                                            class="form-control" id="kode" required>
                                        {{-- hidden input untuk pesanan --}}
                                        <input name="pesanan" value="progress" hidden type="text" class="form-control"
                                            required>
                                    </div>
                                    {{-- akhir Pembayaran --}}
                                    <div class="mb-3">
                                        <input hidden type="text" name="metode_pembayaran" id="metode_pembayaran"
                                            value="BCA">
                                        <label for="">Pilih Pembayaran</label>
                                        <div class=" accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="card-header" id="headingOne">
                                                    <h2 class="mb-0">
                                                        <button id="bcaButton" class="btn btn-block text-left"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            Pembayaran BCA
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body mt-2">
                                                        <h2>5311008758</h2>
                                                        <p>A/n Wahyu Rohmanto</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button id="qrisButton"
                                                            class="btn btn-block text-left collapsed" type="button"
                                                            data-toggle="collapse" data-target="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            QRIS
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <img src=" {{url('assets/image/qris.jpeg')}}" class="img-fluid"
                                                            alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingThree">
                                                    <h2 class="mb-0">
                                                        <button id="briButton" class="btn btn-block text-left collapsed"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">
                                                            BRI
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                    data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <h2>096301045343534</h2>
                                                        <p>A/n Wahyu Rohmanto</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        {{-- total harga --}}
                                        <input name="total_bayar" type="text" class="form-control" id="total_harga"
                                            value="" hidden>
                                        <input type="input" name="id_customer" hidden value=" {{ Auth::user()->id }}"
                                            id="id_customer">
                                    </div>
                                    <!-- modal untuk cek kembali -->
                                    <button type="button" class="btn btn-primary bt" data-toggle="modal"
                                        data-target="#exampleModal" id="modal">
                                        Pesan Kamar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pesanan Anda</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p>Nama Kamar</p>
                                                            <p>Luas Kamar</p>
                                                            <p>Fasilitas</p>
                                                            <p>Tanggal</p>
                                                            <p>Jumlah Hari</p>
                                                            <p>Pembayaran</p>
                                                            <h2>Harga</h2>
                                                        </div>
                                                        <div class="col-sm-6" id="data">
                                                            <p>: {{$kost_id->nama_kost}}</p>
                                                            <p>: {{$kost_id->luas_kamar}}</p>
                                                            <p>: {{$kost_id->fasilitas}}</p>
                                                            <p id="val-date">: -</p>
                                                            <p id="date_total">: -</p>
                                                            <p id="pay">: BCA</p>
                                                            <h2 id="total">
                                                            </h2>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class=" modal-footer">
                                                    <button type="submit" class="btn btn-primary bt">Iya
                                                        Cocok!</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end container 2 -->

                    </div>
                    <!-- end container-->
                </div>
                <!-- endcontainer -->
            </div>
        </div>
    </div>
</div>
@endsection