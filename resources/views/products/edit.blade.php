@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Produk</h3>
        </div>
        <form action="{{ route('products.update',$products->id) }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" class="form-control" id="product_code" placeholder="Kode Produk" name="product_code" value="{{$products->product_code}}">
            </div>
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="name" placeholder="Nama Produk" name="name" value="{{$products->name}}">
            </div>
            <div class="form-group">
                <label for="purchase_price">Harga Beli</label>
                <input type="text" class="form-control" id="purchase_price" placeholder="Harga Beli" name="purchase_price" value="{{$products->purchase_price}}">
            </div>
            <div class="form-group">
                <label for="selling_price">Harga Jual</label>
                <input type="text" class="form-control" id="selling_price" placeholder="Harga Jual" name="selling_price" value="{{$products->selling_price}}">
            </div>
            <div class="form-group">
                <label for="stock">Stok Barang</label>
                <input type="text" class="form-control" id="stock" placeholder="Stok Barang" name="stock" value="{{$products->stock}}">
            </div>

            <div class="form-group">
                <label>Gambar Yang Sudah Ada</label> 
                <br>
            <img src="{{ asset('storage/'.$products->image) }}" style="width:200px" alt="image"> 
            </div>

            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="form-group">
                <label>Kategori ID</label>
                <select class="form-control select2" style="width: 100%;" name="category_id" value="{{isset($products) ? $products->category_id : ''}}">
                    {{-- <option selected="selected" value="{{$categories->name}}"></option> --}}
                    @foreach ($categories as $item)
                    <option value="{{$item->id}}"{{$products->category_id== $item->id ? 'Selected' : ''}}>{{$item->category_name}}</option>
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
