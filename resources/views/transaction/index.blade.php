@extends('layouts_transaction.app')


@section('contents_transaction')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <div class="content">
    <div class="row">

      <div class="col-lg-7">
        <div class="card card-primary card-outline">
          <div class="card-body">
              @if (Session::get('danger'))
                <div class="swal" data-swal="{{ Session::get('danger') }}">
                </div>
              @else
                <div class="swal2" data-swal2="{{ Session::get('success') }}">
                </div>
              @endif
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>No Faktur</label>
                  <label
                    class="form-control form-control-lg text-center text-danger"
                    >{{ $invoice }}</label
                  >
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Tanggal</label>
                  <label class="form-control form-control-lg text-center"
                    >{{ date('d M Y') }}</label
                  >
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Jam</label>
                  <label id="jam"  class="form-control form-control-lg text-center"></label>
                </div>
              </div>

              <div class="col-3">
                <div class="form-group">
                  <label>Kasir</label>
                  <label
                    class="form-control form-control-lg text-center text-primary"
                    >{{ Auth::user()->name }}</label
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title m-0"></h5>
          </div>
          <div class="card-body bg-black color-palette text-right">
            <label class="display-4 text-green">Rp. {{ number_format($grand_total,0) }}</label>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card card-primary card-outline">
          <div class="card-body">
            <form action="{{ route('transaction.add_cart')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">   
                    <div class="col-2 input-group">
                      <input
                        name="name"
                        class="form-control"
                        placeholder="Nama Produk"
                        autocomplete="off"
                        id= "name"
                        required
                      />
                      <span class="input-group-append">
                        <a class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#find-product">
                          <i style="color: white" class="fas fa-search"></i>
                        </a>
                        <button type="reset" class="btn btn-danger btn-flat">
                          <i class="fas fa-times"></i>
                        </button>
                      </span>
                    </div>

                    <div class="col-2">
                      <input
                        name="name"
                        class="form-control"
                        placeholder="Nama Produk"
                        readonly
                      />
                    </div>

                     <div class="col-1">
                      <input
                        name="id_product"
                        class="form-control"
                        placeholder="id"
                        readonly
                      />
                    </div>

                    
                    <div class="col-1">
                      <input
                        name="product_code"
                        class="form-control"
                        placeholder="Kode Produk"
                        readonly
                      />
                    </div>

                     
                   
                    <div class="col-1">
                      <input
                        name="category_name"
                        class="form-control"
                        placeholder="Kategori"
                        readonly
                      />
                    </div>

                    <div class="col-1">
                      <input
                        name="selling_price"
                        class="form-control"
                        placeholder="Harga"
                        readonly
                      />
                    </div>

                      <input
                      name="purchase_price"
                      type="hidden"
                    />
                  


                    <div class="col-1">
                      <input
                        type="number"
                        min="1"
                        value="1"
                        name="qty"
                        class="form-control text-center"
                        placeholder="QTY"
                        id="qty"
                      />
                    </div>

                  
                    <div class="col-3">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-cart-plus" ></i> Add
                      </button >
                      <a href="{{ route('transaction.reset_cart') }}" class="btn btn-warning">
                        <i class="fas fa-sync"></i> Reset
                      </a>
                      <a style="color:white"  data-toggle="modal" onclick="Pembayaran()" data-target="#pembayaran"  class="btn btn-success">
                        <i  class="fas fa-cash-register"></i> Pembayaran
                      </a>
                    </div>
                  </div>
                </div>
                
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12">
                  <table class="table m-0">
                    <thead>
                      <tr class="text-center">
                        <th>Id Produk</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th width="100px">QTY</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $cart as $item )
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->options->product_code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->options->category_name }}</td>
                        <td>Rp. {{ number_format($item->price,0) }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp. {{ number_format($item->subtotal ,0)}}</td>
                        <td class="text-center" >
                          <a href="{{ route('transaction.remove_item',$item->rowId) }}" class="btn btn-flat btn-danger btn-sm">  <i class="fa fa-times text-white"> </i> </a>
                        </td>
                      </tr>
                      @endforeach
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0"></h5>
            </div>
            <div class="card-body bg-black color-palette text-center">
              <h2 class="text-yellow" id="terbilang"></h2>
            </div>
        </div>
      </div>

      
    </div>
  </div>
</div>

<!-- Modal Pencarian Produk -->
<div class="modal fade " id="find-product">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pencarian Data Produk</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped text-sm text-center">
          <thead>
            <tr >
              <th width="50px">Id Produk</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Stok</th>
              <th>Gambar</th>
              <th width="100px">Aksi</th>
            </tr>
          </thead>
          <tbody>
              @php
                $no=1;
              @endphp
            @foreach ($products  as $item)
            <tr>
              <td>{{$item->id_product}}</td>
              <td>{{$item->product_code}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->category_name}}</td>
              <td>Rp. {{ number_format($item->purchase_price,0)}}</td>
              <td>Rp. {{ number_format($item->selling_price,0)}}</td>
              <td>{{number_format($item->stock,0)}}</td>
               <td> <img src="{{ asset('storage/'.$item->image) }}" style="width:100px" alt="image"> </td>
              <td style=" width:30px"><button onclick="PilihProduk('{{$item->name}}')" class="btn btn-success btn-xs">Piih</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /Modal Pencarian Produk -->

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

      <form action="{{ route('transaction.save_transaction')}}" method="POST">
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
            <label>Total Biaya</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"></i>Rp.</span>
                </div>
              <input id="grand_total" name="grand_total" value="{{ number_format($grand_total,0) }} " readonly  class="text-danger form-control form-control-lg text-right"  placeholder="Harga Beli" required>
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

        
          <input type="hidden" required id="user_id" name="user_id" value="{{ Auth::user()->id }}"  class="form-control form-control-lg text-right text-primary" readonly autocomplete="off">
            

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




<script>
  $(document).ready(function() {

    $('#name').focus();

   
    @if($grand_total==0) {
      document.getElementById('terbilang').innerHTML ='Nol Rupiah';
    } @else {
      document.getElementById('terbilang').innerHTML = terbilang(<?= $grand_total ?>) + ' Rupiah';
    }
    @endif
    
    $('#name').keydown(function (e) {
      let name = $('#name').val();
      if (e.keyCode == 13) {
        e.preventDefault();
        if (name == '') {
          Swal.fire({
            title: "Maaf !!",
            text: 'Kode Produk Kosong',
            icon: 'error'
          })
        } else {
          CekProduk();
        }
      }
    });

    // Hitung Kembalian
    $('#dibayar').keyup(function e() {
      HitungKembalian();
    });

  });

    
  function PilihProduk(name) {
    $('#name').val(name);
    $('#find-product').modal('hide');
     CekProduk();
  }

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



   function CekProduk() {
    $.ajax({
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "/transaction/cek_produk",
      data: {
        name: $('#name').val(),
      },
      dataType: "JSON",
      success: function(response) {
        if (response.name == '') {
          Swal.fire({
            title: "Maaf !!",
            text: 'Nama Produk Tidak Terdaftar',
            icon: 'error'
          })
        }else{
          $('[name="id_product"]').val(response.id_product);
          $('[name="product_code"]').val(response.product_code);
          $('[name="name"]').val(response.name);
          $('[name="purchase_price"]').val(response.purchase_price);
          $('[name="selling_price"]').val(response.selling_price);
          $('[name="category_name"]').val(response.category_name);
          $('#qty').focus();
        }
      }

    });
  }
  
</script>

<script>
  window.onload = function() {
    startTime();
  }
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m= checkTime(m);
    s= checkTime(s);
    document.getElementById('jam').innerHTML = h + ':' + m + ':' + s;
    var t = setTimeout(function(){
      startTime();
    },500);
   
  }
   
  function checkTime(i) {
    if (i<10) {
      i = '0' + i;
    }
    return i;
  }
  
</script>

   
  

@endsection

