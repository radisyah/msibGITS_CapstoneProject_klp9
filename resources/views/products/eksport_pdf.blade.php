<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
          
        }
        
        table th,
        table td {
            padding: 8px;
            text-align: left;
          
        }
        
         .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .order-table th {
            text-align: center;
        }


         .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        .bg-danger {
            background-color: #ffcccc;
        }
        
        .product-image {
            width: 100px;
        }
    </style>
</head>
<body>
   <h1 class="page-title">Data Produk</h1>
    <table class="order-table">
        <thead>
            <tr>
              <th width="50px">No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
            <tr class="{{ $item->stock == 0 ? 'bg-danger' : '' }}">
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->product_code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->categories->category_name }}</td>
                <td>Rp. {{ number_format($item->purchase_price, 0) }}</td>
                <td>Rp. {{ number_format($item->selling_price, 0) }}</td>
                <td>{{ number_format($item->stock, 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
