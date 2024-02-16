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
          <form action="{{ route('penempatan.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">Mengatur Penempatan Siswa PKL</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <button class="btn btn-outline-primary" type="submit" >Submit</button>
                        <a href="{{route('penempatan.index')}}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </form>

</div>

@endsection
