@extends('layouts.app')

@section('contents')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{$judul}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label>Bulan</label>
            <select name="bulan" id="bulan" class="form-control">
              <option value="">Bulan</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
          </div>
        </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label>Tahun</label>
            <div class="col-10 input-group">
              <select name="tahun" id="tahun" class="form-control">
                <option value="">Tahun</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
              </select>
              <span class="input-group-append">
                <button
                  onclick="ViewTabelLaporan()"
                  class="btn btn-primary btn-flat"
                  data-toggle="modal"
                  data-target="#cari-produk"
                >
                  <i style="color: white" class="fas fa-file-alt"></i>
                </button>
             
                 <button
                 class="btn btn-danger btn-flat"
                 onclick="EksportPDF()"
                 >
                  <i class="fas fa-file-pdf"></i> PDF
                </button>
                <button
                 class="btn btn-success btn-flat"
                 onclick="EksportExcel()"
                 >
                  <i class="fas fa-file-excel"></i> Excel
                </button>
              </span>
            </div>
          </div>
        </div>

        <div class="col-sm-12">
          <hr>
          <div class="Tabel">
          

          </div>
        </div>
        
      </div>
      
    </div>
    <!-- /.card-body -->
  </div>
</div>

<script>
  function ViewTabelLaporan() {
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    if (bulan=='') {
      swal({
        title: "Bulan Belum Dipilih",
        icon: 'warning',
      })  
    }else if(tahun==''){
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      })  
    }
    else {
      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('view_laporan_bulanan') }}",
        data: {
          bulan: bulan,
          tahun: tahun,
        },
        dataType: "JSON",
        success: function(response) {
          if (response.data) {
            $('.Tabel').html(response.data);
          }
        }
      });
    }
  }

  
  function EksportPDF() {
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    if (bulan=='') {
      swal({
        title: "Bulan Belum Dipilih",
        icon: 'warning',
      })  
    }else if(tahun==''){
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      })  
    }else {
      let url = '{{ route("eksport_pdf_laporan_bulanan", [":bulan", ":tahun"]) }}';
      url = url.replace(':bulan', bulan);
      url = url.replace(':tahun', tahun);
      window.location.href = url;
    }
  }

  function EksportExcel() {
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    if (bulan=='') {
      swal({
        title: "Bulan Belum Dipilih",
        icon: 'warning',
      })  
    }else if(tahun==''){
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      })  
    }else {
      let url = '{{ route("eksport_excel_laporan_bulanan", [":bulan", ":tahun"]) }}';
      url = url.replace(':bulan', bulan);
      url = url.replace(':tahun', tahun);
      window.location.href = url;
    }
  }

</script>

@endsection