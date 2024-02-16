@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if(Session::has('message'))
          <div class="alert alert-success">
            {{Session::get('message')}}
          </div>
          @endif
            <div class="card">
    <div class="card-header">
        <div class="pt-2">
            <h4>Daftar Nama Sekolah</h4>
        </div>
        <div class="d-flex align-items-center">
            <div class="input-group" style="width: 680px;">
                <input type="text" class="form-control" placeholder="Cari nama sekolah" id="searchInput">
            </div>
            <div class="ms-2">
                <a href="{{route('asal_sekolah.create')}}" class="btn btn-outline-primary">Tambah Sekolah</a>
            </div>
        </div>
    </div>
</div>

                <div class="card-body">
                    <table class="table table-hover text-center">
                      <thead class="table-dark text-center">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Sekolah</th>
                          <th scope="col">Alamat</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Hapus</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($sekolahs)>0)
                        @foreach($sekolahs as $key=>$sekolah)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{$sekolah->nama_sekolah}}</td>
                          <td>{{$sekolah->alamat_sekolah}}</td>

                          <td>
                            <a href="{{route('asal_sekolah.edit',[$sekolah->id])}}">
                            <button class="btn btn-outline-warning">Edit</button></a>
                          </td>
                          <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$sekolah->id}}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$sekolah->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('asal_sekolah.destroy', [$sekolah->id])}}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">PERINGATAN !!!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin ingin Menghapus?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">Ya</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <script>
                                console.log('ID Sekolah: ', {{$sekolah->id}});
                            </script>
                          </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="7">TIDAK ADA NAMA SEKOLAH YANG BISA DITAMPILKAN</td>
                        </tr>
                        @endif
                      </tbody>

                    </table>
                    {{$sekolahs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        searchTable();
    });

    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Kolom 1 (Name)

            if (td) {
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@endsection
