<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['search'])){
            if($request['search']!='%%')
            $request['search']='%%';
        }else{
            $request['search']='%'.$request['search'].'%';
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='sales_id')
            $request['sort']='sales_id';
        
        }

        $rows = \App\Models\SalesDetail::where(function($query) use($request){
                      $query->orwhere('sales_id','like',$request['search'])
                      ->orwhere('category_name','like',$request['search'])
                      ->orwhere('customer_name','like',$request['search']);
                  })->with('stock')->with('customer')->with('category')->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\SalesDetail::where(function($query) use($request){
                      $query->orwhere('sales_id','like',$request['search'])
                      ->orwhere('category_name','like',$request['search'])
                      ->orwhere('customer_name','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('sales.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        unset($request['stock_name']);

        $SalesDetail = \App\Models\SalesDetail::create($request->all());

        $StockDetail = \App\Models\StockDetail::where('stock_id',$request['stock_id'])->update(['stock_quantity'=>$request['closing_stock']]);

        $CustomerDetail = \App\Models\CustomerDetail::where('id',$request['customer_id'])
                                  ->update([
                                        'balance'=>$request['closing_balance'],
                                        'due'=>$request['closing_due']
                                    ]);
        
        $transaction_details = [
                                    'type' => 2,
                                    'sales_id'=>$SalesDetail->sales_id,
                                    'customer_id'=>$SalesDetail->customer_id,
                                    'subtotal'=>$SalesDetail->grand_total,

                                    'payment'=>$SalesDetail->payment,
                                    'balance'=>$SalesDetail->closing_balance,
                                    'due'=>$SalesDetail->closing_due,
                                    'mode'=>$SalesDetail->mode,
                                ];                                  

        \App\Models\Transaction::create($transaction_details);                                      

            $messageType = 1;
            $message = "Sales created successfully !";
        try {
            
            

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Sales creation failed !";            
        }

        return redirect(url("/sales/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales_details = \App\Models\SalesDetail::find($id);

        $category_details = \App\Models\CategoryDetail::pluck('category_name','id');

        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name','id');

        return view('sales.edit')->with('sales_details',$sales_details)->with('category_details',$category_details)->with('supplier_details',$supplier_details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $sales = \App\Models\SalesDetail::find($id);

            $sales->update($request->all());

            $messageType = 1;
            $message = "Sales ".$sales->sales_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Sales updation failed !";
        }

        return redirect(url("/sales/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $sales = \App\Models\SalesDetail::find($id);

            $sales->delete();    

            $messageType = 1;
            $message = "Sales ".$sales->sales_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Sales deletion failed !";
        }
        
        return redirect(url("/sales/view"))->with('messageType',$messageType)->with('message',$message);
    } 
}