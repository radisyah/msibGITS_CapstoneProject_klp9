@extends('layouts_live_ordering.app')

@section('title', 'Live Report Ordering')

@section('contents_live_ordering')
<br>

<div class="card-body p-0">
  <div class="table-responsive table-scrollable">
    <table class="table m-0">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pembeli</th>
          <th>Nomor Meja</th>
          <th>Status</th>
        </tr>
      </thead>
      @php
        $no =1;
      @endphp
      @foreach ( $orders as $item )
      <tbody>
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $item->customer_name }}</td>
          <td>{{ $item->nomorMeja->nomor_meja }}</td>
          <td>
            @if ($item->status  == 'Order')
              <span class="badge badge-warning">{{ $item->status }}</span>
            @elseif ($item->status  == 'Proses')
              <span class="badge badge-info">{{ $item->status }}</span>
            @elseif ($item->status  == 'Serve')
              <span class="badge badge-success">{{ $item->status }}</span>
            @endif
            
          </td>
        </tr>
      </tbody>
      @endforeach
      
    </table>
  </div>
</div>



<script>
var tableScrollable = document.querySelector('.table-scrollable');
var scrollHeight = tableScrollable.scrollHeight;
var scrollTop = 0;
var scrollSpeed = 0.8; // Kecepatan scroll dalam pixel per iterasi
var scrollDelay = 2500  ; // Waktu jeda sebelum kembali ke atas (dalam milidetik)

function scrollTable() {
  tableScrollable.scrollTop = scrollTop;
  scrollTop += scrollSpeed;

  if (scrollTop >= scrollHeight) {
    tableScrollable.classList.add('scrolling');
    setTimeout(function() {
      tableScrollable.classList.remove('scrolling');
      scrollTop = 0;
      setTimeout(function() {
        location.reload(); // Memperbarui halaman ketika scrollbar mencapai akhir
      }, scrollDelay);
    }, scrollDelay);
  } else {
    requestAnimationFrame(scrollTable);
  }
}

window.addEventListener('DOMContentLoaded', function() {
  scrollHeight = tableScrollable.scrollHeight; // Perbarui scrollHeight saat halaman dimuat sepenuhnya
  scrollTable();
});
 
</script>






 
@endsection