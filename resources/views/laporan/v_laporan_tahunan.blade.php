@extends('layouts.app')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $judul }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
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
                <option value="2026">2027</option>
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
    let tahun = $('#tahun').val();
    if (tahun=='') {
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      })  
    } else {
      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('view_laporan_tahunan') }}",
        data: {
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
    let tahun = $('#tahun').val();
    if (tahun == '') {
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      });
    } else {
      let url = '{{ route("eksport_pdf_laporan_tahunan", ":tahun") }}';
      url = url.replace(':tahun', tahun);
      window.location.href = url;
    }
  }

  function EksportExcel() {
    let tahun = $('#tahun').val();
    if (tahun == '') {
      swal({
        title: "Tahun Belum Dipilih",
        icon: 'warning',
      });
    } else {
      let url = '{{ route("eksport_excel_laporan_tahunan", ":tahun") }}';
      url = url.replace(':tahun', tahun);
      window.location.href = url;
    }
  }
</script>

@endsection