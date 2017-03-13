@extends('layouts.home')
@section('content')

<section class="content-header">
  <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

    <section class="content">

      @if(Session::has('message'))
      <div class="row">'
      <div class="col-xs-12">
        <div class="alert @if(Session::get('messageType') == 1) alert-success @else alert-danger @endif">
          {{ Session::get('message') }}
        </div>
      </div>
      </div>
      @endif

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $data['total_products'] }}</h3>

              <p>Total Products</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="/stock/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $data['sales_transactions'] }}</h3>

              <p>Sales Transactions</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="/sales/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $data['suppliers'] }}</h3>

              <p>Suppliers</p>
            </div>
            <div class="icon">
              <i class="fa fa-truck"></i>
            </div>
            <a href="/supplier/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $data['customers'] }}</h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="/customer/view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      {{-- <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Stocks Availability</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <h4 class="text-center loading"> <i class="fa fa-refresh fa-spin"></i> Loading, Please wait...</h4>
              <canvas id="myChart" width="400" height="120"></canvas>
            </div>
          </div>
        </div>
      </div> --}}

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
          <div class="box-header with-bstock_category">
            <h3 class="box-title">Stock Availability</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">

            <div class="row" style="width:99%;margin-left:5px">
                      <div class="col-xs-12">
                        <table id="table" class="table table-responsive" 
                               data-toggle="table"
                               data-url="{{ url('/stock/get/availability') }}"
                               data-pagination="true"
                               data-side-pagination="server"
                               data-page-list="[10, 20, 30 , 40 , 50, 100, 200]"
                               data-search="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-sort-name="stock_id"
                               data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="stock_id" data-align="center" data-sortable="true">Stock ID</th>
                                <th data-field="category.category_name" data-align="center" data-sortable="true">Stock Category</th>
                                <th data-field="stock_name" data-align="center" data-sortable="true">Stock Type</th>
                                <th data-field="purchase_cost" data-align="center" data-sortable="true">Purchase Cost (₹)</th>
                                <th data-field="selling_cost" data-align="center" data-sortable="true">Selling Cost (₹)</th>
                                <th data-field="stock_quantity" data-align="center" data-sortable="true">Available Quantity</th>
                            </tr>
                            </thead>
                        </table>
                      </div>
            </div>

          </div> 
          </div>
          <!-- /.box-body -->
          </div>
        </div>  
      </div>  

    </section>


@endsection
