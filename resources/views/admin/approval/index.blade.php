@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Approval</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Approval Sportainment</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr style="border: 1px solid">
                            <th>No</th>
                            <th>Kode Sewa</th>
                            <th>Nama Penyewa</th>
                            <th>Lapangan</th>
                            <th>Tanggal Mulai</th>
                            <th>Biaya</th>
                            <th>Status</th> 
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_order as $item)
                            <tr>
                                <td>
                                    <span> {{$loop->iteration}} </span>
                                </td>
                                <td>
                                    <span> {{$item->id}} </span>
                                </td>
                                <td>
                                    <span> {{$item->nama_penyewa}} </span>
                                </td>
                                <td>
                                    {{-- <span> {{$item->orderDetail->id_lapangan}} </span> --}}
                                </td>
                                <td>
                                    <span> {{$item->nama_penyewa}} </span>

                                </td>
                                <td>
                                    <span> {{number_format($item->total_harga)}} </span>
                                </td>
                                <td>
                                    @if ($item->status_approval == 1) 
                                        <span style="background: yellow"> Menunggu Approval </span>
                                    @elseif ($item->status == 2) 
                                        <span> Disetujui </span>
                                    @else 
                                        <span> Ditolak </span>
                                    
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <form action="{{ route('admin.setuju', $item->id) }}" method="POST" >
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success mr-2">
                                            <i class="fa fa-check text-sm"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.batal', $item->id) }}" method="POST" >
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-danger mr-2">
                                            <i class="fa fa-times text-sm"></i>
                                        </button>
                                    </form>                                     
                                </td>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection