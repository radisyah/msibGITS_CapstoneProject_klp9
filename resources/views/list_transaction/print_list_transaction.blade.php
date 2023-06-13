<!DOCTYPE html>
<html>
<head>
  <title>Nota Transaksi Makanan</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 5px;
    }

    @media print {
      table {
        width: auto;
      }
    }
  </style>
</head>
<body>
  <h1>Nota Transaksi</h1>
  <p><strong>Nomor Invoice:</strong> {{ $details2->invoice }}</p>
  <p><strong>Tanggal:</strong> {{ date('Y-m-d', strtotime($details2->created_at)) }}</p>
  <p><strong>Status:</strong> {{ $details2->status }}</p>
  <table>
    <tr>
      <th>Menu</th>
      <th>Jumlah</th>
      <th>Harga</th>
      <th>Subtotal</th>
    </tr>
    @foreach ($details as $item )
    <tr>
      <td>{{ $item->name }}</td>
      <td>{{ $item->qty }}</td>
      <td>Rp. {{ number_format($item->product_price,0) }}</td>
      <td>Rp. {{ number_format($item->product_price*$item->qty,0) }}</td>
    </tr>
    @endforeach
    <tr>
      <td colspan="3" style="text-align: right;"> <strong>Total:</strong> </td>
      <td>Rp. {{ number_format($details2->total_price) }}</td>
    </tr>
     <tr>
      <td colspan="3" style="text-align: right;"><strong>Pembayaran:</strong></td>
      <td>Rp. {{ number_format($details2->payment) }}</td>
    </tr>
     <tr>
      <td colspan="3" style="text-align: right;"><strong>Kembalian:</strong></td>
      <td>Rp. {{ number_format($details2->change,0) }}</td>
    </tr>
  </table>

<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
