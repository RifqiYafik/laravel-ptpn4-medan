@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (Session::has('message'))
            <div class="alert alert-success">
              {{Session::get('message')}}
            </div>
            @endif
            <form action="{{route('asal_sekolah.store')}}" method="POST"
            enctype="multipart/form-data">
            @csrf
                <div class="card">
                    <div class="card-header">Tambah Sekolah</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror">
                            @error('nama_sekolah')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group my-3">
                            <label for="alamat_sekolah">Alamat Sekolah</label>
                            <input type="text" name="alamat_sekolah" class="form-control @error('alamat_sekolah') is-invalid @enderror">
                            @error('alamat_sekolah')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group my-3">
                            <button class="btn btn-outline-primary" type="submit" >Submit</button>
                            <a href="{{route('asal_sekolah.index')}}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
