@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Nomor Meja</h3>
        <div class="card-tools">
            <a href="{{ route('nomor_meja.add') }}">
                <button type="button" data-target="" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-plus"></i> Add</button>
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <div class="swal2" data-swal2="{{ Session::get('success') }}">
      </div>
     
      <table id="example1" class="table table-bordered table-striped text-center">
        <thead>
          <tr >
            <th width="50px">No</th>
            <th>Nomor Meja</th>
            <th>QR Code (QR MASIH CONTOH)</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @php
            $no=1;
          @endphp
        @foreach  ($nomor_meja as $item)
          <tr class="">
            <td>{{ $no++ }}</td>
            <td>{{$item->nomor_meja}}</td>
            <td>
              <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data= $item->nomor_meja" class="text-blue-500"><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data= $item->nomor_meja" alt="Lihat QR" class="w-16 h-16" "></a>
                {{-- <a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data= $item->nomor_meja"></a> --}}
              {{-- <img src="{{ asset('storage/'.$item->qr) }}" style="height:80px" alt="image"> --}}
            </td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('nomor_meja.edit',$item->id)}}">
                  Edit
                </a>
                <button data-toggle="modal" data-target="#delete{{ $item->id }}" class="btn btn-sm btn-danger">Delete</button>
                {{-- <a href="{{ route('category.destroy',$item->id)}}">
                </a> --}}
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>



@foreach ($nomor_meja as $item)
<div class="modal fade" id="delete{{ $item->id  }}">
  <div class="modal-dialog modal-danger">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Nomor Meja</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin ingin menghapus {{ $item->name }} ?
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
        <a href="{{ route('nomor_meja.destroy',$item->id)}}" type="submit" class="btn btn-outline-light">Iya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endforeach
@endsection
