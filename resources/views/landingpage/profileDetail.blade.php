@extends('landingpage.app')
@section('content')
<div class="wrapper" style=" background-color:#eee;">
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <section>
                    <div class="container py-2">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="#" alt="avatar" class="rounded-circle img-fluid"
                                            style="width: 150px;">
                                        <h5 class="my-3">{{$user->pekerjaan}}</h5>
                                        <p class="text-muted mb-1"></p>
                                        <p class="text-muted mb-4">{{$user->role}}</p>
                                        <div class="d-flex justify-content-center mb-2">
                                            <a href="/" class="btn bt ms-1 "><i
                                                    class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="mb-3 p-0">
                                            <a href="1" class="btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit
                                                Profile</a>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$user->name}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Pekerjaan</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"></p>
                                            </div>
                                        </div> --}}
                                        {{-- <hr> --}}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$user->telp}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$user->alamat}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection