@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kategori</h3>
        <div class="card-tools">
            <a href="{{ route('category.add') }}">
                <button type="button" data-target="" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-plus"></i> Add</button>
            </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <div class="swal" data-swal="{{ Session::get('success') }}">
      </div>
     
      <table id="example1" class="table table-bordered table-striped text-center">
        <thead>
          <tr >
            <th width="50px">No</th>
            <th>Kategori</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @php
            $no=1;
          @endphp
        @foreach  ($categories as $item)
          <tr class="">
            <td>{{ $no++ }}</td>
            <td>{{$item->category_name}}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('category.edit',$item->id)}}">
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

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<span class="subheading">Menawarkan</span>
				<h2 class="mb-2">Mobil Unggulan dari Kami</h2>
			</div>
		</div>
    <div class="row">

     <div class="col-md-4">
        <div class="car-wrap rounded ftco-animate">
          <div class="img rounded d-flex align-items-end" style="background-image: url();">
          </div>
          <div class="text">
            <h2 class="mb-0"><a>ssss</a></h2>
            <div class="d-flex mb-3">
                <span  class="price">ssad</span>
            </div>
            <p class="d-flex mb-0 d-block"><a target="_blank" href="https://web.whatsapp.com/send?phone=6283857959431&text=Hallo, saya mau rental mobil"  class="btn btn-primary py-2 mr-1">Sewa</a> <a href="<?= base_url('sewa-mobil-surabaya-malang/sewa-mobil-'.$value['keyword'].'-surabaya-malang') ?>" class="btn btn-secondary py-2 ml-1">Detail</a></p>
          </div>
        </div>
      </div>

      
      
    </div>
  </div>
</section>

@foreach ($categories as $item)
<div class="modal fade" id="delete{{ $item->id  }}">
  <div class="modal-dialog modal-danger">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin ingin menghapus {{ $item->name }} ?
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
        <a href="{{ route('category.destroy',$item->id)}}" type="submit" class="btn btn-outline-light">Iya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
@endforeach
@endsection
