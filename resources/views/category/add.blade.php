@extends('layouts.app')

@section('title', 'Data Kategori')

@section('contents')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
        </div>
        <form action="{{ route('category.store')}}" method="POST">
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
                    <label for="category_name">Nama Kategori</label>
                    <input type="text" class="form-control" id="category_name" placeholder="Nama Kategori" name="category_name">
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('category')}}" type="button" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
