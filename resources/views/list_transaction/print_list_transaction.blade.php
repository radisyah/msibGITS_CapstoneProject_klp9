<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Kasir</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/template/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice:</b> {{ $details2->invoice }}<br>
                  <br>
                  <b>Nama Customer:</b> {{ $details2->customer_name }}<br>
                  <b>No Telp Customer:</b> {{ $details2->customer_phone }} <br>
                  <b>Payment Due:</b> {{ date('d/m/Y') }}<br>
                </div>
               
                <!-- /.col -->
              </div>
               <br>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead>
                    <tr>
                      <th>Qty</th>
                      <th>Produk</th>
                      <th>Kode Produk</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($details as $item)
                    <tr>
                      <td>{{$item->qty}}</td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->product_code}}</td>
                      <td>Rp. {{number_format($item->selling_price*$item->qty,0)}}</td>
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
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due  {{ date('d/m/Y') }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td>Rp. {{  number_format($details2->total_price,0) }}</td>
                      </tr>
                      <tr>
                        <th>Pembayaran</th>
                        <td>Rp. {{  number_format($details2->payment,0) }}</td>
                      </tr>
                      <tr>
                        <th>Kembalian</th>
                        <td>Rp. {{  number_format($details2->change,0) }}</td>
                      </tr>
                    </table>
                    
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>