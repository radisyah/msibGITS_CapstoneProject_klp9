@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Serve</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="swal2" data-swal2="{{ Session::get('success') }}">
      </div>
       <table  id="example1" class="table table-bordered table-striped text-center">
        <thead>
            <tr >
                <th>No</th>
                <th>Invoice</th>
                <th>No Meja</th>
                <th>Nama Customer</th>
                <th>No. Telp Customer</th>
                <th>Daftar Pesanan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @php
            $no=1;
          @endphp
            @foreach ($orders as $item)
            <tr class="">
                <td>{{$no++}}</td>
                <td>{{$item->invoice}}</td>
                <td>{{$item->nomorMeja->nomor_meja}}</td>
                <td>{{$item->customer_name}}</td>
                <td>{{$item->customer_phone}}</td>
                <td>
                  @php
                      $i=1;
                    @endphp
                  @foreach ($item->detailTransaksi as $item2 )
                    {{ $i++ }}. {{ $item2->products->name }}    -   {{ $item2->qty }} pcs <br>
                  @endforeach
                    </td>
                    <td>Rp. {{number_format($item->total_price,0)}}</td>
                    <td><span class="badge badge-success">{{ $item->status }}</span></td>
                    {{-- <td><a href="{{ route('list_detail',$item->id)}}">Detail</a></td> --}}
                    <td>
                      <a style="color:white"  data-toggle="modal" onclick="Pembayaran()" data-target="#pembayaran{{ $item->id }}" href="#" class="btn btn-primary">
                        Bayar
                      </a>
                    </td>
                </tr>
                @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>

<!-- Modal Pembayaran Produk -->
@foreach ($orders as $item)
<div class="modal fade " id="pembayaran{{ $item->id }}">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Transaksi Pembayaran</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form  method="GET" action="{{ route('status_done', $item->id) }}">
        @csrf
        <div class="modal-body">

        <div class="form-group">
            <label>Total Biaya</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input id="grand_total" name="grand_total" value="{{ number_format($item->total_price,0) }} " readonly  class="text-danger form-control form-control-lg text-right"  placeholder="Harga Beli" required>
            </div>
          </div>

          <div class="form-group">
            <label>Dibayar</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input required id="dibayar" name="dibayar" value=""  class="form-control form-control-lg text-right text-primary" autocomplete="off">
            </div>
          </div>

                    

          <div class="form-group">
            <label>Kembalian</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input id="kembalian" name="kembalian" value=""  class="form-control form-control-lg text-right text-success" readonly>
            </div>
          </div>
        </div>
     


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Simpan Transaksi</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /Modal Pembayaran Produk -->
@endforeach

<script>
 

    // Hitung Kembalian
    $('#dibayar').keyup(function e() {
      HitungKembalian();
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