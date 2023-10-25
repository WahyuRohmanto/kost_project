@extends('landingpage.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('landingpage.sidebar')
        <div class="col-10 p-5" id="main">
            <a title="Export to PDF" href="{{route('invoice')}}" class="btn btn-export btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fas fa-file-pdf"></i>
                </span>
                Export
            </a>
            <table class="table table-hover">
                <thead style=" background-color: #11296b;">
                    <tr class="text-light">
                        <th>Pemilik Kost</th>
                        <th>Nama Kost</th>
                        <th>Luas Kamar</th>
                        <th>Total Bayar</th>
                        <th style="width: 10%">Status Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $row)
                    @auth
                    @if(Auth::user()->name)
                    <tr>
                        <td>{{$row->kode_bayar}}</td>
                        <td>{{$row->nama_kost}}</td>
                        <td>{{$row->luas_kamar}}</td>
                        <td>{{$row->total_bayar}}</td>

                        @if($row->pesanan === "progress")
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-warning text-light">
                                {{$row->pesanan}}</p>
                        </td>
                        @elseif($row->pesanan === "diterima")
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-success text-light">
                                {{$row->pesanan}}</p>
                        </td>
                        @else
                        <td>
                            <p style="border-radius: 500px;" class="  fw-bold text-center btn-danger text-light">
                                {{$row->pesanan}}</p>
                        </td>
                        @endif
                    </tr>
                    @endif
                    @endauth
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection