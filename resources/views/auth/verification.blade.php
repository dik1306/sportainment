@extends ('layouts.app')

@section('content')
    <div class="container">
        <form class="login-box" role="form" action="{{route('verify.post')}}" method="post">
        @csrf
            <h4 >Verifikasi No HP</h4>
            <div class="sign-avatar">
                <img src="assets/img/secure.png" alt="" width="50px">
            </div>
            <p> Silahkan masukkan kode yang sudah dikirimkan via whatsapp </p>
            <div class="form-group">
                <input type="text" id="verification_code" name="verification_code" class="form-control" autofocus tabindex="1" placeholder="kode" />
            </div>
            <div class="d-grid gap-2 mt-3">
                <button type="submit" name="login" class="btn btn-primary">Kirim Kode</button>
            </div>
        </form>
    </div>
@endsection