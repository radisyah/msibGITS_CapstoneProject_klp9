@extends('layouts_transaction.app')


@section('contents_transaction')

<div class="container">
<div class="col-lg-12">
  
</div>

  <!-- Main content -->
  <div class="invoice p-3 mb-3">
    
    <div class="row">
      <div class="col-12">
        <h4>
          <i class='fas fa-shopping-cart'></i> Keranjang Order
        </h4>
      </div>
    </div>
    
    <br>
    
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th width="100px">Qty</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Gambar</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($cart as $value )
            @php
              $sub_total_price = $value->price * $value->qty;
            @endphp
            <tr>
              <td><input name='qty' type="number" min="1" class="form-control" value="{{ $value->qty }}"></td>
              <td>{{ $value->name }}</td>
              <td>{{ $value->options->category_name }}</td>
              <td><img style="width:100px" alt="image" src="{{ asset('storage/'.$value->options->image) }}" alt=""></td>
              <td>Rp. {{ number_format($value->price,0)}}</td>
              <td>Rp. {{ number_format($sub_total_price,0)}}</td>
              <td>
                <a href="{{ route('transaction.remove_item', $value->rowId) }}" class="btn btn-sm btn-danger">
                  <i class="fas fa fa-trash"></i>
                </a>
              </td>
            </tr>
            @endforeach
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        
      </div>
      <!-- /.col -->
      <div class="col-6">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Grandtotal:</th>
              <td>Rp. {{ $grand_total }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <a href="{{ route('transaction') }}" class="btn btn-primary">
          Kembali
        </a>
        <button type="button" class="btn btn-success float-right">
        <i class="far fa-credit-card"></i>
         Cek Out
        </button>
       
      
       
      </div>
    </div>

  </div>
 
</div>
        <!-- /.invoice -->


@endsection

