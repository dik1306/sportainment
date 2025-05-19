@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <img src="assets/img/img-order-page.png" alt="img-banner-profile" class="responsive" width="1640" height="320">
    </div>
    <div class="container">
        <div class="card shadow my-3">
            <div class="card-body row justify-content-center">
                <div class="col-sm-11" style="font-size:13px;">
                    <h5 class="card-title mt-3">Information Details</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Full Name</div>
                                <div class="col-md-8">{{auth()->user()->name}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Email</div>
                                <div class="col-md-8">{{auth()->user()->email}}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4 label fw-semibold">Phone</div>
                                <div class="col-md-8">
                                    @if(auth()->user()->no_hp)
                                        {{auth()->user()->no_hp}}
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-4 mb-0">

                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table class="table cart">
                            <thead>
                                <tr>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Sesi</th>
                                    <th>Harga</th>
                                    <th class="col-sm-2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="cart_list">
                                <?php $total = 0; ?>
                                @foreach($data as $idx => $item)
                                    <tr id="{{$item['id_booking']}}">
                                        <td id="nama_lapang">{{$item['nama_lapang']}}</td>
                                        <td>{{date('d-m-Y', strtotime($item['tanggal'])) }}</td>
                                        <td class="text-sm">Sesi {{$item['id_sesi']}} <br>{{$item['jam_mulai'] }} - {{$item['jam_selesai'] }}</td>
                                        <td>Rp {{number_format($item['price'])}}</td>
                                        <td><button class="btn btn-sm btn-danger text-xs" onclick="remove_cart('{{$idx}}','{{$item['id_booking']}}')" ><i class="fas fa-trash" aria-hidden="true"></i> Remove</button></td>
                                    </tr>
                                    <?php $total += $item['price']; ?>
                                @endforeach
                                <tr>
                                    <td colspan="3"><h6>Total Harga</h6></td>
                                    <td id="total_harga" colspan="2"><h6>Rp {{number_format($total)}} </h6></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3">
                                        <div class="form-group row">
                                            <div class="col-xl-5 col-md-7 col-7">
                                                <input type="text" class="form-control form-control-sm diskon" id="diskon" name="diskon" placeholder="Kode Diskon" >
                                            </div>
                                            <div class="col-sm-3 col-3">
                                                <button onclick="check_diskon()" class="btn btn-primary text-xs" >Apply</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" id="rpdiskon">Rp 0 </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <h6>Grand Total</h6>
                                    </td>
                                    <td colspan="2">
                                        <h6 id="rptotal">Rp {{number_format($total)}}</h6>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="5" class="text-end">
                                        @if (auth()->user()->no_hp == null)
                                            <a href="{{route('profile')}}" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-money-bill-wave" aria-hidden="true" ></i> Booking</a>
                                        @else
                                        <form action="{{route('booking.store')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="data" id="data" value="{{json_encode($data)}}">
                                            <input type="hidden" name="fix_total" id="fix_total" value="{{$total}}">
                                            <input type="hidden" name="fix_diskon" id="fix_diskon" value="0">
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-wave" aria-hidden="true"></i> Booking</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        let arr_data = @json($data);
        // console.log(arr_data);

        function remove_cart(idx, id_booking){
            if(confirm('Are you sure want to remove this item?')){
                $('#'+id_booking).remove();
                arr_data = arr_data.filter(data => data.id_booking !== id_booking);
            }

            let total_harga = 0;
            arr_data.forEach(data => {
                total_harga += data.price;
            });

            $('#rptotal').html('Rp '+addCommas(total_harga));
            $('#fix_total').val(total_harga);
            $('#total_harga').html('Rp '+addCommas(total_harga));
            $('#fix_diskon').val(0);
            $('#rpdiskon').html('Rp 0');
            $('#diskon').val('');
            $('#data').val(JSON.stringify(arr_data));

        
        }

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        function check_diskon(){
            var diskon = $('#diskon').val();
            // alert(diskon);
            var total = $('#fix_total').val();
            var diskon0 = 0;
            
            $.ajax({
                url: '/diskon',
                type: 'GET',
                data: {
                    diskon: diskon
                },
                success: function(response){
                    if(response == 'Kode diskon tidak ditemukan'){
                        alert('Kode diskon tidak ditemukan');
                        $('#rpdiskon').html('Rp '+ diskon0);
                        $('#fix_diskon').val(diskon0);
                        grand_total =addCommas(total);
                        $('#rptotal').html('Rp '+ grand_total);
                        return;
                    }else{
                        diskon = addCommas(response.persentase * total / 100);
                        $('#rpdiskon').html( 'Rp '+ diskon);
                        $('#fix_diskon').val(parseInt(diskon.replace(/\,/g,'')));
                        grand_total = addCommas(total - response.persentase * total / 100);
                        $('#rptotal').html('Rp '+grand_total);
                    }
                }
            });
        }


        function checkout(){
            var grand_total = total_harga;
            // var grand_total = $('#rptotal').text().replace("Rp ", "");
            // grand_total = grand_total.replace(/\,/g,'');
            // grand_total = parseInt(grand_total);
            var diskon = $('#rpdiskon').text().replace("Rp ", "");
            diskon = diskon.replace(",", "");
            diskon = parseInt(diskon);

            // console.log(data);

            $.ajax({
                url: '/booking',
                type: 'POST',
                data: {
                    data: {!! json_encode($data) !!},
                    grand_total: grand_total,
                    diskon: diskon,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                   
                }
            });
        }
    </script>
@endsection