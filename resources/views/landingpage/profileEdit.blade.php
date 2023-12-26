@extends('landingpage.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Your Profile</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{route('customer-profile.update', $user->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">

                                    <label for="name" class="col-4 col-form-label">Nama</label>
                                    <div class="col-8">
                                        <input id="username" name="name" placeholder="Username"
                                            class="form-control here" required="required" type="text"
                                            value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="name" name="email" placeholder="First Name" class="form-control here"
                                            type="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-4 col-form-label">Pekerjaan</label>
                                    <div class="col-8">
                                        <input id="lastname" name="pekerjaan" placeholder="Last Name"
                                            class="form-control here" type="text" value="{{$user->pekerjaan}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-4 col-form-label">No. Telpon</label>
                                    <div class="col-8">
                                        <input id="text" placeholder="Nick Name" class="form-control here" name="telp"
                                            type="text" value="{{$user->telp}}">

                                        <input hidden id="text" name="role" placeholder="Nick Name"
                                            class="form-control here" type="text" value="{{$user->role}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button type="submit" class="btn btn-update">Update My
                                            Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection