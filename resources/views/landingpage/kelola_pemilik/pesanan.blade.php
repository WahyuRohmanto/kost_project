@extends('landingpage.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('landingpage.sidebar')
        <div class="col-10 p-5" id="main">
            <a title="Export to PDF" href="" class="btn btn-export btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fas fa-file-pdf"></i>
                </span>
                Export
            </a>
            <a title="Export to PDF" href="" class="btn ml-2 btn-print btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fa fa-print"></i>
                </span>
                Print
            </a>
            <table class="table table-hover">
                <thead style=" background-color: #11296b;">
                    <tr class="text-light">
                        @foreach($title as $tt)
                        <th>{{$tt}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach($pembayaran as $pm)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$pm->kode_bayar}}</td>
                        <td>{{$pm->name}}</td>
                        <td>{{$pm->tanggal_masuk}}</td>
                        <td>{{$pm->tanggal_keluar}}</td>
                        <td>Rp.{{number_format($pm->total_bayar, 0, ',', '.')}}</td>
                        @if($pm->status_pembayaran === "diproses")
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-warning text-light">
                                {{$pm->status_pembayaran}}</p>
                        </td>
                        @elseif($pm->status_pembayaran === "success")
                        <td>
                            <p style="border-radius: 500px;" class=" fw-bold text-center btn-success text-light">
                                {{$pm->status_pembayaran}}</p>
                        </td>
                        @else
                        <td>
                            <p style="border-radius: 500px;" class="fw-bold text-center btn-danger text-light">
                                {{$pm->status_pembayaran}}</p>
                        </td>
                        @endif

                        @if($pm->pesanan === "progress")
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-warning text-light">
                                {{$pm->pesanan}}</p>
                        </td>
                        @elseif($pm->pesanan === "diterima")
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-success text-light">
                                {{$pm->pesanan}}</p>
                        </td>
                        @else
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-danger text-light">
                                {{$pm->pesanan}}</p>
                        </td>
                        @endif


                        <td style="display: flex; justify-content: center; flex-direction: row; align-item: center;">
                            {{-- Terima --}}
                            <form method="POST" action="{{ route('pembayaran.pembayaran_pemilik',  $pm->total_bayar) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input name="pesanan" hidden value="diterima" type="text" />
                                <button type="submit" data-toggle="tooltip" title="terima" class="btn btn-link btn-lg"
                                    data-original-title="terima"><i class="bi bi-check2-all"></i></button>
                            </form>
                            {{-- Tolak --}}
                            <form method="POST" action="{{ route('pembayaran.pembayaran_pemilik',  $pm->total_bayar) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input name="pesanan" hidden value="ditolak" type="text" />
                                <button type="submit" data-toggle="tooltip" title="tolak"
                                    class="btn text-danger btn-link btn-lg" data-original-title="ditolak"><i
                                        class="bi bi-backspace-reverse"></i></button>
                            </form>
                            {{-- Pogress --}}
                            <form method="POST" action="{{ route('pembayaran.pembayaran_pemilik',  $pm->total_bayar) }}"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input name="pesanan" hidden value="progress" type="text" />
                                <button type="submit" data-toggle="tooltip" title="pending"
                                    class="btn text-warning btn-link btn-lg" data-original-title="progress"><i
                                        class="bi bi-arrow-clockwise"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection