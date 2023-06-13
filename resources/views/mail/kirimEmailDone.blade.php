
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nota Transaksi</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: bdone-box;
    }
    
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
    }
    
    .header {
      text-align: center;
      padding-bottom: 20px;
    }
    
    .invoice-details {
      margin-bottom: 20px;
    }
    
    .invoice-details p {
      margin: 5px 0;
    }
    
    .invoice-table {
      width: 100%;
      bdone-collapse: collapse;
      margin-bottom: 20px;
    }
    
    .invoice-table th,
    .invoice-table td {
      bdone: 1px solid #dddddd;
      padding: 8px;
      text-align: left;
    }
    

    
    @media screen and (max-width: 600px) {
      .container {
        width: 100%;
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Nota Transaksi</h1>
    </div>
    @foreach ($dones as $done)
    <div class="invoice-details">
      <p><strong>Nomor Invoice:</strong> {{ $done->invoice }}</p>
      <p><strong>Tanggal:</strong> {{  date('Y-m-d', strtotime($done->created_at)) }}</p>
      <p><strong>Status:</strong> {{  $done->status }}</p>
    </div>
    <table class="invoice-table">
      <thead>
        <tr>
          <th>Menu</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($done->detailTransaksi as $detail )
        <tr>
          <td>{{ $detail->products->name }}</td>
          <td>{{ $detail->qty }}</td>
          <td>Rp. {{number_format($detail->product_price,0)}}</td>
          <td>Rp. {{number_format($detail->product_price*$detail->qty,0)}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
          <td>Rp. {{number_format($done->total_price,0)}}</td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right;"><strong>Pembayaran:</strong></td>
          <td>Rp. {{number_format($done->payment,0)}}</td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right;"><strong>Kembalian:</strong></td>
          <td>Rp. {{number_format($done->change,0)}}</td>
        </tr>
      </tfoot>
    </table>
    @endforeach
  </div>
</body>
</html>