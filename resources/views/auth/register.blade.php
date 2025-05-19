@extends ('layouts.app')

@section('content')
    <div class="container">
        <form class="register-box" role="form" action="{{ route('register') }}" method="POST">
        @csrf
            <h3 class="mb-3"> Daftarkan akun anda</h3>
            <div class="mb-4">
                <img src="assets/img/running.png" alt="" width="50px">
            </div>
            <div class="form-group">
                <input type="text" id="name" name="name" class="form-control" autofocus tabindex="1" placeholder="nama" />
            </div>
            <div class="form-group my-3">
                <input type="text" id="no_hp" name="no_hp" class="form-control" autofocus tabindex="2" placeholder="no hp" />
            </div>
            <div class="form-group my-3">
                <input type="text" id="email" name="email" class="form-control" autofocus tabindex="3" placeholder="email" />
            </div>
            <div class="form-group my-3">
                <input type="password" class="form-control" id="password" name="password" tabindex="4" placeholder="password" />
            </div>
            <br>
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary">Buat Akun</button>
            </div>
            <p class="mt-3">Sudah Punya Akun ? <a href="{{route ('login')}}" class="text-secondary"><b> Login </b> </a></p>
        </form>
    </div>
@endsection