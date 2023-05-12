@extends('layouts_transaction.app')


@section('contents_transaction')

<div class="container">
<div class="col-lg-12">
  
</div>

  <!-- Main content -->
  <div class="invoice p-3 mb-3">
    
    <div class="row">
      <div class="col-12">
        <h4>
          <i class='fas fa-shopping-cart'></i> Keranjang Belanja
        </h4>
      </div>
    </div>
    
    <br>
    
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th width="100px">Qty</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td><input name='qty' type="number" min="1" class="form-control" value="2"></td>
              <td>Nasi Goreng</td>
              <td>Rp. 20.000</td>
              <td>Rp. 20.000</td>
              <td>
                <a href="" class="btn btn-sm btn-danger">
                  <i class="fas fa fa-trash"></i>
                </a>
              </td>
            </tr>
             <tr>
              <td><input name='qty' type="number" min="1" class="form-control" value="2"></td>
              <td>Nasi Goreng</td>
              <td>Rp. 20.000</td>
              <td>Rp. 20.000</td>
              <td>
                <a href="" class="btn btn-sm btn-danger">
                  <i class="fas fa fa-trash"></i>
                </a>
              </td>
            </tr>
             <tr>
              <td><input name='qty' type="number" min="1" class="form-control" value="2"></td>
              <td>Nasi Goreng</td>
              <td>Rp. 20.000</td>
              <td>Rp. 20.000</td>
              <td>
                <a href="" class="btn btn-sm btn-danger">
                  <i class="fas fa fa-trash"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        
      </div>
      <!-- /.col -->
      <div class="col-6">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Grandtotal:</th>
              <td>Rp. 200,000</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
        <a href="" class="btn btn-warning">
          <i class="fa fa-trash"></i>
          Clear Keranjang
        </a>
        <button type="button" class="btn btn-success float-right">
        <i class="far fa-credit-card"></i>
         Cek Out
        </button>
       
      
       
      </div>
    </div>

  </div>
 
</div>
        <!-- /.invoice -->


@endsection

