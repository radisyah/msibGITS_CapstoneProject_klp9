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
      <div class="swal2" data-swal2="{{ Session::get('success') }}">
      </div>
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
                    <td>
                      @php
                          $i=1;
                        @endphp
                      @foreach ($data_detailtransaction as $item2 )
                        {{ $i++ }}. {{ $item2->name }}    -   {{ $item2->qty }} pcs <br>
                      @endforeach
                    </td>
                    <td>Rp. {{number_format($item->total_price,0)}}</td>
                    <td><span class="badge badge-warning">{{ $item->status }}</span></td>
                    {{-- <td><a href="{{ route('list_detail',$item->id)}}">Detail</a></td> --}}
                    <td>
                      {{-- <a href="{{ route('status_proses', $item->id) }}" class="btn btn-primary">
                        Proses
                      </a> --}}
                       <form method="GET" action="{{ route('status_proses', $item->id) }}">

                        @csrf
                        </a>
                        <input id="proses" name="_method" value="proses" type="hidden" >
                        <button id="proses" type="submit" class="btn btn-primary proses show-alert-proses-box btn-sm" data-toggle="tooltip" title='Proses'>Proses</button>
                      </form>
                 
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