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
    <h1 class="page-title">Laporan Penjualan Harian | {{ date('d M y', strtotime($tgl)) }}</h1>

    <table class="order-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Modal</th>
                <th>Harga Jual</th>
                <th>Terjual</th>
                <th>Total Harga</th>
                <th>Total Untung</th>
            </tr>
        </thead>
        <tbody>
             @php
                $no=1;
                $grandtotal = 0;
                $granduntung = 0;
            @endphp
            @foreach ($dataharian as $key => $item)
                <tr class="text-center">
                <td>{{$no}}</td>
                <td>{{$item->product_code}}</td>
                <td>{{$item->name}}</td>
                <td>Rp.{{number_format($item->purchase_price,0)}}</td>
                <td>Rp.{{number_format($item->selling_price,0)}}</td>
                <td>{{$item->qty}}</td>
                <td>Rp.{{number_format($item->total_harga,0)}}</td>
                <td>Rp.{{number_format($item->untung,0)}}</td>
                </tr>
                @php
                $no++;
                $grandtotal += $item->total_harga;
                $granduntung += $item->untung;
                @endphp
            @endforeach
            <tr class="text-center">
                <td class="tg-0lax" colspan="6" style="text-align: center;" ><h5>Grand Total</h5></td>
                <td class="tg-0lax">Rp.  {{ number_format($grandtotal, 0) }}</td>
                <td class="tg-0lax">Rp.  {{ number_format($granduntung, 0) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
