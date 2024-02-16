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
            <h4>Daftar Nama Penempatan</h4>
        </div>
        <div class="d-flex align-items-center">
            <div class="input-group" style="width: 650px;">
                <input type="text" class="form-control" placeholder="Cari nama penempatan" id="searchInput">
            </div>
            <div class="ms-2">
                <a href="{{route('penempatan.create')}}" class="btn btn-outline-primary">Tambah Penempatan</a>
            </div>
        </div>
    </div>
</div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover text-center">
                      <thead class="table-dark text-center">
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Tempat</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Hapus</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($penempatans)>0)
                        @foreach($penempatans as $key=>$penempatan)
                        <tr>
                          <td scope="row">{{$loop->iteration}}</td>
                          <td>{{$penempatan->name}}</td>
                          <td>
                            <a href="{{route('penempatan.edit',[$penempatan->id])}}">
                            <button class="btn btn-outline-warning">Edit</button></a>
                          </td>
                          <td>
                        <!-- Button trigger modal -->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$penempatan->id}}">
                            Hapus
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$penempatan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$penempatan->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('penempatan.destroy', $penempatan->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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
                        <script>
                            console.log('ID Penempatan: ', {{$penempatan->id}});
                        </script>
                        </td>
                        </tr>
                        @endforeach
                        @else
                        <td colspan="7">TIDAK ADA KATEGORI YANG DAPAT DITAMPILKAN</td>
                        @endif
                      </tbody>
                    </table>
                    </div>
                    {{-- {{$penempatan->links()}} --}}
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
