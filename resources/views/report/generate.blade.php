@extends('layouts.home')

@section('content')

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Generate Report</li>
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
        <div class="col-md-offset-2 col-md-8">
          <div class="box box-info">
          <div class="box-header with-bsales">
            <h3 class="box-title">Generate Report</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
          <form class="form-horizontal generate_report" role="form" method="GET" action="{{ url('/report/view_report') }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="row">
                        
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Report Type</label>
                            <select class="form-control" name="report_type">
                              <option selected="" disabled="" value="">- Select -</option>
                              <option value="1">Purchase</option>
                              <option value="2">Sales</option>
                              {{-- <option value="3">Purchase Stock</option> --}}
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>From</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right from" name="from" autocomplete="off">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>To</label><br>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right to" name="to" autocomplete="off">
                            </div>
                          </div>
                        </div>

                      </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="reset" class="btn btn-danger pull-left">Reset</button>
                      <button type="submit" name="submitName" class="btn btn-primary pull-right"><i class="fa fa-line-chart"></i> Generate </button>
                    </div>
            </form>
          </div> 
          </div>
          <!-- /.box-body -->
          </div>
        </div>  
      </div>  
    </section>
    <!-- /.content -->
@endsection
