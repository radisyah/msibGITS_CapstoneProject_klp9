@extends('layouts_transaction.app')


@section('contents_transaction')

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Imuslih E-Commerce</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div class="container bg-light" style="max-width: 100%">
            <div class="row">
                <div class="col-sm-8 mt-2">
                    <div class="row">
                        @foreach ($products as $item)
                        {{-- halaman detail pop up --}}
                        <div class="modal fade" id="exampleModalLong{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">    
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $item->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card text-center mb-3">
                                            <div class="card-body" style="height:auto;">
                                                <h3>{{ $item->name }}</h3>
                                                @if ($item->image)
                                                <img src="{{ asset('storage/'.$item->image) }}" class="img-fluid" style="width: 75%;" alt="">
                                                @else
                                                <img src="https://cdn-image.hipwee.com/wp-content/uploads/2021/12/hipwee-Recycle-Symbols-and-Patterns-Signs-Reduce-Reuse-Recycle_-RRR.png" class="img-fluid" style="width: 75%;" alt="">
                                                @endif
                                                <h5 class="card-subtitle mb-2 text-muted"><i>Category : {{ $item->category_name }}</i></h5>
                                                <h6 class="text-center">Rp. {{ number_format($item->selling_price,0,',','.') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end halaman detail pop up --}}
                            <div class="col-sm-4">
                                {{-- <a href="{{ url('/transaksi/detail') }}" style="text-decoration: none;"> --}}
                                    <div class="card text-center mb-3">
                                        <div class="card-body" style="height:auto;">
                                            <h4>{{ $item->name }}</h4>
                                            <h5 class="card-subtitle mb-2 text-muted"><i>Category : {{ $item->category_name }}</i></h5>
                                            <h6>Rp. {{ number_format($item->selling_price,0,',','.') }}</h6>
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalLong{{ $item->id }}">
                                                Detail Produk
                                            </button>
                                            <a href="add/{{ $item->id }}">
                                                <button class="btn btn-primary mt-3" type="button">Tambah ke keranjang</button>
                                            </a>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4 mt-2">
                        <div class="card text-center mb-3" style="background-color: rgb(216, 216, 216)">
                            <div class="card-body">
                                <h5><b>Detail Transaksi</b></h5>
                                @if (empty($cart))
                                    <p>Tidak ada produk yang dipilih</p>
                                @else
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Jml</th>
                                                <th>Harga</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            @php
                                                $i=1;
                                                $grandtotal=0;
                                            @endphp
                                            @foreach ($cart as $item => $val)
                                            @php
                                                $total = $val['harga_produk'] * $val['qty'];
                                            @endphp
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $val['nama_produk'] }}</td>
                                                    {{-- <td>
                                                        <a href="qty.php?kurang={{ $val['qty'] }}">-</a>
                                                        <input type="text" name="qty" value="{{ $val['qty'] }}">
                                                        <a href="qty.php?tambah={{ $val['qty'] }}">+</a>
                                                    </td> --}}
                                                    <td>{{ $val['qty'] }}</td>
                                                    <td style="text-align: right">{{ number_format($val['harga_produk'],0,',','.') }}</td>
                                                    <td>
                                                        <a href="{{ 'hapus/'.$item }}">Batal</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $grandtotal +=$total;
                                                @endphp
                                            @endforeach
                                                <tr>
                                                    <td colspan="3"><b>Total Belanja</b></td>
                                                    <td colspan="2" style="text-align: left"><b>{{ number_format($grandtotal,0,',','.') }}</b></td>
                                                </tr>   
                                        </thead>        
                                </table>
                                @endif
                                <a href="/transaksi/create">
                                    <button class="btn btn-warning mt-3" type="button">Check Out</button>
                                </a>
                                <div class="mt-2" style="text-align: left;">
                                    <ul>
                                        <li><i>Klik <b>Tambah ke keranjang</b> beberapa kali untuk menentukan jumlah barang</i></li>
                                        <li><i>Klik <b>Batal</b> untuk menghapus barang</i></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
    </html>

@endsection

