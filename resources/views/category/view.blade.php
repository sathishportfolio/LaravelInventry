@extends('layouts.home')

@section('content')

<script type="text/javascript" src="/js/moment.min.js"></script>

<script type="text/javascript">

  function createdFormatter(value, row, index) {

      return [ moment(row['created_at']).format('Do MMM YYYY, h:mm A') ];
      
  }

  function actionFormatter(value, row, index) {

      // <a href="/stock_category/show/'+row['id']+'" data-toggle="tooltip" title="View"> <i class="fa fa-eye"></i> </a> &nbsp;&nbsp;
      
      return [ '<a href="/category/edit/'+row['id']+'" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;<a href="/category/destroy/'+row['id']+'" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>' ];

  }

  function measuresFormatter(value, row, index) {

    var data = null;

    $.each( row['units'], function( index, value ){
      if(data == null){
        data = value.measures.name;
      }else{
        data += " x " + value.measures.name;
      }
    });
      
      
      return data;

  }

  function unitFormatter(value, row, index) {

    var data = null;

    $.each( row['units'], function( index, value ){
      if(data == null){
        data = value.uom.name;
      }else{
        data += " x " + value.uom.name;
      }
    });
      
      
      return data;

  }

</script>

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">View Stock Category</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

    @if(Session::has('message'))
    <div class="row">'
    <div class="col-md-offset-2 col-md-8">
      <div class="alert @if(Session::get('messageType') == 1) alert-success @else alert-danger @endif">
        {{ Session::get('message') }}
      </div>
    </div>
    </div>
    @endif

      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
          <div class="box-header with-bstock_category">
            <h3 class="box-title">View Stock Category</h3>

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
                               data-url="{{ url('/category/index') }}"
                               data-pagination="true"
                               data-side-pagination="server"
                               data-page-list="[10, 20, 30 , 40 , 50, 100, 200]"
                               data-search="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-sort-name="id"
                               data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="id" data-align="center" data-sortable="true">Category ID</th>
                                <th data-field="category_name" data-align="center" data-sortable="true">Category Name</th>
                                
                                <th data-align="center" data-formatter="measuresFormatter"> Measures </th>

                                <th data-align="center" data-formatter="unitFormatter"> Unit </th>

                                <th data-align="center" data-formatter="actionFormatter" data-events="actionEvents"> Action </th>
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
