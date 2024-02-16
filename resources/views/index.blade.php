{{-- Slider --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach($penempatans->sortBy('name') as $penempatan)

        <div class="col-md-12">
          <h2 style="color:rgb(45, 149, 150); margin-top: 20px;">{{$penempatan->name}}</h2>

          @foreach($penempatan->siswas->groupBy('sekolah_id') as $sekolahId => $siswas)
          @php
            $sekolah = App\Models\Asal_Sekolah::find($sekolahId);
          @endphp
          @if($sekolah)
          <div class="col-md-12">
            <h4 style="color: rgb(17, 106, 108); margin-top: 20px;">{{$sekolah->nama_sekolah}}</h4>

            <div class="jumbotron pt-2">
              <div class="row slider mx-1">
                {{-- Mulai Perulangan Slider --}}
                @foreach($siswas as $siswa)

                <div class="col-md-2">
                  <img src="{{asset('image')}}/{{$siswa->image}}" width="180" height="190" style="border: 2px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                  <p class="text-right pt-2 px-1">
                      {{$siswa->nama_siswa}}<br>
                      {{$siswa->id_siswa}}<br>
                  </p>
                  <p class="text-right px-1">
                    <a href="{{route('detail',[$siswa->id])}}">
                      <button class="btn btn-outline-success">Lihat</button>
                    </a>
                  </p>
                </div>

                @endforeach
                {{-- Akhir Perulangan Slider --}}
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
        @endforeach

      </div>
    </div>
</div>

 <!-- Sertakan dependensi carousel Slick -->
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

{{-- Inisialisasi Carousel Slick --}}
<script>
    $(document).ready(function(){
        $('.slider').each(function(){
            var slideCount = $(this).find('.col-md-2').length;

            // Periksa jika jumlah elemen kurang dari 6, maka nonaktifkan titik
            var dotsOption = (slideCount >= 6) ? true : false;

            $(this).slick({
                slidesToShow: 6,
                slidesToScroll: 3,
                infinite: true,
                dots: dotsOption,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    });
</script>
@endsection
