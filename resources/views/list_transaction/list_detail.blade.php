@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

 <div class="container-fluid">
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
                      <td>Rp. {{number_format($item->price,0)}}</td>
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
               <div class="row no-print">
                <div class="col-12">
                <a href="{{ route('list_transaksi') }}" class="btn btn-warning">Back</a>                
                  <a href="" target="_blank" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-print"></i> Print
                  </a>
                </div>


               </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  

@endsection