<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

      <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/template/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/template/dist/css/adminlte.min.css') }}">
  
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
     <!-- Auto Numerik -->
    <script src="{{ asset('/autoNumeric/src/AutoNumeric.js') }}"></script>
   
    
    <script src="https://kit.fontawesome.com/570bdaf656.js" crossorigin="anonymous"></script>
    
  
  </head>
</html>

<body class="hold-transition sidebar-mini sidebar-collapse">
  <div class="wrapper">

    <!-- Nav -->
    @include('layouts.navbar')
    <!-- End of Nav -->

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ $title }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">{{ $judul }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $sub_judul }}</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
           @yield('contents')
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>

    

    @include('layouts.footer')



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


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
 

 <script type="text/javascript">
    $('.show-alert-proses-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
         swal({
            title: "Apakah anda yakin ingin memproses?",
            text: "Daftar menu akan diproses!",
            icon: "warning",
            type: "warning",
            dangerMode: true,
            buttons: ["Batalkan","Iya"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((willProses) => {
            if (willProses) {
                form.submit();
            }
        });
    });
</script>

 <script type="text/javascript">
    $('.show-alert-serve-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
         swal({
            title: "Apakah anda yakin ingin menghidangkan?",
            text: "Daftar menu akan dihidangkan!",
            icon: "warning",
            type: "warning",
            dangerMode: true,
            buttons: ["Batalkan","Iya"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((willServe) => {
            if (willServe) {
                form.submit();
            }
        });
    });
</script>



<script>
  window.setTimeout(function(){
    $('.alert').fadeTo(500,0).slideUp(500,function(){
      $(this).remove();
    });
  },3000);
</script>

<script>

 const swal2 = $('.swal2').data('swal2');

 if (swal2) {
    swal({
      title: "SUKSES !!",
      text: swal2,
      icon: 'success',
      type: "success",

    })  
  }
  
</script>




</body>
</html>
