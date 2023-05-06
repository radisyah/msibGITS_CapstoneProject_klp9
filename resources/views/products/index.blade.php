@extends('layouts.app')

@section('title', 'Data Barang')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Produk</h3>
        <div class="card-tools">
            <a href="{{ route('products.add') }}">
                <button type="button" data-target="" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-plus"></i> Add</button>
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="swal" data-swal="{{ Session::get('success') }}">
      </div>
      <table id="example1" class="table table-bordered table-striped text-center">
        <thead>
          <tr >
            <th width="50px">No</th>
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
        @foreach ($data as $item)
          <tr class="{{ $item->stock  == 0 ? "bg bg-danger" : "" }} ">
            <td>{{$no++}}</td>
            <td>{{$item->product_code}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->categories->category_name}}</td>
            <td>Rp. {{ number_format($item->purchase_price,0)}}</td>
            <td>Rp. {{ number_format($item->selling_price,0)}}</td>
            <td>{{number_format($item->stock,0)}}</td>
            <td> <img src="{{ asset('storage/'.$item->image) }}" style="width:100px" alt="image"> </td>

            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('products.edit',$item->id)}}">
                  Edit
                </a>
                <button data-toggle="modal" data-target="#delete{{ $item->id }}" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        @endforeach

        </tbody>

      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>

@foreach ($data as $item)
  <div class="modal fade" id="delete{{ $item->id  }}">
    <div class="modal-dialog modal-danger">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Prduk</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Apakah Anda Yakin ingin menghapus {{ $item->name }} ?
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="{{ route('products.destroy',$item->id)}}" type="submit" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
@endforeach
@endsection
