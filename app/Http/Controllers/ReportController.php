<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Session;
use PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generate()
    {
    	return view('report.generate');
    }

    public function view_report(Request $request)
    {
    	$request['from'] = Carbon::parse($request['from']);
    	$request['to'] = Carbon::parse($request['to']);

    	if($request['report_type'] == 1){

    		$transaction = \App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('supplier')->get();

    		$total['purchase'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('subtotal');

    		$total['payment'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('balance');

    		$total['due'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('due');

    		return view('report.purchase')->with('transaction',$transaction)->with('total',$total)->with('data',$request->all());

    	}elseif($request['report_type'] == 2){

    		$transaction = \App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('customer')->get();

    		$total['purchase'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('subtotal');

    		$total['payment'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('balance');

    		$total['due'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('due');


    		return view('report.sales')->with('transaction',$transaction)->with('total',$total)->with('data',$request->all());

    	}elseif($request['report_type'] == 3){

    		$transaction = \App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('category')->with('supplier')->with('stock')->get();

    		$total['purchase'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('purchase_total');

    		$total['payment'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('closing_balance');

    		$total['due'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('closing_due');

    		return view('report.purchase_stock')->with('transaction',$transaction)->with('total',$total)->with('data',$request->all());
    	}
    }

    public function pdf_report(Request $request)
    {
    	$request['from'] = Carbon::parse($request['from']);
    	$request['to'] = Carbon::parse($request['to']);

    	if($request['report_type'] == 1){

    		$transaction = \App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('supplier')->get();

    		$total['purchase'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('subtotal');

    		$total['payment'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('balance');

    		$total['due'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('due');


    		$pdf = PDF::loadView('report.download_purchase', array('transaction'=>$transaction,'total'=>$total,'data'=>$request));

			return $pdf->stream('PurchaseReport.pdf');


    	}elseif($request['report_type'] == 2){

    		$transaction = \App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('customer')->get();

    		$total['purchase'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('subtotal');

    		$total['payment'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('balance');

    		$total['due'] =\App\Models\Transaction::where('type',$request['report_type'])->where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('due');

    		$pdf = PDF::loadView('report.download_sales', array('transaction'=>$transaction,'total'=>$total,'data'=>$request));

			return $pdf->stream('SalesReport.pdf');


    	}elseif($request['report_type'] == 3){

    		$transaction = \App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->with('supplier')->with('stock')->get();

    		$total['purchase'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('purchase_total');

    		$total['payment'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('payment');

    		$total['balance'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('closing_balance');

    		$total['due'] =\App\Models\PurchaseDetail::where('created_at','>=',$request['from'])->where('created_at','<=',$request['to'])->sum('closing_due');

    		$pdf = PDF::loadView('report.download_purchase_stock', array('transaction'=>$transaction,'total'=>$total,'data'=>$request));

			return $pdf->stream('PurchaseStockReport.pdf');
    	}

    }
}
