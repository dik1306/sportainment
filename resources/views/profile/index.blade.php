@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <img src="assets/img/img-order-page.png" alt="img-banner-profile" class="responsive" height="320">
    </div>
    <div class="container mt-3">
        @if ($user->no_hp == null)
        <div class="alert alert-danger alert-block" >
            Mohon isi nomor handphone yang terhubung dengan Whatsapp anda terlebih dahulu.
        </div>
        @endif
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
                        <div class="col-lg">
                            <div>
                                <a href="{{route('profile.id', $user->id)}}" class="btn btn-primary" style="float: right;">Edit Profile</a>
                            </div>
                            <h5 class="card-title mt-3">Profile Details</h5>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Nama Lengkap</div>
                                <div class="col-md-8">{{$user->name}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Email</div>
                                <div class="col-md-8">{{$user->email}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">No Hp</div>
                                <div class="col-md-8">{{$user->no_hp}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Asal Instansi</div>
                                <div class="col-md-8">{{$user->asal_instansi}}</div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection