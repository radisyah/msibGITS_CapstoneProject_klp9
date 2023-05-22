@extends('layouts.app')

@section('title', 'Data Nomor Meja')

@section('contents')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Nomor Meja</h3>
        </div>
        <form action="{{ route('nomor_meja.update',$nomor_meja->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="nomor_meja">Nama Nomor Meja</label>
                    <input type="text" class="form-control" id="nomor_meja" placeholder="Nomor Meja" name="nomor_meja" value="{{isset($nomor_meja) ? $nomor_meja->nomor_meja : ''}}">
                </div>
                <div class="form-group">
                    <label for="qr">QR Code</label>
                   <input type="file" class="form-control" id="qr" name="qr">
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('nomor_meja')}}" type="button" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
