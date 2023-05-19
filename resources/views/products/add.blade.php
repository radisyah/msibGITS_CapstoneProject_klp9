@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Produk</h3>
        </div>
        <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="product_code">Kode Produk</label>
                <input type="text" class="form-control" id="product_code" placeholder="Kode Produk" name="product_code">
            </div>
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="name" placeholder="Nama Produk" name="name">
            </div>
            <div class="form-group">
                <label for="purchase_price">Harga Beli</label>
                <input type="text" class="form-control" id="purchase_price" placeholder="Harga Beli" name="purchase_price">
            </div>
            <div class="form-group">
                <label for="selling_price">Harga Jual</label>
                <input type="text" class="form-control" id="selling_price" placeholder="Harga Jual" name="selling_price">
            </div>
            <div class="form-group">
                <label for="stock">Stok Barang</label>
                <input type="text" class="form-control" id="stock" placeholder="Stok Barang" name="stock">
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
               <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control select" style="width: 100%;" name="category_id">
                    <option selected="selected">Pilih Kategori Produk</option>
                    @foreach ($categories as $item)
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{route('products')}}" type="button" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
</div>

<script>
  new AutoNumeric('#purchase_price', {
    digitGroupSeparator : ',',
    decimalPlaces: 0,
    
  });
  new AutoNumeric('#selling_price', {
    digitGroupSeparator : ',',
    decimalPlaces: 0,

  });

   new AutoNumeric('#stock', {
    digitGroupSeparator : ',',
    decimalPlaces: 0,

  });

</script>

@endsection
