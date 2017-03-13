@extends('layouts.home')
@section('content')

<style type="text/css">
  th,td {
      text-align: center;
  }
</style>

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Purchase Report</li>
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

    <form class="form-horizontal generate_report_inline" role="form" method="GET" action="{{ url('/report/view_report') }}">
      <div class="row">
      <div class="col-md-offset-3 col-md-2">
        <div class="form-group">
          <label>Report Type</label>
            <select class="form-control inline_report_type" name="report_type">
              <option selected="" disabled="" value="">- Select -</option>
              <option value="1" @if($data['report_type'] == 1) selected="" @endif>Purchase</option>
              <option value="2" @if($data['report_type'] == 2) selected="" @endif>Sales</option>
              {{-- <option value="3"  @if($data['report_type'] == 3) selected="" @endif>Purchase Stock</option> --}}
            </select>
        </div>      
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label>From</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right inline_datepicker_from from" name="from" value="{{ \Carbon\Carbon::parse($data['from'])->format('m/d/Y') }}" autocomplete="off">
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label>To</label><br>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right inline_datepicker_to to" name="to" value="{{ \Carbon\Carbon::parse($data['to'])->format('m/d/Y') }}" autocomplete="off">
          </div>
        </div>
      </div>
      </div>
    </form>

    <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-shopping-bag"></i> Purchase Report
          <small class="pull-right">Dated: {{ \Carbon\Carbon::now()->format('jS M Y - h:i:s A') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Transaction ID</th>
            <th>Date</th>
            <th>Purchase ID</th>
            <th>Supplier</th>
            <th>Grand total</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Due</th>
          </tr>
          </thead>
          <tbody>
            @foreach($transaction as $key => $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('jS M Y') }}</td>
                <td>{{ $value->purchase_id }}</td>
                <td>{{ $value->supplier->supplier_name }}</td>
                <td> <i class="fa fa-inr"></i> {{ $value->subtotal }}</td>
                <td> <i class="fa fa-inr"></i> {{ $value->payment }}</td>
                <td> <i class="fa fa-inr"></i> {{ $value->balance }}</td>
                <td> <i class="fa fa-inr"></i> {{ $value->due }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="/img/credit/visa.png" alt="Visa">
        <img src="/img/credit/mastercard.png" alt="Mastercard">
        <img src="/img/credit/american-express.png" alt="American Express">
        <img src="/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Payments from foreign countries must be payable and immediately negotiable in the United States for the full amount of the fee required.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Report Date :  {{ $data['from']->format('jS M Y') }} - {{ $data['to']->format('jS M Y') }}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Total Purchase:</th>
              <td> <i class="fa fa-inr"></i> {{ $total['purchase'] }}</td>
            </tr>
            <tr>
              <th>Paid Amount:</th>
              <td> <i class="fa fa-inr"></i> {{ $total['payment'] }}</td>
            </tr>
            <tr>
              <th>Balance Amount:</th>
              <td> <i class="fa fa-inr"></i> {{ $total['balance'] }}</td>
            </tr>
            <tr>
              <th>Due Amount:</th>
              <td> <i class="fa fa-inr"></i> {{ $total['due'] }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

     <div class="row">
       <div class="col-xs-12">
         <a href="{{ '/report/pdf_report'.str_replace(Request::url(), '', Request::fullUrl()) }}" class="btn btn-primary pull-right" target="_blank"> <i class="fa fa-file-pdf-o"></i> Generate PDF</a>
       </div>
     </div> 
  </section>

    </section>
    <!-- /.content -->
@endsection
