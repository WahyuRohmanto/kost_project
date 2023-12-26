@extends('landingpage.app')
@section('content')
@php
$d_fasilitas = App\Models\Fasilitas::all();
$t_user = App\Models\User::all();
$kota = App\Models\Kota::all();
@endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <!-- form validation -->

            <!-- end validation form -->
            <div class="row">
                @include('landingpage.sidebar')
                <div class="col">
                    <div class="card">
                        <form method="POST" action="{{ route('kost.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class=" card-header">
                                <div class="card-title">Form Data Kost</div>
                                <div class="text-danger">
                                    @if ($errors->any())
                                    <strong>Whoops!</strong> Terjadi Kesalahan saat input data<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group">
                                            <label>Nama Kost</label>
                                            <input name="nama_kost" type="text" class="form-control"
                                                placeholder="nama kost">
                                        </div>
                                        <div class="form-group">
                                            <label>Luas Kamar</label>
                                            <input name="luas_kamar" type="text" class="form-control"
                                                placeholder="luas kamar">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Kamar</label>
                                            <input name="harga_kamar" type="number" class="form-control"
                                                placeholder="harga kamar">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input name="keterangan" type="text" class="form-control"
                                                placeholder="keterangan">
                                        </div>

                                        <!-- <div class="form-group">
                                            <label>User</label>
                                            <select name="id_user" class="form-control">
                                                @foreach($t_user as $usr)
                                                @if($usr->role === 'pemilik')
                                                <option value="{{$usr->id}}">{{$usr->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div> -->

                                        <input name="id_user" hidden value="{{auth()->id()}}">

                                        <div class=" form-group">
                                            <label>Kota</label>
                                            <select name="kota_id" class="form-control">
                                                @foreach($kota as $kt)
                                                <option value="{{$kt->id}}">{{$kt->nama_kota}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Fasilitas</label>
                                            <select name="id_fasilitas" class="form-control"
                                                id="exampleFormControlSelect1">
                                                @foreach($d_fasilitas as $fas)
                                                <option value="{{$fas->id}}">{{$fas->fasilitas}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Foto Kamar</label>
                                            <input name="foto_kamar" type="file" class="form-control-file"
                                                id="exampleFormControlFile1">
                                        </div>

                                        <div class="form-group">
                                            <label for="comment">Alamat</label>
                                            <textarea name="alamat_kost" class="form-control" id="comment"
                                                rows="5"></textarea>
                                        </div>
                                        <input type="hidden" name="unique_id" value="{{ Str::uuid() }}  ">
                                        <small id=" emailHelp" class="form-text text-muted">Silahkan masukan data yang
                                            valid!</small>
                                        <div class="card-action mt-3">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a href="{{url('data-pemilik')}}" class="btn btn-danger">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection