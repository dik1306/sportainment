<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportainment Rabbani</title>

    <!-- Favicon -->
    <link href="{{asset ('assets/img/logo-sportainment-bg.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"  type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset ('assets/lib/flaticon/font/flaticon.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset ('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset ('assets/lib/animate/animate.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset ('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset ('assets/css/style.css')}}" rel="stylesheet">
    

    {{-- calendar --}}
    <link rel="stylesheet" href="{{asset ('admin/plugins/fullcalendar/main.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"  />

</head>


<body>
    <div>
        <nav>
            @if (Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' || Route::currentRouteName() == 'verification' )
                @include('layouts.navbars.no_menu')
            @else 
                @include('layouts.navbars.navbar')
            @endif
        </nav>

        <main>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">	
                <strong>{{ $message }}</strong>
            </div>
            @endif
      
          @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">	
              <strong>{{ $message }}</strong>
            </div>
          @endif
      
          @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">	
              <strong>{{ $message }}</strong>
          </div>
          @endif
      
          @if ($message = Session::get('info'))
            <div class="alert alert-info alert-block">	
              <strong>{{ $message }}</strong>
            </div>
          @endif
      
          @if ($errors->any())
            <div class="alert alert-danger">	
              Please check the form below for errors
          </div>
          @endif
            @yield('content')
        </main>
          
        <script src="{{asset ('assets/js/main.js')}}"></script>
        <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="{{asset ('admin/plugins/moment/moment-with-locales.min.js')}}"></script>
        <script src="{{asset ('admin/plugins/fullcalendar/main.js')}}"></script>
        <script src="{{asset ('admin/plugins/fullcalendar/locales-all.js')}}"></script>
        <script src="{{asset ('admin/plugins/fullcalendar/locales-all.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/noframework.waypoints.min.js" integrity="sha512-wSIyQnPXWUgUNlSYdZKmOt99+I9FPAW7kJHIzUM5VhSDmROIwVmB4s+i/9p1YliZIAcKqdEgUOhOwO8u4piaaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    </div>
</body>
</html>