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
                    <td><span class="badge badge-info">{{ $item->status }}</span></td>
                    {{-- <td><a href="{{ route('list_detail',$item->id)}}">Detail</a></td> --}}
                    <td>
                     <form method="GET" action="{{ route('status_serve', $item->id) }}">

                        @csrf
                        </a>
                        <input id="proses" name="_method" value="serve" type="hidden" >
                        <button id="serve" type="submit" class="btn btn-primary serve show-alert-serve-box btn-sm" data-toggle="tooltip" title='Serve'>Serve</button>
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