    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
        <img
          src="{{ asset('/template/dist/img/AdminLTELogo.png') }}"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">E-Order</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        
        <!-- Sidebar user panel (optional) -->
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                src="{{ asset('img/admin.jpg') }}"
                class="img-circle elevation-2"
                alt="User Image"
              />
            </div>
            <div class="info">
              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            @if (auth()->user()->roles->level === 'Super Admin')
              
            <li class="nav-item">
              <a
                 href="{{ route('dashboard') }}"
                class="nav-link {{ $menu == 'dashboard' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>

            {{-- <li class="nav-item">
              <a
                 href="{{ route('kirimWA') }}"
                 href="{{ route('index_transaction') }}"
                class="nav-link {{ $menu == 'transaction' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Cart</p>
              </a>
            </li> --}}

            <li class="nav-item {{ $menu == 'master' ? 'menu-open' : '' }} ">
              <a href="#" class="nav-link {{ $menu == 'master' ? 'active' : '' }} ">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Master Data
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a
                    href="{{ route('category') }}"
                    class="nav-link {{ $sub_menu == 'kategori' ? 'active' : '' }}"
                  >
                    <i
                     class="{{ $sub_menu == 'kategori' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Kategori</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a
                    href="{{ route('products') }}"
                    class="nav-link {{ $sub_menu == 'produk' ? 'active' : '' }}"
                  >
                    <i
                      class="{{ $sub_menu == 'produk' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Produk</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a
                    href="{{ route('nomor_meja') }}"
                    class="nav-link {{ $sub_menu == 'nomor_meja' ? 'active' : '' }}"
                  >
                    <i
                      class="{{ $sub_menu == 'nomor_meja' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Nomor Meja</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a
                 href="{{ route("transaction_order") }}"
                class="nav-link {{ $menu == 'transaction_order' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-table"></i>
                <p>Transaksi Order</p>
              </a>
            </li>

             <li class="nav-item">
              <a
                href="{{ route('list_order') }}"
                class="nav-link {{ $menu == 'list_order' ? 'active' : '' }}" 
              >
                <i class="nav-icon ion ion-bag"></i>
                <p>List Order</p>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('list_proses') }}"
                class="nav-link {{ $menu == 'list_proses' ? 'active' : '' }}" 
              >
                <i class="nav-icon far fa-clock"></i>
                <p>List Proses</p>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('list_payment') }}"
                class="nav-link {{ $menu == 'list_payment' ? 'active' : '' }}" 
              >
                <i class="nav-icon ion ion-android-bookmark"></i>
                <p>List Serve</p>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('list_transaksi') }}"
                class="nav-link {{ $menu == 'list_transaction' ? 'active' : '' }}" 
              >
                <i class="nav-icon ion ion-cash"></i>
                <p>Riwayat Transaksi</p>
              </a>
            </li>

            <li class="nav-item {{ $menu == 'laporan' ? 'menu-open' : '' }} ">
              <a href="#" class="nav-link {{ $menu == 'laporan' ? 'active' : '' }} ">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a
                    href="{{ route('laporan_harian') }}"
                    class="nav-link {{ $sub_menu == 'l_harian' ? 'active' : '' }}"
                  >
                    <i
                     class="{{ $sub_menu == 'l_harian' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Laporan Harian</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a
                    href="{{ route('laporan_bulanan') }}"
                    class="nav-link {{ $sub_menu == 'l_bulanan' ? 'active' : '' }}"
                  >
                    <i
                      class="{{ $sub_menu == 'l_bulanan' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Laporan Bulanan</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a
                    href="{{ route('laporan_tahunan') }}"
                    class="nav-link {{ $sub_menu == 'l_tahunan' ? 'active' : '' }}"
                  >
                    <i
                      class="{{ $sub_menu == 'l_tahunan' ? 'far fa-dot-circle nav-icon' : 'far fa-circle nav-icon' }}"
                    ></i>
                    <p>Laporan Tahunan</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a
                href="{{ route('live_report_ordering') }}"
                class="nav-link {{ $menu == 'live_report_ordering' ? 'active' : '' }}" 
              >
                <i class="nav-icon fas fa-map-marker-alt"></i>
                <p>Live Report Ordering</p>
              </a>
            </li>
            @endif

            @if (auth()->user()->roles->level === 'Admin Dapur')
            <li class="nav-item">
              <a
                href="{{ route('list_order') }}"
                class="nav-link {{ $menu == 'list_order' ? 'active' : '' }}" 
              >
                <i class="nav-icon ion ion-bag"></i>
                <p>List Order</p>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('list_proses') }}"
                class="nav-link {{ $menu == 'list_proses' ? 'active' : '' }}" 
              >
                <i class="nav-icon far fa-clock"></i>
                <p>List Proses</p>
              </a>
            </li>
            @endif

            @if (auth()->user()->roles->level === 'Admin Kasir')
             <li class="nav-item">
              <a
                href="{{ route('list_payment') }}"
                class="nav-link {{ $menu == 'list_payment' ? 'active' : '' }}" 
              >
                <i class="nav-icon ion ion-android-bookmark"></i>
                <p>List Serve</p>
              </a>
            </li>

            @endif



          

        
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
