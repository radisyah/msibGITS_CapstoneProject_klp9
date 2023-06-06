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

    <h1 class="page-title">Laporan Penjualan Bulanan | Periode : {{ date('M', strtotime($bulan)) }} {{ $tahun }}</h1>

    <table class="order-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Pendapatan</th>
                <th>Total Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no=1;
                $grandtotal = 0;
                $granduntung = 0;
            @endphp
            @foreach ($databulanan as $key => $item)
                <tr class="text-center">
                <td>{{$no}}</td>
                <td>{{$item->tanggal}}</td>
                <td>Rp.{{number_format($item->total_harga,0)}}</td>
                <td>Rp.{{number_format($item->untung,0)}}</td>
                </tr>
                @php
                $no++;
                $grandtotal += $item->total_harga;
                $granduntung += $item->untung;
                @endphp
            @endforeach
            <tr class="text-center bg-gray">
                <td class="tg-0lax" colspan="2" style="text-align: center;"><h5>Grand Total</h5></td>
                <td class="tg-0lax">Rp.  {{ number_format($grandtotal, 0) }}</td>
                <td class="tg-0lax">Rp.  {{ number_format($granduntung, 0) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
