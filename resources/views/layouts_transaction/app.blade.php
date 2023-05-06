<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/template/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     
    <!-- DataTables -->
    <link
      rel="stylesheet"
      href="{{ asset('/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"
    />
  
  

   
    <!-- jQuery -->
    <script src="{{ asset('/template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('/template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
      <!-- Auto Numerik -->
    <script src="{{ asset('/autoNumeric/src/AutoNumeric.js') }}"></script>
    <!-- Terbilang -->
    <script src="{{ asset('/terbilang/terbilang.js') }}"></script>
    <script src="https://kit.fontawesome.com/570bdaf656.js" crossorigin="anonymous"></script>
    
  
  </head>
</html>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

    <!-- Nav -->
    @include('layouts_transaction.navbar')
    <!-- End of Nav -->

     
    @yield('contents_transaction')
      

    @include('layouts_transaction.footer')





<!-- jQuery -->
<script src="{{ asset('/template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('/template/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('/template/dist/js/adminlte.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('/template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>

  const swal = $('.swal').data('swal');
  const swal2 = $('.swal2').data('swal2');

 if (swal) {
    Swal.fire({
      title: "MAAF !!",
      text: swal,
      icon: 'error'
    })
  }else if (swal2) {
    Swal.fire({
      title: "SELAMAT !!",
      text: swal2,
      icon: 'success'
    })
  }
  
</script>


</body>
</html>
