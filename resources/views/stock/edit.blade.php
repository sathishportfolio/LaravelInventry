@extends('layouts.home')

@section('content')

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Stock</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Stock / Product</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal create_stock" role="form" method="POST" action="{{ url('/stock/update/'.$stock_details->stock_id) }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="row">

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Stock Category</label>
                            <input type="text" readonly="" class="form-control" value="{{ $stock_details->category->category_name }}">

                            <input type="hidden" name="stock_id" value="{{ $stock_details->stock_id }}">
                          </div>

                        </div>
                      
                      </div>

                      <div class="row unit_of_measure_container">
                        @foreach($stock_details->stock_unit as $su_key => $su_val)
                            <div class="col-sm-6">
                                <div class="form-group">
                                  <label>{{ $su_val->measures->name }} ( in {{ $su_val->uom->name }} )</label>
                                  <input type="hidden" name="measure_id[]" value="{{ $su_val->measures->measure_id }}">
                                  <input type="hidden" name="uom_id[]" value="{{ $su_val->uom->uom_id }}"> 
                                  <input type="number" min="0" class="form-control" name="value[]" value="{{ $su_val->value }}" autocomplete="off">
                                </div>
                            </div>    
                        @endforeach
                      </div>

                      <div class="row">
                       
                        {{-- <input type="hidden" class="measuring_units" name="measuring_units"> --}}
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Purchase Cost / Unit</label><br>
                            <input type="text" class="form-control" name="purchase_cost" placeholder="0.00"  value="{{ $stock_details->purchase_cost }}">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Selling Cost / Unit</label>
                            <input type="text" class="form-control" name="selling_cost" placeholder="0.00"  value="{{ $stock_details->selling_cost }}">
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        
                        

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Supplier Name</label><br>
                            <select class="form-control change_supplier_name" name="supplier_id">
                            <option selected="" disabled="" value="">- Select - </option>

                              @if($stock_details->supplier_id == 0)
                                  <option value="0" selected="">- Multiple suppliers -</option>
                              @else
                                  <option value="0">- Multiple suppliers -</option>    
                              @endif 
                                  
                              @foreach($supplier_details as $key1 => $value1)
                                
                                @if($stock_details->supplier_id == $key1)
                                  <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                @else  
                                  <option value="{{ $key1 }}">{{ $value1 }}</option>
                                @endif

                              @endforeach

                            </select>
                            <input type="hidden" name="supplier_name" class="supplier_name">
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
