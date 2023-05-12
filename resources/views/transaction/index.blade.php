@extends('layouts_transaction.app')


@section('contents_transaction')

<div class="col-lg-12">
 
</div>

@foreach ($products as $value )

<div class="col-lg-3">
  

  <div class="card card-outline card-primary">
    <div class="card-header">
      
      <h5 class="card-title">{{ $value->name }}
          {{-- <input
            name="name"
            class="form-control"
            value="{{ $value->name }}"
          /> --}}
      </h5>
    </div>

    <div class="card-body text-center">
      <p class="card-text">
        <img src="{{ asset('storage/'.$value->image) }}" class="img-fluid"/>
      </p>

      <label>Rp. {{ number_format($value->selling_price,0)}}</label
      ><br />
      <a href="{{ route('transaction.add_cart',$value->id_product)}}" class="btn btn-primary btn-lg btn-flat">
        <i class="fas fa-cart-plus fa-lg mr-2"></i>
        Tambah
      </a>
    </div>
  </div>  

</div>

@endforeach






   
  

@endsection

