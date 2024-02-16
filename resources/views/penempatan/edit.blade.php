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
          <form action="{{route('penempatan.update',[$penempatan->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="card">
                <div class="card-header">
                    <div class="pt-2">
                        <h5>Edit Penempatan</h5>
                    </div>
                </div>

                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control
                    @error('name') is-invalid @enderror"
                    value="{{$penempatan->name}}">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                <div class="form-group my-3">
                    <button class="btn btn-primary mr-2" type="submit">Update</button>
                    <a href="{{route('penempatan.index')}}" class="btn btn-outline-secondary">Back</a>
                </div>
        </div>
    </div>
  </form>
</div>

@endsection
