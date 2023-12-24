@extends('admin.index')
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Forms</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Basic Form</a>
                    </li>
                </ul>
            </div>
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
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" action="{{ route('users.update',$user_edit->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class=" card-header">
                                <div class="card-title">Form Update Users</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 col-lg-6 ">
                                        <!-- start foto -->
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Foto User</label>
                                            <input name="foto_user" type="file" class="form-control-file"
                                                id="exampleFormControlFile1">
                                            @if(!empty($user_edit->foto_user)) <img
                                                src="{{ url('admin/img/users')}}/{{$user_edit->foto_user}}" width="20%"
                                                class="img-thumbnail">
                                            <br />{{$user_edit->foto_user}}
                                            @endif
                                        </div>
                                        <!-- end foto -->
                                        <div class="form-group">
                                            <label>Nama User</label>
                                            <input value="{{ $user_edit->name }}" name="name" type="text"
                                                class="form-control" placeholder="your name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="{{ $user_edit->email }}" name="email" type="text"
                                                class="form-control" placeholder="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Pekerjaan</label>
                                            <input value="{{ $user_edit->pekerjaan }}" name="pekerjaan" type="text"
                                                class="form-control" placeholder="pekerjaan">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telpon</label>
                                            <input value="{{ $user_edit->telp }}" name="telp" type="text"
                                                class="form-control" placeholder="telpon">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label>Password Lama</label> -->

                                            <input hidden value="{{Auth::user()->password}}" required type="password"
                                                class="form-control" placeholder="password">

                                        </div>
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input name="password" type="password" class="form-control"
                                                placeholder="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Password</label>
                                            <input name="password_konfirmasi" type="password" class="form-control"
                                                placeholder="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Role User</label>
                                            <select name="role" class="form-control" id="exampleFormControlSelect1">
                                                <option>admin</option>
                                                <option>customer</option>
                                                <option>pemilik</option>
                                            </select>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Silahkan masukan data yang
                                            valid!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a onclick="return confirm('Anda yakin ingin kembali ke table kost?')"
                                    href="{{url('fasilitas')}}" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</div>
@endsection