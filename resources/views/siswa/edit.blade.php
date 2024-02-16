@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card">
                    <div class="card-header">
                        <div class="pt-2">
                            <h5>Edit Siswa</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" value="{{ old('nama_siswa', $siswa->nama_siswa) }}">
                            @error('nama_siswa')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                            <label for="id_siswa">Nomor Induk Siswa Nasional</label>
                            <input type="number" name="id_siswa" class="form-control" value="{{ old('id_siswa', $siswa->id_siswa) }}">
                            @error('id_siswa')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2 row">
                            <div class="col-md-6">
                                <label for="tmpt_lahir">Tempat Lahir</label>
                                <input type="text" name="tmpt_lahir" class="form-control" value="{{ old('tmpt_lahir', $siswa->tmpt_lahir) }}">
                                @error('tmpt_lahir')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group my-2">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="l" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'l' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="p" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'p' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                            <label for="alamat">Alamat Siswa</label>
                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $siswa->alamat) }}">
                            @error('alamat')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <select name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror">
                            <option value="" disabled>Pilih Sekolah</option>
                            @foreach($asal_sekolahs as $sekolah)
                                <option value="{{ $sekolah->id }}" {{ old('asal_sekolah', $siswa->sekolah_id) == $sekolah->id ? 'selected' : '' }}>{{ $sekolah->nama_sekolah }}</option>
                            @endforeach
                        </select>
                        @error('asal_sekolah')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                        <div class="form-group my-2">
                            <label for="penempatan">Penempatan</label>
                            <select name="penempatan" class="form-control @error('penempatan') is-invalid @enderror">
                                <option value="" disabled>Pilih Penempatan</option>
                                @foreach($penempatans as $penempatan)
                                    <option value="{{ $penempatan->id }}" {{ old('penempatan', $siswa->penempatan_id) == $penempatan->id ? 'selected' : '' }}>{{ $penempatan->name }}</option>
                                @endforeach
                            </select>
                            @error('penempatan')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2 row">
                            <div class="col-md-6">
                                <label for="tgl_masuk">Tanggal Masuk</label>
                                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', $siswa->tgl_masuk) }}">
                                @error('tgl_masuk')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $siswa->tgl_keluar) }}">
                                @error('tgl_keluar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group my-2">
                            <label for="no_hp">Nomor Telepon</label>
                            <input type="number" name="no_hp" class="form-control" value="{{ old('no_hp', $siswa->no_hp) }}">
                            @error('no_hp')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-2">
                            <label for="image">Foto Siswa</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <button class="btn btn-primary mr-2" type="submit">Update</button>
                            <a href="{{route('siswa.index')}}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
