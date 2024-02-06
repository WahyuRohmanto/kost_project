@extends('landingpage.app')
@section('content')
<div class="container-fluid p-0 d-flex justify-content-center">
    <img src="{{url('assets/image/banner.png')}}" class="banner-img img-fluid">
</div>
<div class="container">
    <!-- Voucher -->
    <div class="owl-carousel wrapper-voucher">
        <div>
            <img class="img-fluid" src="assets/image/voucher/pengguna_baru.png" alt="">
        </div>
        <div>
            <img class="img-fluid" src="assets/image/voucher/akhir_tahun.png" alt="">
        </div>
        <div>
            <img class="img-fluid" src="assets/image/voucher/voucher_30.png" alt="" srcset="">
        </div>
        <div>
            <img class="img-fluid" src="assets/image/voucher/voucher_50.png" alt="" srcset="">
        </div>
    </div>

    <!-- Rekomendasi -->
    <div id="rek" class="header-tittle mt-4 pl-5">
        <h4>Rekomendasi Kost</h4>
    </div>
    <section class="container-fluid rekomendasi">
        <div class=" pt-4 pb-4 p-3 container">
            <div class="container">
                <div class="row mb-md-2 d-flex">
                    @foreach($rekomendasi as $rk)
                    <div class="col-md-6 col-lg-3">
                        <div class="card shadow-sm border-light mb-4">
                            @empty($rk->foto_kamar)
                            <a href="{{ route('detailCustomer.show',$rk->unique_id) }}" class="position-relative">
                                <img src="{{url('admin/img/no_foto_kamar.jpg')}}" class="card-img-top" alt="image">
                            </a>
                            @else
                            <a href="{{ route('detailCustomer.show',$rk->unique_id) }}" class="position-relative">
                                <img src="{{url('admin/img')}}/{{$rk->foto_kamar}}" class="card-img-top" alt="image">
                            </a>
                            @endempty
                            <div class="card-body">
                                <div class="d-flex align-content-center align-items-center justify-content-between">
                                    <span class="font-weight-small">{{$rk->nama_kost}}</span>
                                    <div class="d-flex align-items-center align-content-center">
                                        <span class="star fas fa-star text-warning"></span>
                                        <span class="star fas fa-star text-warning"></span>
                                        <span class="star fas fa-star text-warning"></span>
                                        <span class="star fas fa-star text-warning"></span>
                                        <span class="star fas fa-star text-warning"></span>
                                        <span class="rate">(5.0)</span>
                                    </div>
                                </div>
                                <div class="post-meta">
                                    <span class="small lh-120">
                                        <i class="fas fa-map-marker-alt mr-2">
                                        </i>{{$rk->alamat_kost}}
                                    </span>
                                </div>
                                <a href="{{ route('detailCustomer.show',$rk->unique_id) }}"><button
                                        class="btn btn-primary bt">Lihat Kamar</button></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Button Open  -->
            </div>
        </div>

    </section>

    <!-- Available Kost -->
    <section class="pt-5 pb-5" id="kost">
        <div class="header-tittle mb-4">
            <h4>Kost Yang Tersedia</h4>
        </div>
        <div class="container">
            <div class="row mb-md-2 d-flex">
                @foreach($kost as $k)
                <div class="col-md-6 col-lg-3">
                    <div class="card shadow-sm border-light mb-4">
                        @empty($k->foto_kamar)
                        <a href="{{ route('detailCustomer.show',$k->unique_id) }}" class="position-relative">
                            <img src="{{url('admin/img/no_foto_kamar.jpg')}}" class="card-img-top" alt="image">
                        </a>
                        @else
                        <a href="{{ route('detailCustomer.show',$k->unique_id) }}" class="position-relative">
                            <img src="{{url('admin/img')}}/{{$k->foto_kamar}}" class="card-img-top" alt="image">
                        </a>
                        @endempty
                        <div class="card-body">
                            <div class="d-flex align-content-center align-items-center justify-content-between">
                                <span class="font-weight-small">{{$k->nama_kost}}</span>
                                <div class="d-flex align-items-center align-content-center">
                                    <span class="star fas fa-star text-warning"></span>
                                    <span class="star fas fa-star text-warning"></span>
                                    <span class="star fas fa-star text-warning"></span>
                                    <span class="star fas fa-star text-warning"></span>
                                    <span class="star fas fa-star text-warning"></span>
                                    <span class="rate">(5.0)</span>
                                </div>
                            </div>
                            <div class="post-meta">
                                <span class="small lh-120">
                                    <i class="fas fa-map-marker-alt mr-2">
                                    </i>{{$k->alamat_kost}}
                                </span>
                            </div>
                            <a href="{{ route('detailCustomer.show',$k->unique_id) }}"><button
                                    class="btn btn-primary bt">Lihat
                                    Kamar</button></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Button Open  -->
            <div class="row py-2">
                <div class="col text-center">
                    <a href="#" class="btn btn-outline-dark shadow mt-1">Lihat Semua</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kota -->
    <section class="pt-5 pb-5">
        <div class="header-tittle mb-4">
            <h4>Area Kost Terpopuler</h4>
        </div>

        <div class="container">
            <div class="row ">

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/bandung.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Bandung</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/jakarta.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Jakarta</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/jogja.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Yogyakarta</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/malang.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Malang</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/medan.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Medan</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="assets/image/kota/semarang.png" alt="">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                            <h5 class="card-title text-light">Semarang</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="row py-2 mb-5">
        <div class="col text-center">
            <a href="#" class="btn btn-outline-dark shadow mt-1">Lihat Semua</a>
        </div>
    </div>
</div>
<section class="pt-5 pb-5 testimoni">
    <div class="container">
        <div class="header-tittle mb-4">
            <h4>Testimoni</h4>
        </div>
        <div class="owl-carousel__nav float-right">
            <div class="d-inline owl-carousel__prev">&lt;</div>
            <div class="d-inline  owl-carousel__next">&gt;</div>
        </div>

        <div class="testimonial3 py-5">
            <div class="container">
                <!-- Row  -->
                <div class="owl-carousel owl-theme testi3 mt-4">
                    <!-- item -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-light mb-3">“Cum sociis natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus. Cras venene veliel vestibulum.”</h6>
                                <div class="d-block d-md-flex align-items-center">
                                    <span class="thumb-img"><img
                                            src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg"
                                            alt="wrapkit" class="rounded-circle" /></span>
                                    <div class="ml-3">
                                        <h6 class="mb-0 customer">Michelle Anderson</h6>
                                        <span>Gamers</span>
                                        <!-- <div class="font-10">
                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item -->
                    <!-- item -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-light mb-3">“Cum sociis natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus. Cras venene veliel vestibulum.”</h6>
                                <div class="d-block d-md-flex align-items-center">
                                    <span class="thumb-img"><img
                                            src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/2.jpg"
                                            alt="wrapkit" class="rounded-circle" /></span>
                                    <div class="ml-3">
                                        <h6 class="mb-0 customer">Mark mesty</h6>
                                        <span>Youtuber</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item -->
                    <!-- item -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-light mb-3">“Cum sociis natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus. Cras venene veliel vestibulum.”</h6>
                                <div class="d-block d-md-flex align-items-center">
                                    <span class="thumb-img"><img
                                            src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/3.jpg"
                                            alt="wrapkit" class="rounded-circle" /></span>
                                    <div class="ml-3">
                                        <h6 class="mb-0 customer">Limpsy adam</h6>
                                        <span>Mahasiswa Binus</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item -->
                    <!-- item -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-light mb-3">“Cum sociis natoque penatibus et magnis dis
                                    parturient montes, nascetur ridiculus mus. Cras venene veliel vestibulum.”</h6>
                                <div class="d-flex no-block align-items-center">
                                    <span class="thumb-img"><img
                                            src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg"
                                            alt="wrapkit" class="rounded-circle" /></span>
                                    <div class="ml-3">
                                        <h6 class="mb-0 customer">Michelle Anderson</h6>
                                        <span>BSI AJA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection