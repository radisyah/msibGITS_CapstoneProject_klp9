@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
  

<div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3>{{ $product }}</h3>

      <p>Produk</p>
    </div>
    <div class="icon">
      <i class="fas fa-boxes"></i>
    </div>
    <a href="{{ route('products') }}" class="small-box-footer">
      More Info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>{{ $category }}<sup style="font-size: 20px"></sup></h3>

      <p>Kategori</p>
    </div>
    <div class="icon">
      <i class="fas fa-th-list"></i>
    </div>
    <a href="{{ 'category' }}" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3>{{ $user }}</h3>

      <p>User</p>
    </div>
    <div class="icon">
      <i class="fas fa-users"></i>
    </div>
    <a href="" class="small-box-footer">
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>


<div class="col-lg-3 col-6">
  <!-- small card -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3>10</h3>

      <p>Transaksi</p>
    </div>
    <div class="icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    {{-- <a href="{{ route('list_transaction') }}" class="small-box-footer"> --}}
      More info <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-navy">
    <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Hari Ini</span>
      {{-- <span class="info-box-number">Rp. {{ number_format($p_hari_ini,0) }}</span> --}}
    </div>
    <!-- /.info-box-content -->
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-indigo">
    <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Bulan Ini</span>
      {{-- <span class="info-box-number">Rp. {{ number_format($p_bulan_ini,0) }}</span> --}}
    </div>
    <!-- /.info-box-content -->
  </div>
</div>

<div class="col-md-4">
  <!-- Info Boxes Style 2 -->
  <div class="info-box mb-3 bg-fuchsia">
    <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pendapatan Tahun Ini </span>
      {{-- <span class="info-box-number">Rp. {{ number_format($p_tahun_ini,0) }}</span> --}}
    </div>
    <!-- /.info-box-content -->
  </div>
</div>


 
@endsection
