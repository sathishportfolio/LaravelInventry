@extends('layouts.home')

@section('content')

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Sales</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Sales</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal create_sales" role="form" method="POST" action="{{ url('/sales/update/'.$sales_details->sales_id) }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="row">

                        {{-- <div class="col-sm-6">
                          <div class="form-group">
                            <label>Sales ID</label><br>
                            <input type="text" class="form-control" name="sales_id" placeholder="">
                          </div>
                        </div> --}} 

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Sales Name</label>
                            <input type="text" class="form-control" name="sales_name" placeholder="" value="{{ $sales_details->sales_name }}">
                          </div>
                        </div>

                        

                      </div>

                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Sales Category</label>
                            <select class="form-control" name="category_id">
                            <option selected="" disabled="" value="">- Select - </option>
                              @foreach($category_details as $key => $value)
                                @if($sales_details->category_id == $key)
                                  <option value="{{ $key }}" selected="">{{ $value }}</option>
                                @else
                                  <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Sales Cost</label><br>
                            <input type="text" class="form-control" name="sales_cost" placeholder="0.00"  value="{{ $sales_details->sales_cost }}">
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Selling Cost</label>
                            <input type="text" class="form-control" name="selling_cost" placeholder="0.00"  value="{{ $sales_details->selling_cost }}">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Supplier Name</label><br>
                            <select class="form-control" name="supplier_id">
                            <option selected="" disabled="" value="">- Select - </option>
                              @foreach($supplier_details as $key1 => $value1)
                                @if($sales_details->supplier_id == $key1)
                                  <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                @else
                                  <option value="{{ $key1 }}">{{ $value1 }}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                        </div>

                        

                      </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="reset" class="btn btn-danger pull-left">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Update</button>
                    </div>
            </form>
          </div>
          <!-- /.box-body -->
          </div>
        </div>  
      </div>  
    </section>
    <!-- /.content -->
@endsection
