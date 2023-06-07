@extends('layouts_transaction.app')

@section('contents_transaction')

<div class="container">

  <!-- Main content -->
  <form action="{{ route('update_cart', $nomor_meja)}}" method="POST" enctype="multipart/form-data">
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
        @if (Session::get('danger'))
        <div class="swal2" data-swal2="{{ Session::get('danger') }}">
        </div>
        @else
        <div class="swal" data-swal="{{ Session::get('success') }}">
        </div>
        @endif
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
              {{-- @if ($value->options->meja ==$nomor_meja) --}}

              @php
              $sub_total_price = $value->price * $value->qty;
              @endphp
              <tr>
                <td>
                  <input id="qty{{ $value->rowId }}" name="qty[{{ $value->rowId }}]" type="number" min="1" class="form-control" value="{{ $value->qty }}">
                </td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->options->category_name }}</td>
                <td><img style="width:100px" alt="image" src="{{ asset('storage/'.$value->options->image) }}" alt=""></td>
                <td>Rp. {{ number_format($value->price,0)}}</td>
                <td>Rp. {{ number_format($sub_total_price,0)}}</td>
                <td>
                  <a data-toggle="modal" data-target="#delete{{ $value->rowId }}" class="btn btn-sm btn-danger">
                    <i style="color: white" class="fas fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach

              <tr>
                <th colspan="5" style="text-align: right">
                  Total Harga
                </th>
                <td colspan="2"><b> Rp. {{ number_format($grand_total,0)}}</b></td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row no-print">
        <div class="col-12">
          <button type="submit" class="btn btn-warning">
            Update
          </button>
          <a href="{{ route('transaction',$nomor_meja) }}" class="btn btn-primary">
            Kembali
          </a>
          <a style="color:white" data-toggle="modal" onclick="Pembayaran()" data-target="#pembayaran" class="btn btn-success float-right">
            <i class="fas fa-cash-register"></i> Pesan
          </a>
        </div>
      </div>

    </div>
  </form>
</div>

<!-- Modal Pembayaran Produk -->
<div class="modal fade" id="pembayaran">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Transaksi Pembayaran</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('save_transaction',$nomor_meja)}}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Customer</label>
            <div class="input-group mb-3">
              <input autocomplete="off" required id="customer_name" name="customer_name" class="form-control form-control-lg text-right" placeholder="Nama Customer" required>
            </div>
          </div>

          <div class="form-group">
            <label>Email Customer</label>
            <div class="input-group mb-3">
              <input type="email" autocomplete="off" required id="customer_email" name="customer_email" class="form-control form-control-lg text-right" placeholder="Email Customer" required>
            </div>
          </div>

          <div class="form-group">
            <label>No Telp Customer</label>
            <div class="input-group mb-3">
              <input autocomplete="off" required id="customer_phone" name="customer_phone" class="form-control form-control-lg text-right" placeholder="No Telp. Customer" required>
            </div>
          </div>

          <div class="form-group">
            <label>No Meja</label>
            <div class="input-group mb-3">
              <input autocomplete="off" readonly value="{{ $nomor_meja }}" id="nomor_meja" name="nomor_meja" class="form-control form-control-lg text-right" placeholder="No Telp. Customer">
            </div>
          </div>

          <div class="form-group">
            <label>Total Harga Pesanan</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"></i>Rp.</span>
              </div>
              <input id="grand_total" name="grand_total" value=" {{ number_format($grand_total,0)}} " readonly class="text-danger form-control form-control-lg text-right" placeholder="Harga Beli" required>
            </div>
          </div>

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
        <a href="{{ route('remove_item', $value->rowId) }}" class="btn btn-outline-light">Iya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endforeach

@endsection
