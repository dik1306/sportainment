@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0">Home</h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
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
                    <h3 class="card-title">Artikel Sportainment</h3>
                </div>
                <!-- /.card-header -->
                <div class="d-grid text-right col-md-12 mt-3">
                    <a href="{{route('artikel.create')}}"
                        class="btn btn-outline-primary btn-sm text-small text-xs mr-3"
                        style="padding-top:5px!important">
                        <i class="fa fa-plus"></i>
                        INPUT
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr style="border: 1px solid">
                            <th>No</th>
                            <th>File Gambar</th>
                            <th>Judul</th>
                            <th>Isi Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artikel as $item)
                            <tr>
                                <td>
                                    <span> {{$loop->iteration}} </span>
                                </td>
                                <td>
                                    <img src="{{asset($item->image)}}" width="150" >
                                </td>
                                <td>
                                    <span> {{$item->judul}} </span>
                                </td>
                                <td>
                                    <span> {{$item->isi_artikel}} </span>
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