@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Daftar Order</h3>
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
                <th>Daftar Pesanan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>&nbsp;</th>
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
                    <td>
                      @php
                          $i=1;
                        @endphp
                      @foreach ($data_detailtransaction as $item2 )
                        {{ $i++ }}. {{ $item2->name }}    -   {{ $item2->qty }} pcs <br>
                      @endforeach
                    </td>
                    <td>Rp. {{number_format($item->total_price,0)}}</td>
                    <td>{{$item->status}}</td>
                    {{-- <td><a href="{{ route('list_detail',$item->id)}}">Detail</a></td> --}}
                    <td>
                      <a href="{{ route('status_proses', $item->id) }}" class="btn btn-primary">
                        Proses
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
  

@endsection