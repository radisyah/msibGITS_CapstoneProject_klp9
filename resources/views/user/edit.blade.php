@extends('layouts.app')

@section('title', 'Data User')

@section('contents')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <form action="{{ route('user.update',$user->id) }}" method="POST">
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
                    <label for="name">Nama User</label>
                    <input type="text" class="form-control" id="name" placeholder="Nama User" name="name" value="{{isset($user) ? $user->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{isset($user) ? $user->email : ''}}">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control select2" style="width: 100%;" name="role_id" value="{{isset($user) ? $user->role_id : ''}}">
                        {{-- <option selected="selected" value="{{$categories->name}}"></option> --}}
                        @foreach ($roles as $item)
                        <option value="{{$item->id}}"{{$user->role_id== $item->id ? 'Selected' : ''}}>{{$item->level}}</option>
                        @endforeach
                    </select>
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
