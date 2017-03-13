@extends('layouts.home')

@section('content')

<script type="text/javascript" src="/js/moment.min.js"></script>

<script type="text/javascript">

  function createdFormatter(value, row, index) {

      return [ moment(row['created_at']).format('Do MMM YYYY, h:mm A') ];
      
  }

  function modeFormatter(value, row, index) {

    if(row['mode'] == 1){
      return ['Cash'];
    }else if(row['mode'] == 2){
      return ['Cheque'];
    }else if(row['mode'] == 3){
      return ['Card'];
    }  

  }

</script>

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add Purchase</li>
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
          <div class="box-header with-bpurchase">
            <h3 class="box-title">View Purchases</h3>

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
                               data-url="{{ url('/purchase/index') }}"
                               data-pagination="true"
                               data-side-pagination="server"
                               data-page-list="[10, 20, 30 , 40 , 50, 100, 200]"
                               data-search="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-sort-name="purchase_id"
                               data-sort-order="desc">
                            <thead>
                            <tr>
                                
                                <th data-field="purchase_id" data-align="center" data-sortable="true">Purchase ID</th>
                                
                                <th data-field="supplier_name" data-align="center" data-sortable="true">Supplier</th>

                                <th data-field="opening_due" data-align="center" data-sortable="true">Opening Due</th>

                                <th data-field="opening_balance" data-align="center" data-sortable="true">Opening Balance</th>

                                <th data-field="purchase_total" data-align="center" data-sortable="true">Purchase Total</th>

                                <th data-field="discount_amount" data-align="center" data-sortable="true">Discount</th>

                                <th data-field="tax_amount" data-align="center" data-sortable="true">Tax</th>

                                <th data-field="grand_total" data-align="center" data-sortable="true">Grand total</th>

                                <th data-field="payment" data-align="center" data-sortable="true">Payment</th>
                                
                                <th data-field="closing_due" data-align="center" data-sortable="true">Closing Due</th>

                                <th data-field="closing_balance" data-align="center" data-sortable="true">Closing Balance</th>

                                <th data-field="mode" data-align="center" data-formatter="modeFormatter" data-sortable="true">Mode</th>
                                
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
