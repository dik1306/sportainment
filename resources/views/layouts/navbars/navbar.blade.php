 <!-- Navbar Start -->
 <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="/" class="navbar-brand ms-lg-5">
       <img src="{{asset ('assets/img/logo-sportainment.png')}}" alt="Logo" class="img-fluid" width="130px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="margin-right: 2rem" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="/" class="nav-item nav-link active">Home</a>
            <a onclick="clickAbout()" class="nav-item nav-link">About</a>
            <a onclick="clickCategory()" class="nav-item nav-link">Category</a>
            {{-- <a onclick="clickBooking()" class="nav-item nav-link">Booking</a> --}}
            <a onclick="clickContact()" class="nav-item nav-link">Contact</a>
            @if (Auth::check())
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link bg-secondary text-white px-3 dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user"></i>{{' Hi, '}}{{ auth()->user()->name}}</a>
                    <div class="dropdown-menu m-0">
                        <a href="/profile" class="dropdown-item">Profile</a>
                        <a href="/order" class="dropdown-item">Orders</a>
                        <div class="dropdown-divider"></div>
                        <form role="form" method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <div
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <span>{{ __('Logout') }}</span>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link nav-contact bg-secondary text-white px-4 ms-lg-3"><i class="fa fa-user"></i> Sign In</a>
            @endif
        </div>
    </div>
</nav>

<script>
    function clickAbout() {
        if (window.location.pathname === '/') {
            document.getElementById('about').scrollIntoView();
        } else {
            window.location.href = '/#about';
        }
    }

    function clickCategory() {
        if (window.location.pathname === '/') {
            document.getElementById('category').scrollIntoView();
        } else {
            window.location.href = '/#category';
        }
    }

    function clickBooking() {
        if (window.location.pathname === '/') {
            document.getElementById('booking').scrollIntoView();
        } else {
            window.location.href = '/#booking';
        }
    }

    function clickContact() {
        if (window.location.pathname === '/') {
            document.getElementById('contact').scrollIntoView();
        } else {
            window.location.href = '/#contact';
        }
    }
</script>
<!-- Navbar End -->
