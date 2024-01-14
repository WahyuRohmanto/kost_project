@extends('landingpage.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row">
        @include('landingpage.sidebar')
        <div class="col-10 p-5" id="main">
            <div class="content">
                <div class="page-inner">
                    {{-- form validation --}}
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
                    {{-- end validation form --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card ">
                                <form method="POST" action="{{ route('data-pemilik.update',$detail_kamar->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div style="background-color: #11296b;"
                                        class="card-header text-light d-flex align-center">
                                        <div class="card-title fw-bold">Form update pemilik kost</div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- table kost --}}
                                                <div class="form-group">
                                                    <label>Nama Kost</label>
                                                    <input value="{{$detail_kamar->nama_kost}}" name="nama_kost"
                                                        type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Luas Kamar</label>
                                                    <input value="{{$detail_kamar->luas_kamar}}" name="luas_kamar"
                                                        type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga Kamar</label>
                                                    <input value="{{$detail_kamar->harga_kamar}}" name="harga_kamar"
                                                        type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <input value="{{ $detail_kamar->keterangan }}" name="keterangan"
                                                        type="text" class="form-control" placeholder="keterangan">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Foto Kamar</label>
                                                    <input value="{{$detail_kamar->foto_kamar}}" name="foto_kamar"
                                                        type="text" class="form-control" placeholder="">
                                                </div> -->

                                                <div class="form-group">
                                                    <label for="exampleFormControlFile1">Foto Kamar</label>
                                                    <input name="foto_kamar" type="file" class="form-control-file"
                                                        id="exampleFormControlFile1">
                                                    @if(!empty($detail_kamar->foto_kamar)) <img
                                                        src="{{ url('admin/img')}}/{{$detail_kamar->foto_kamar}}"
                                                        width="20%" class="img-thumbnail">
                                                    <br />{{$detail_kamar->foto_kamar}}
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Fasilitas</label>
                                                    <select name="id_fasilitas" class="form-control">
                                                        @foreach($fasilitas as $fs)
                                                        @if($fs->id === $detail_kamar->id_fasilitas)
                                                        <option value="{{$detail_kamar->id_fasilitas}}">
                                                            {{$fs->fasilitas}}</option>
                                                        @endif
                                                        @endforeach
                                                        @foreach($fasilitas as $fs)
                                                        <option value="{{$fs->id}}">
                                                            {{$fs->fasilitas}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class=" form-group">
                                                    <label>Kota</label>
                                                    <select name="kota_id" class="form-control">
                                                        @foreach($kota as $kt)
                                                        @if($kt->id === $detail_kamar->kota_id)
                                                        <option value="{{$detail_kamar->kota_id}}">
                                                            {{$kt->nama_kota}}</option>
                                                        @endif
                                                        @endforeach
                                                        @foreach($kota as $kt)
                                                        <option value="{{$kt->id}}">
                                                            {{$kt->nama_kota}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Kost</label>
                                                    <input value="{{$detail_kamar->alamat_kost}}" name="alamat_kost"
                                                        type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <input hidden value="{{$detail_kamar->id_user}}" name="id_user"
                                                        type="text" class="form-control" placeholder="">
                                                </div>
                                                <small id="emailHelp" class="form-text text-muted">Silahkan masukan
                                                    data yang
                                                    valid!</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex item-center justify-content-justify">
                                        <div class="card-action pl-4">
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                </form>
                                <div class="card-action p-4 pt-0">
                                    <form class="card-action" action="{{url('data-pemilik')}}">
                                        <a name="_method" class="btn btn-danger show_confirm">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- Custom template | don't include it in your project! -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
$('.show_confirm').click(function(event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
            title: `Yakin ingin kembali?`,
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});
</script>
</div>
@endsection