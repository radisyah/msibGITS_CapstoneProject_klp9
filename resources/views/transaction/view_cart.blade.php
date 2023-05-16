@extends('layouts_transaction.app')


@section('contents_transaction')

<div class="container">


  <!-- Main content -->
  <form action="{{ route('transaction.update_cart')}}" method="POST" enctype="multipart/form-data">
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
          <button type="submit" class="btn btn-warning">
            Update
          </button>
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
  </form>
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
        <a href="{{ route('transaction.remove_item', $value->rowId) }}"  class="btn btn-outline-light">Iya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endforeach


@endsection



   
@section('scripts')
<script type="text/javascript">
   
    $(".cart_update").change(function (e) {
        e.preventDefault();
   
        var ele = $(this);
   
        $.ajax({
            type: "patch",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/transaction/update_cart",
            data: {
                rowId: ele.parents("tr").attr("data-rowId"), 
                qty: ele.parents("tr").find(".qty").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

   
   
</script>
@endsection
