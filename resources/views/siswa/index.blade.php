@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="pt-2">
                        <h4>Daftar Semua Siswa</h4>
                    </div>
                    <div class="d-flex flex-direction-row align-items-center">
                        <div class="input-group" style="width: 985px;">
                            <input type="text" class="form-control" placeholder="Cari Nama atau NPM" id="searchInput">
                        </div>
                        <div class="mx-2">
                            <a href="{{url('siswa/view/pdf')}}" class="btn btn-outline-success">Cetak Data Siswa</a>
                        </div>
                        <div>
                            <a href="{{route('siswa.create')}}" class="btn btn-outline-primary">Tambah Siswa</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">TTL</th>
                                    <th scope="col">J.Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Asal Sekolah</th>
                                    <th scope="col">Penempatan</th>
                                    <th scope="col">Tgl. Masuk</th>
                                    <th scope="col">Tgl. Keluar</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($siswas)>0)
                                    @foreach($siswas as $key=>$siswa)
                                        <tr>
                                            <td scope="row">{{$loop->iteration}}</td>
                                            <td><img src="{{asset('image/'.$siswa->image)}}" width="80"></td>
                                            <td>{{$siswa->nama_siswa}}</td>
                                            <td>{{$siswa->id_siswa}}</td>
                                            <td>{{$siswa->tmpt_lahir}}, {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y')}}</td>
                                            <td>{{$siswa->jenis_kelamin}}</td>
                                            <td>{{$siswa->alamat}}</td>
                                            <td>{{$siswa->asal_sekolah->nama_sekolah ?? 'None'}}</td>
                                            <td>{{$siswa->penempatan->name ?? 'None'}}</td>
                                            <td>{{ \Carbon\Carbon::parse($siswa->tgl_masuk)->format('d-m-Y')}}</td>
                                            <td>{{ \Carbon\Carbon::parse($siswa->tgl_keluar)->format('d-m-Y')}}</td>
                                            <td>0{{$siswa->no_hp}}</td>
                                            <td>
                                                <a href="{{route('siswa.edit',[$siswa->id])}}" class="btn btn-outline-warning">Edit</a>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$siswa->id}}">
                                                    Hapus
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$siswa->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{route('siswa.destroy', [$siswa->id])}}" method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">PERINGATAN !!!</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda Yakin Ingin Menghapus?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">Ya</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12" class="text-center py-5">TIDAK ADA SISWA YANG DAPAT DITAMPILKAN</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- {{$siswas->onEachSide(5)->links()}} --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi ini akan dipanggil setiap kali pengguna mengetik
    document.getElementById('searchInput').addEventListener('input', function() {
        searchTable();
    });

    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            var found = false;

            for (j = 2; j <= 3; j++) { // Kolom 2 (Nama Siswa) dan 3 (NISN)
                if (td[j]) {  // Pastikan td[j] tidak undefined
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>
@endsection
