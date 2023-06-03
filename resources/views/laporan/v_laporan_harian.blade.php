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
        <div class="col-sm-6">
          <div class="form-group row">
          
            <div class="col-10 input-group">
              <input
                name="tgl"
                class="form-control"
                type="date"
                id="tgl"
              />
              <span class="input-group-append">
                <button
                  onclick="ViewTabelLaporan()"
                  class="btn btn-primary btn-flat"
                  data-toggle="modal"
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
    let tgl = $('#tgl').val();
    if (tgl=='') {
      swal({
        title: "Tanggal Belum Dipilih",
        icon: 'warning',
      })  
    } else {
      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{ route('view_laporan_harian') }}",
        data: {
          tgl: tgl,
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
    let tgl = $('#tgl').val();
    if (tgl == '') {
      swal({
        title: "Tanggal Belum Dipilih",
        icon: 'warning',
      });
    } else {
      let url = '{{ route("eksport_pdf_laporan_harian", ":tgl") }}';
      url = url.replace(':tgl', tgl);
      window.location.href = url;
    }
  }

  function EksportExcel() {
    let tgl = $('#tgl').val();
    if (tgl == '') {
      swal({
        title: "Tanggal Belum Dipilih",
        icon: 'warning',
      });
    } else {
      let url = '{{ route("eksport_excel_laporan_harian", ":tgl") }}';
      url = url.replace(':tgl', tgl);
      window.location.href = url;
    }
  }
</script>

@endsection