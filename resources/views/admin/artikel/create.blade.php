@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="card shadow mt-3">
                <div class="card-header">
                    <h2>Tambah Artikel</h2>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <form action="{{ route('artikel.store') }}" method="POST" name="form_artikel" enctype="multipart/form-data">
                        @csrf @method('POST')
                        <div class="form-group">
                            <div class="row">
                                <label for="image" class="form-control-label col-3">Gambar</label>
                                <input type="file" name="image" id="image" class="form-control col-5">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="judul" class="form-control-label col-3">Judul Artikel</label>
                                <input type="text" name="judul" id="judul" class="form-control col-5" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="isi_artikel" class="form-control-label col-3">Isi Artikel</label>
                                <textarea name="isi_artikel" id="isi_artikel" class="form-control  col-5"> </textarea>
                            </div>
                        </div>
                        <div class="d-grid text-right col-md-9 mt-3">
                            <button type="submit" class="btn btn-dim btn-outline-primary btn-sm">Submit</button>
                            <a href="{{ route('artikel.index') }}" class="btn btn-dim btn-outline-danger btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection