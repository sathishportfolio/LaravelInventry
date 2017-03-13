@extends('layouts.home')

@section('content')

<script type="text/javascript" src="/js/moment.min.js"></script>

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">View Stock Availability</li>
  </ol>
</section>

<!-- Main content -->
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
        <div class="col-xs-12">
          <div class="box box-info">
          <div class="box-header with-bstock_category">
            <h3 class="box-title">View Stock Availability</h3>

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
    <!-- /.content -->
@endsection
