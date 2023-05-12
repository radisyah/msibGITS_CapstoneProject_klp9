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
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="" class="nav-link">Makanan</a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">Minuman</a>
        </li>
      </ul>

         <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-danger navbar-badge">10</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img s src="{{ asset('img') }}/{{'nasgor.jpg' }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nasi Goreng
                      <span class="float-right text-sm text-success">2x</span>
                    </h3>
                    <p class="text-sm text-muted">Rp. 10000</p>
                  </div>
                </div>
          
              <!-- Message End -->
            </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('transaction.view_cart') }}" class="dropdown-item dropdown-footer">View Chart</a>
              <a href="#" class="dropdown-item dropdown-footer">Check Out</a>
        

           
          </div>
        </li>
     
      </ul>
  </div>
</nav>
