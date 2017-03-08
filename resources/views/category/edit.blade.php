@extends('layouts.home')

@section('content')

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Stock Category</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Stock Category</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal create_category" role="form" method="POST" action="{{ url('/category/update/'.$category[0]->id) }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="row">
                        
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Category Name</label><br>
                            <input type="text" class="form-control" name="category_name" placeholder="" value="{{ $category[0]->category_name }}">
                          </div>
                        </div>

                      </div>

                      <div class="row">
                        
                        <div class="col-sm-12">
                          
                          <div class="panel panel-primary">
                            <div class="panel-heading">Measures & Units</div>
                              <div class="panel-body">
                                <div class="form-group">
                                  @foreach($details as $key => $val)

                                      <input type="checkbox" class="measures_check" name="measure_id[]" value="{{ $val->measure_id }}" required="" @if( in_array($val->measure_id, $measures_array) ) checked="" @endif> {{ $val->name }} <br></input>

                                      <div class="form-group measure_id_{{ $val->measure_id }}" @if( !in_array($val->measure_id, $measures_array) ) hidden="" @endif><br>
                                        @foreach($val->unit as $key1 => $val1)
                                          @if ($loop->first)
                                              &nbsp;&nbsp;&nbsp;&nbsp;
                                          @endif
                                          <input type="radio" class="measure_unit_{{ $val->measure_id }}" name="uom_id_{{ $val->measure_id }}" @if( !in_array($val->measure_id, $measures_array) ) disabled @endif required="" value="{{ $val1->uom_id }}" @if( in_array($val1->uom_id, $uom_array) ) checked="" @endif><span>&nbsp;{{ $val1->name }} &nbsp;&nbsp;</span></input>
                                          @if ($loop->last)
                                              <br><br>
                                          @endif
                                        @endforeach
                                      </div>
                                  @endforeach
                                </div>
                              </div>
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
