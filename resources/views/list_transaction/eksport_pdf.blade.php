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

        .inner-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inner-table th,
        .inner-table td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .inner-table th {
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
    <h1 class="page-title">Riwayat Transaksi</h1>

    <table class="order-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice</th>
                <th>Nomor Meja</th>
                <th>Nama Customer</th>
                <th>Daftar Pesanan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
              $no=1;
            @endphp
            @foreach ($orders as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->invoice }}</td>
                <td>{{ $item->nomorMeja->nomor_meja }}</td>
                <td>{{ $item->customer_name }}</td>
                 <td>
                    <table class="inner-table">
                        <thead>
                            <tr>
                                <th>Nama Makanan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->detailTransaksi as $item2)
                            <tr>
                                <td>{{ $item2->products->name }}</td>
                                <td>{{ $item2->qty }}</td>
                                <td>Rp. {{number_format($item2->products->selling_price,0)}}</td>
                                <td>Rp. {{number_format($item2->products->selling_price*$item2->qty,0)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td>Rp. {{number_format($item->total_price,0)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
