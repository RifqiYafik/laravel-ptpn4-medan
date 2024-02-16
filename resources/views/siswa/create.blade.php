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
          <form action="{{route('siswa.store')}}" method="POST"
          enctype="multipart/form-data">
          @csrf
            <div class="card">
                <div class="card-header">Tambah Siswa Baru</div>

                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" value="{{ old('nama_siswa') }}">
                    @error('nama_siswa')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group my-2">
                    <label for="id_siswa">Nomor Induk Siswa Nasional</label>
                    <input type="number" name="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror" value="{{ old('id_siswa') }}">
                    @error('id_siswa')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group my-2 row">
                    <div class="col-md-6">
                        <label for="tmpt_lahir">Tempat Lahir</label>
                        <input type="text" name="tmpt_lahir" class="form-control @error('tmpt_lahir') is-invalid @enderror" value="{{ old('tmpt_lahir') }}">
                        @error('tmpt_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>

                  <div class="form-group my-2">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="l" @if(old('jenis_kelamin')=='l') selected @endif>Laki-laki</option>
                        <option value="p" @if(old('jenis_kelamin')=='p') selected @endif>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>


                  <div class="form-group my-2">
                    <label for="alamat">Alamat Siswa</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">
                    @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                 <div class="form-group my-2">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <select name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror">
                        <option value="">Pilih Sekolah</option>
                        @foreach (App\Models\Asal_Sekolah::all() as $asal_sekolah)
                            <option value="{{ $asal_sekolah->id }}" {{ old('asal_sekolah') == $asal_sekolah->id ? 'selected' : '' }}>
                                {{ $asal_sekolah->nama_sekolah }}
                            </option>
                        @endforeach
                    </select>
                    @error('asal_sekolah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                 </div>


                  <div class="form-group my-2">
                    <label for="penempatan">Penempatan</label>
                    <select name="penempatan" class="form-control @error('penempatan') is-invalid @enderror">
                        <option value="">Pilih Penempatan</option>
                        @foreach (App\Models\Penempatan::all() as $penempatan)
                            <option value="{{ $penempatan->id }}" {{ old('penempatan') == $penempatan->id ? 'selected' : '' }}>
                                {{ $penempatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('penempatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                    <div class="form-group my-2 row">
                    <div class="col-md-6">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror" value="{{ old('tgl_masuk') }}">
                        @error('tgl_masuk')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="tgl_keluar">Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror" value="{{ old('tgl_keluar') }}">
                        @error('tgl_keluar')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>


                  <div class="form-group my-2">
                    <label for="no_hp">Nomor Telepon</label>
                    <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                    @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group my-2">
                    <label for="image">Foto Siswa</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group my-3">
                    <button class="btn btn-outline-primary" type="submit" >Submit</button>
                    <a href="{{route('siswa.index')}}" class="btn btn-outline-secondary">Back</a>
                  </div>
                </div>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection
