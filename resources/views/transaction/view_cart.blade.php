@extends('layouts_transaction.app')


@section('contents_transaction')

<div class="container">


  <!-- Main content -->
  <form action="{{ route('update_cart')}}" method="POST" enctype="multipart/form-data">
  @csrf
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
        <div class="swal" data-swal="{{ Session::get('success') }}">
        </div>
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
              @php
                $i=1;
              @endphp
              @foreach ($cart as $value )
              @php
                $sub_total_price = $value->price * $value->qty;
              @endphp
              <tr>
                <td><input name="qty{{ $i++ }}" type="number" min="1" class="form-control" value="{{ $value->qty }}"></td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->options->category_name }}</td>
                <td><img style="width:100px" alt="image" src="{{ asset('storage/'.$value->options->image) }}" alt=""></td>
                <td>Rp. {{ number_format($value->price,0)}}</td>
                <td>Rp. {{ number_format($sub_total_price,0)}}</td>
                <td>
                  <a data-toggle="modal" data-target="#delete{{ $value->rowId }}"  class="btn btn-sm btn-danger">
                    <i style="color: white" class="fas fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach

              <tr>
                <th colspan="5" style="text-align: right">
                  Total Harga
                </th>
                <td colspan="2"><b> Rp. {{ $grand_total }}</b></td>
              </tr>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      {{-- <div class="row"> --}}
        <!-- accepted payments column -->
        {{-- <div class="col-6">
          
        </div> --}}
        <!-- /.col -->
        {{-- <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Grandtotal:</th>
                <td><b> Rp. {{ $grand_total }}</b></td>
              </tr>
            </table>
          </div>
        </div> --}}
        <!-- /.col -->
      {{-- </div> --}}
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <button type="submit" class="btn btn-warning">
            Update
          </button>
          <a href="{{ route('transaction') }}" class="btn btn-primary">
            Kembali
          </a>
          <a style="color:white"  data-toggle="modal" onclick="Pembayaran()" data-target="#pembayaran"  class="btn btn-success float-right">
            <i  class="fas fa-cash-register"></i> Pesan
          </a>
          {{-- <button type="button" class="btn btn-success float-right">
          <i class="far fa-credit-card"></i>
          Cek Out
          </button> --}}
        </div>
      </div>

    </div>
  </form>
</div>

<!-- Modal Pembayaran Produk -->
<div class="modal fade " id="pembayaran">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Transaksi Pembayaran</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('save_transaction')}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Customer</label>
              <div class="input-group mb-3">
              <input  autocomplete="off" required id="customer_name" name="customer_name" class="form-control form-control-lg text-right"  placeholder="Nama Customer" required>
            </div>
          </div>

          <div class="form-group">
            <label>No Telp Customer</label>
              <div class="input-group mb-3">
              <input  autocomplete="off" required id="customer_phone" name="customer_phone" class="form-control form-control-lg text-right"  placeholder="No Telp. Customer" required>
            </div>
          </div>
          <div class="form-group">
            <label>No Meja</label>
            <select class="form-control select" style="width: 100%;" name="mejas_id">
              <option selected="selected">Pilih No meja</option>
              @foreach ($no_meja as $item)
              <option value="{{$item->meja_id}}">{{$item->nomor_meja}}</option>
              @endforeach
          </select>
          </div>

        <div class="form-group">
            <label>Total Harga Pesanan</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input id="grand_total" name="grand_total" value="{{ $grand_total }} " readonly  class="text-danger form-control form-control-lg text-right"  placeholder="Harga Beli" required>
            </div>
          </div>

          <input type="hidden" required id="user_id" name="user_id" value="{{ Auth::user()->id }}"  class="form-control form-control-lg text-right text-primary" readonly autocomplete="off">

          {{-- <div class="form-group">
            <label>Dibayar</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input required id="dibayar" name="dibayar" value=""  class="form-control form-control-lg text-right text-primary" autocomplete="off">
            </div>
          </div>
        
          <input type="hidden" required id="user_id" name="user_id" value="{{ Auth::user()->id }}"  class="form-control form-control-lg text-right text-primary" readonly autocomplete="off">
          
          <div class="form-group">
            <label>Kembalian</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input id="kembalian" name="kembalian" value=""  class="form-control form-control-lg text-right text-success" readonly>
            </div>
          </div> --}}
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Pesan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@foreach ($cart as $value )
<div class="modal fade" id="delete{{ $value->rowId  }}">
  <div class="modal-dialog modal-danger">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Menu</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin ingin menghapus {{ $value->name }} ?
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
        <a href="{{ route('remove_item', $value->rowId) }}"  class="btn btn-outline-light">Iya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endforeach


@endsection


   
@section('scripts')
<script type="text/javascript">
   
  $(document).ready(function() {
    
    // Hitung Kembalian
    $('#dibayar').keyup(function e() {
      HitungKembalian();
    });

  });

  function Pembayaran() {
    $('#pembayaran').modal('show');
  }

  new AutoNumeric('#dibayar', {
    digitGroupSeparator : ',',
    decimalPlaces: 0,
  });

  
  function HitungKembalian() {
    let grand_total =$('#grand_total').val().replace(/[^.\d]/g,'').toString();
    let dibayar = $('#dibayar').val().replace(/[^.\d]/g,'').toString();

    let kembalian = parseFloat(dibayar) - parseFloat(grand_total);
    $('#kembalian').val(kembalian);

    new AutoNumeric('#kembalian', {
      digitGroupSeparator : ',',
      decimalPlaces: 0,
    });
  }

</script>
@endsection

