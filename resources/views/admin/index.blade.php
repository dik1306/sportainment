@extends('admin.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data MPP PO</h3>
              </div>
              <!-- /.card-header -->
              <div class="d-grid text-right col-md-12 mt-3">
                <a href=""
                    class="btn btn-dim btn-outline-primary btn-sm text-small text-xs"
                    style="padding-top:5px!important">
                    <i class="fa fa-plus"></i>
                    INPUT
                </a>
            </div>
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No MPP</th>
                      <th>Nama Debitur</th>
                      <th>Alamat Debitur</th>
                      <th>Nilai Pengajuan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>            
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
