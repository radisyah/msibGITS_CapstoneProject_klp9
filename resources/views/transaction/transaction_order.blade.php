@extends('layouts.app')


@section('contents')


@foreach ( $nomor_meja as $item )

  <div class="col-md-3 col-sm-6 col-12">
      <!-- small card -->
    <div class="small-box bg-info">
      <div class="inner">
          <p>Nomor Meja</p>
        <h3>{{ $item->nomor_meja }}</h3>

      
      </div>
      <div class="icon">
        <i class="fas "><img src="{{ asset('storage/'.$item->qr) }}" style="height:80px" alt="image"></i>
      </div>
      <a href="{{ route('transaction', $item->nomor_meja) }}" class="small-box-footer">
        Kunjungi <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
    
    <!-- /.info-box -->
  </div>
  
@endforeach
 

@endsection