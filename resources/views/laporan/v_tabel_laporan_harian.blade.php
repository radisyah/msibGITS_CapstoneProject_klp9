<table class="table table-bordered table-striped">
	<tr class="text-center bg-gray">
		<th>No</th>
		<th>Kode Produk</th>
		<th>Nama Produk</th>
		<th>Modal</th>
		<th>Harga Jual</th>
		<th>Terjual</th>
		<th>Total Harga</th>
		<th>Total Untung</th>
	</tr>
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
  <tr class="text-center bg-gray">
    <td class="tg-0lax" colspan="6"><h5>Grand Total</h5></td>
    <td class="tg-0lax">Rp.  {{ number_format($grandtotal, 0) }}</td>
    <td class="tg-0lax">Rp.  {{ number_format($granduntung, 0) }}</td>
  </tr>
</table>