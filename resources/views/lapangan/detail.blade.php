@extends ('layouts.app')

@section('content')

    <div class="container-fluid">
        <img src="{{asset ('assets/img/detail_lapangan.png')}}" class="responsive ">
        <div class="centered">
            <h2 class="text-white text-uppercase">Detail Lapangan</h2>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row mt-4">
            <div class="col-md-5">
                <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="{{asset ($lapangan->img_1)}}" class="d-block w-100" alt="{{asset ($lapangan->img_1)}}">
                      </div>
                      <div class="carousel-item">
                        <img src="{{asset ($lapangan->img_2)}}" class="d-block w-100" alt="{{asset ($lapangan->img_2)}}">
                      </div>
                      <div class="carousel-item">
                        <img src="{{asset ($lapangan->img_1)}}" class="d-block w-100" alt="{{asset ($lapangan->img_1)}}">
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>    
                  {{-- <img src="{{asset ($lapangan->img_1)}}" class="responsive-detail" alt="photo {{$lapangan->img_1}}">                     --}}
            </div>
            <div class="col-md-7">
                <div >
                    @if ($lapangan->id_lapang == 1)
                        <h1 class="txt-contact">Futsal / Basket</h1>
                    @else 
                        <h1 class="txt-contact">{{$lapangan->jenis_lapang}}</h1>
                    @endif
                </div>
                {{-- <p class="my-3"> Lorem ipsum dolor sit amet consectetur. Est a sed gravida at in aliquet orci auctor. 
                    Purus risus ultrices diam cursus scelerisque amet feugiat. Quam lectus vitae gravida volutpat donec viverra. 
                    Quis mauris donec lectus eu suspendisse sagittis tellus. Metus enim habitant consequat accumsan.
                </p> --}}
                <div class="mt-5">
                    <div id="calendar"></div>
                </div>
                <div class="slideInUp mt-3" data-wow-delay="0.6s">
                    @foreach ($list_lapangan as $lapang)                        
                    <div class="accordion" id="accordion-{{$lapang->id}}">
                        <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{$lapang->id}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$lapang->id}}" aria-expanded="true" aria-controls="collapse-{{$lapang->id}}">
                            {{$lapang->nama}}
                            </button>
                        </h2>
                        <div id="collapse-{{$lapang->id}}" class="accordion-collapse collapse" aria-labelledby="heading-{{$lapang->id}}" data-bs-parent="#accordion-{{$lapang->id}}">
                            <div class="accordion-body">
                                <table class="table text-center" style="vertical-align:middle;font-size:13px;">
                                    <thead class="text-start">
                                        <tr>
                                            <th colspan="4">
                                            <h6 class="resDate"></h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="jadwal">
                                        @foreach ($sesi as $item)
                                            <tr class="lapang_sesi-{{$item->sesi}}-{{$lapang->id}} list-jadwal session-{{$item->sesi}}">
                                                <td class="col-md-3 col-6" >Sesi {{$item->sesi}} <br> <span><b class="jam_mulai">{{$item->jam_mulai}}</b> - <b>{{$item->jam_selesai}}</b></span> </td>
                                                <td class="col-md-3 col-6 status" > TERSEDIA
                                                </td>
                                                <td class="price col-md-3 col-6" id="price-{{$lapang->id}}-{{$item->sesi}}"> 
                                                 {{-- <b class="price-weekday" style="display: none"> Rp
                                                    @if  ($item->sesi < 10 )
                                                {{number_format($lapang->harga_weekday_perjam_1)}}
                                                    @else
                                                {{number_format($lapang->harga_weekday_perjam_2)}}
                                                    @endif
                                                </b>
                                                <b class="price-weekend" style="display: none"> Rp
                                                    @if ($item->sesi < 10 )
                                                {{number_format($lapang->harga_weekend_perjam_1)}}
                                                    @else
                                                {{number_format($lapang->harga_weekend_perjam_2)}}
                                                    @endif
                                                </b> --}}
                                                </td>
                                                <td class="col-md-3 col-6">
                                                    
                                                    @if (Auth::check())
                                                    {{-- <button onclick="addToCart('{{$lapang->id}}', '{{$item->sesi}}', '{{$lapang->nama}}', '{{$item->jam_mulai}}', '{{$item->jam_selesai}}')" class="btn btn-sm btn-primary booking-btn" id="book-btn-{{$lapang->id}}-{{$item->sesi}}"><i class="fas fa-shopping-cart"></i> Book Now</button> --}}
                                                    <button class="btn btn-sm btn-danger text-xs remove-btn" id="remove-btn-{{$lapang->id}}-{{$item->sesi}}" style="display: none"><i class="fas fa-trash" aria-hidden="true"></i> Remove</button>
                                                    @else
                                                    <a href="{{route('login')}}" class="btn btn-sm btn-warning " style="font-size: 11px"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Book Now (Sign!)</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <form action="{{route('checkout')}}" method="POST">
                    @csrf
                        <div class="mt-3" id="checkout">
                            <input type="hidden" id="isWeekend" name="isWeekend" class="isWeekend">
                            <input type="hidden" id="dateSelected" name="dateSelected" class="dateSelected">
                            <input type="hidden" id="cart" name="cart">
                            <button type="submit" class="btn btn-primary form-control mb-3" id="checkout-btn" style="display: none">
                                <i class="fas fa-shopping-cart" aria-hidden="true"></i><b class="checkout"> Checkout {{session('cart') ? count(session('cart')) : ''}}</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset ('admin/plugins/fullcalendar/locales/id.js')}}"></script>
    <script>
       var cart = [];
       document.addEventListener('DOMContentLoaded', function() {
         var calendarEl = document.getElementById('calendar');
         var dateSelected = moment().format('dddd, Do MMMM YYYY');
         $('.resDate').html(dateSelected);
         $('.dateSelected').val(moment().format('yyyy-MM-DD'));
         var today = new Date

         var dayOfWeek = (today).getDay();
         var is_weekend = (dayOfWeek === 6 ) || (dayOfWeek === 0)
       
           if(!is_weekend){
               $('.price-weekend').hide();
               $('.price-weekday').show();
           } else {
               $('.price-weekend').show();
               $('.price-weekday').hide();
           }
           
           var current_time = moment().format('HH');

           $.ajax({
               url: '/sesi',
               type: 'GET',
               success: function (res) {
                   res.forEach(function (item) {
                    // console.log(item);
                       var jam_mulai = item.jam_mulai;
                       jam_mulai = jam_mulai.split(':')[0];
                       if (jam_mulai <= current_time) {
                           $('.session-'+item.sesi).addClass('bg-offer');
                           $('.session-'+item.sesi+' .price-weekday').hide();
                           $('.session-'+item.sesi+' .price-weekend').hide();
                           $('.session-'+item.sesi+' .status').html('TIDAK TERSEDIA');
                           $('.session-'+item.sesi+' .booking-btn').hide();

                       }
                   })
               }
           })
       
           $.ajax({
               url: '/jadwal/' + today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate(),
               type: 'GET',
               success: function (response) {
                   response.forEach(function (item) {
                       if (item.order) {
                           $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan).addClass('bg-offer');
                           $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .price-weekday').hide();
                           $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .price-weekend').hide();
                           $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .status').html(item.order.nama_penyewa);
                           $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .booking-btn').hide();
                       }
                   })
               }
           });

         var calendar = new FullCalendar.Calendar(calendarEl, 
         {
           locale: 'id',
           initialView: 'dayGridMonth',
           selectable: true,
           validRange: {
               start: new Date()
           },
           
           dateClick: function (info) {
               console.log(info);
               moment.locale('id');
               var dateSelected = moment(info.dateStr).format('dddd, Do MMMM YYYY');
               var today = moment(calendar.getDate()).format('yyyy-MM-DD');
               var dayOfWeek = (info.date).getDay();
               var isWeekend = (dayOfWeek === 0) || (dayOfWeek === 6)
               
               $('.isWeekend').val(isWeekend);
               if(!isWeekend){
                   $('.price-weekend').hide();
                   $('.price-weekday').show();
               } else {
                   $('.price-weekend').show();
                   $('.price-weekday').hide();
               }
               
               $('.resDate').html(dateSelected );
               $('.dateSelected').val(info.dateStr);

               //show all book btn
               $('.booking-btn').show();
               $('.remove-btn').hide();
               //filter cart by date
               cartByDate = cart.filter(data => data.tanggal === info.dateStr);
               //foreach item
               cartByDate.forEach((data) => {
                   //set btn visibility
                   $('#book-btn-'+data.id_lapang+'-'+data.id_sesi).hide();
                   $('#remove-btn-'+data.id_lapang+'-'+data.id_sesi).show();
                   $('#remove-btn-'+data.id_lapang+'-'+data.id_sesi).attr('onclick', "remove_cart('"+data.id_booking+"',"+data.id_lapang+","+data.id_sesi+")");
               })

               $('.list-jadwal').removeClass('bg-offer');
               $('.status').html('TERSEDIA');

               $.ajax({
                   url: '/jadwal/' + info.dateStr,
                   type: 'GET',
                   success: function (response) {
                       response.forEach(function (item) {
                           if (item.order) {
                               $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan).addClass('bg-offer');
                               $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .price-weekday').hide();
                               $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .price-weekend').hide();
                               $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .status').html(item.order.nama_penyewa);
                               $('.lapang_sesi-'+item.id_sesi+'-'+item.id_lapangan+' .booking-btn').hide();
                           }
                       })
                   }
               })

           },
       });
       calendar.render();
       
   });

   function generate_id_booking (lapang, sesi, tanggal) {
        const today = new Date(tanggal);
        const number = Math.floor(Math.random() * 1000);
        
        const id_booking = "SAR" + today.getFullYear() + (today.getMonth() + 1) + today.getDate() + lapang + sesi + number;

        return id_booking

    }

    function addToCart (id_lapang, id_sesi, nama_lapang, jam_mulai, jam_selesai) {

        $("#checkout-btn").show();
        
        const id_booking = generate_id_booking( id_lapang, id_sesi, $('.dateSelected').val());
        const isWeekend = $('.isWeekend').val();
        if (isWeekend == 'true') {
            var price = $(`#price-${id_lapang}-${id_sesi} .price-weekend`).text();
        } else {
            var price = $(`#price-${id_lapang}-${id_sesi} .price-weekday`).text();
        }
        var price = price.replace('Rp','');
        var price = price.replace(/\,/g,'');
        price = parseInt(price);
        const tanggal = $('.dateSelected').val();
        if (tanggal == '' || tanggal == null){
            alert('silahkan pilih tanggal terlebih dahulu');
        } else {
            const data = {
                id_lapang: id_lapang,
                id_sesi: id_sesi,
                id_booking: id_booking,
                nama_lapang: nama_lapang,
                tanggal: tanggal,
                isWeekend: isWeekend,
                price: price,
                jam_mulai: jam_mulai,
                jam_selesai: jam_selesai
            }
    
            cart.push(data);
            
            $('.checkout').html("Checkout " + cart.length);
    
            $('#cart').val(JSON.stringify(cart));
            $('#book-btn-'+id_lapang+'-'+id_sesi).hide();
            $('#remove-btn-'+id_lapang+'-'+id_sesi).attr('onclick', "remove_cart('"+id_booking+"',"+id_lapang+","+id_sesi+")");
            $('#remove-btn-'+id_lapang+'-'+id_sesi).show();
        }
    }

    function checkout () {
        $.post('/checkout', 
        {cart: cart,
        _token: '{{ csrf_token() }}'
        },
        function (response) {
        })
    }

    function remove_cart (id_booking, id_lapang, id_sesi) {
        cart = cart.filter(data => data.id_booking !== id_booking);
        $('#book-btn-'+id_lapang+'-'+id_sesi).show();
        $('#remove-btn-'+id_lapang+'-'+id_sesi).hide();

        $('#cart').val(JSON.stringify(cart));

        if(cart.length>0)
            $('.checkout').html("Checkout " + cart.length);
        else
            $('#checkout-btn').hide();
    }
   </script>
@endsection