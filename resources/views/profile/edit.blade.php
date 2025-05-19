@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <img src="{{asset ('assets/img/img-order-page.png')}}" alt="img-banner-profile" class="responsive" height="320">
    </div>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-menu">
                            <a class="nav-link border fw-normal" href="/profile">PROFILE</a>
                            <a class="nav-link border fw-normal" href="/order">ORDERS</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body mb-3 row">
                        <form role="form" action="{{route('profile.update', $user->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="col-md">
                                <div class="row">
                                    <div class="col-md-4 label fw-semibold">Nama Lengkap</div>
                                    <div class="col-md-8">
                                        <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 label fw-semibold">Email</div>
                                    <div class="col-md-8">
                                        <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 label fw-semibold">No Hp</div>
                                    <div class="col-md-8">
                                        <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{$user->no_hp}}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4 label fw-semibold">Asal Instansi</div>
                                    <div class="col-md-8">
                                        <input type="text" id="asal_instansi" name="asal_instansi" class="form-control" value="{{$user->asal_instansi}}" required>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                    <a href="{{route('profile')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection