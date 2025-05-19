@extends ('layouts.app')

@section('content')
    <div class="container">
        <form class="login-box" role="form" action="{{ route('login')}}" method="post">
        @csrf
            <h4 >Welcome Back</h4>
            <div class="sign-avatar">
                <img src="assets/img/running.png" alt="" width="50px">
            </div>
            <p> Silahkan masuk dengan akun anda </p>
            <div class="form-group">
                <input type="text" id="email" name="email" class="form-control" autofocus tabindex="1" placeholder="email" />
            </div>
            <div class="form-group my-3">
                <input type="password" class="form-control" id="password" name="password" tabindex="2" placeholder="Password" />
            </div>
            <p style="text-align: right;"><a href="#" class="text-secondary">Lupa password ?</a></p>
            <br>
            <div class="d-grid gap-2">
                <button type="submit" name="login" class="btn btn-primary">Log in</button>
                <a href="{{route ('auth.google')}}" class="btn btn-login" type="button"> <i class="fa-brands fa-google" style="color: #AE65F6"></i> Log in With Google</a>
            </div>
            <p class="mt-3">Belum Punya Akun ? <a href="{{route ('register')}}" class="text-secondary"><b> Daftar </b> </a></p>
        </form>
    </div>
@endsection