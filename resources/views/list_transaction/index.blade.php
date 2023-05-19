@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Riwayat Transaksi</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
       <table  id="example1" class="table table-bordered table-striped text-center">
        <thead>
            <tr >
                <th>No</th>
                <th>Invoice</th>
                <th>Nama Customer</th>
                <th>No. Telp Customer</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @php
            $no=1;
          @endphp
            @foreach ($data_listtransaction as $item)
                <tr class="">
                    <td>{{$no++}}</td>
                    <td>{{$item->invoice}}</td>
                    <td>{{$item->customer_name}}</td>
                    <td>{{$item->customer_phone}}</td>
                    <td>Rp. {{number_format($item->total_price,0)}}</td>
                    <td><span class="badge badge-success">{{ $item->status }}</span></td>
                    <td><a href="{{ route('list_detail',$item->id)}}">Detail</a></td>
                </tr>
                @endforeach
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
  

@endsection