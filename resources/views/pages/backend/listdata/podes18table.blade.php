@extends('layouts.admin')

@section('content')
@auth
<div class="card col-md-12">
    <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
      <div class="card-body" style="padding:2%;">
        <!-- <h4 class="card-title">Simple Basic Map</h4> -->
        <div class="d-flex justify-content-between">
          <h4 class="mb-0">Potensi Desa (Podes) BPS 2018</h4>
          <p>Jumlah <b>{{ number_format( $podes18_total );}}</b></p>
          {{-- <a href="#"><small>Show All</small></a> --}}
        </div>
        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
        <div class="table-responsive p-3">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">No</th>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">ID Desa</th>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">Desa / Kelurahan</th>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">Kecamatan</th>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">Kab / Kota</th>
                <th class="text-uppercase text-center text-xxs font-weight-bolder">Provinsi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($items as $item)
              <tr>
                  <th class="align-middle text-center" scope="row"><h6 class="mb-0 text-sm">{{ ++$i }}</h6></th>
                  <td class="align-middle text-center"><p class="text-xs font-weight-bold mb-0">{{ $item->kode_wilayah }}</p></td>
                  <td class="align-middle text-center"><span>{{ $item->nama_desa }}</span></td>
                  <td class="align-middle text-center"><span>{{ $item->nama_kec }}</span></td>
                  <td class="align-middle text-center"><span>{{ $item->nama_kab }}</span></td>
                  <td class="align-middle text-center"><span>{{ $item->nama_provinsi }}</span></td>
              </tr>   
              @empty
              <tr colspan="5" class="text-center">
                  <td>Data Tidak Ada</td>
              </tr> 
              @endforelse
            </tbody>
          </table>
          
                {{-- Pagination --}}
  <div class="d-flex justify-content-center mt-4">
    <br>
    {!! $items->links() !!}
</div>

        </div>

      </div>
</div>    
@endauth
@endsection

