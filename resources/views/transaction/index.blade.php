@extends('layouts_transaction.app')


@section('contents_transaction')
  <div class="row">
     <div class="swal" data-swal="{{ Session::get('success') }}">
      </div>
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Menu Makanan dan Minuman</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Makanan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Minuman</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">

                    <div class="row">
                      @foreach ($products_makanan as $value )
                        <div class="col-md-3">
                          <form action="{{ route('transaction.add_cart',$value->id_product)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="id_product" type="hidden" value="{{ $value->id_product }}">
                            <input name="selling_price" type="hidden" value="{{ $value->selling_price }}">
                            <input name="name" type="hidden" value="{{ $value->name }}">
                            <input name= "image" type="hidden" value="{{ $value->image }}">
                            <input name= "category_name" type="hidden" value="{{ $value->category_name }}">
                          
                            <div class="card card-outline card-primary">
                              <div class="card-header">
                                
                                <h5 class="card-title">{{ $value->name }}
                                </h5>
                              </div>

                              <div class="card-body text-center">
                                <p class="card-text">
                                  <img src="{{ asset('storage/'.$value->image) }}" class="img-fluid"/>
                                </p>

                                <label>Rp. {{ number_format($value->selling_price,0)}}</label
                                ><br />
                                <button type="submit" class="btn btn-primary btn-lg btn-flat">
                                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                  Tambah
                                </button>
                              </div>
                            </div>  
                          </form>
                        </div>
                      @endforeach
                    </div>
                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                     <div class="row">
                      @foreach ($products_minuman as $value )
                        <div class="col-md-3">
                          <form action="{{ route('transaction.add_cart',$value->id_product)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="id_product" type="hidden" value="{{ $value->id_product }}">
                            <input name="selling_price" type="hidden" value="{{ $value->selling_price }}">
                            <input name="name" type="hidden" value="{{ $value->name }}">
                            <input name= "image" type="hidden" value="{{ $value->image }}">
                            <input name= "category_name" type="hidden" value="{{ $value->category_name }}">
                          
                            <div class="card card-outline card-primary">
                              <div class="card-header">
                                
                                <h5 class="card-title">{{ $value->name }}
                                </h5>
                              </div>

                              <div class="card-body text-center">
                                <p class="card-text">
                                  <img src="{{ asset('storage/'.$value->image) }}" class="img-fluid"/>
                                </p>

                                <label>Rp. {{ number_format($value->selling_price,0)}}</label
                                ><br />
                                <button type="submit" class="btn btn-primary btn-lg btn-flat">
                                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                  Tambah
                                </button>
                              </div>
                            </div>  
                          </form>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      	

  <div class="col-lg-3">
 


  </div>









   
  

@endsection

