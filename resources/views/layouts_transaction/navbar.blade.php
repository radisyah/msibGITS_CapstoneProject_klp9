 <nav class="main-header navbar fixed-top navbar-expand navbar-light navbar-white">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <span class="brand-text font-weight-light"><b>E-</b>Order</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
     

         <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        @php
          $keranjang = Cart::content();
          $jumlah_item = 0;

          foreach ($keranjang as $key => $value) {
            $jumlah_item = $jumlah_item + $value->qty;
          }
        @endphp
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link"  href="{{ route('view_cart', $NomorMeja->nomor_meja) }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-danger navbar-badge">{{ $jumlah_item }}</span>
          </a>
        </li>
     
      </ul>
  </div>
</nav>
