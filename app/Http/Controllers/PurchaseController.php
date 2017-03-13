<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
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
            if($request['sort']!='purchase_id')
            $request['sort']='purchase_id';
        
        }

        $rows = \App\Models\PurchaseDetail::where(function($query) use($request){
                      $query->orwhere('purchase_id','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search']);
                  })->with('stock')->with('supplier')->with('category')->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\PurchaseDetail::where(function($query) use($request){
                      $query->orwhere('purchase_id','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('purchase.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $purchase_product = array();

        unset($request['category_name'],$request['category_id'],$request['stock_id'],$request['purchase_cost'],$request['selling_cost'],$request['opening_stock'],$request['closing_stock'],$request['purchase_quantity'],$request['sub_total']);

        $PurchaseDetail = \App\Models\PurchaseDetail::create($request->all());

        foreach ($data['stock_id'] as $key => $value) {
            
            $purchase_product[$key]['purchase_id'] = $PurchaseDetail->purchase_id;
            $purchase_product[$key]['stock_id'] = $value;
            $purchase_product[$key]['category_name'] = $data['category_name'][$key];
            $purchase_product[$key]['category_id'] = $data['category_id'][$key];
            $purchase_product[$key]['purchase_cost'] = $data['purchase_cost'][$key];
            $purchase_product[$key]['opening_stock'] = $data['opening_stock'][$key];
            $purchase_product[$key]['closing_stock'] = $data['closing_stock'][$key];
            $purchase_product[$key]['purchase_quantity'] = $data['purchase_quantity'][$key];
            $purchase_product[$key]['sub_total'] = $data['sub_total'][$key];
        }

        $SalesProduct = \App\Models\PurchaseProductList::insert($purchase_product);

        foreach ($purchase_product as $key => $value) {
         
         \App\Models\StockDetail::where('stock_id',$value['stock_id'])->update(['stock_quantity'=>$value['closing_stock']]);   
        }

        $SupplierDetail =  \App\Models\SupplierDetail::where('id',$request['supplier_id'])
                                    ->update([
                                        'balance'=>$request['closing_balance'],
                                        'due'=>$request['closing_due']
                                    ]);

        $transaction_details = [
                                    'type' => 1,
                                    'purchase_id'=>$PurchaseDetail->purchase_id,
                                    'supplier_id'=>$PurchaseDetail->supplier_id,
                                    'subtotal'=>$PurchaseDetail->grand_total,

                                    'payment'=>$PurchaseDetail->payment,
                                    'balance'=>$PurchaseDetail->closing_balance,
                                    'due'=>$PurchaseDetail->closing_due,
                                    'mode'=>$PurchaseDetail->mode,
                                ];                               

        \App\Models\Transaction::create($transaction_details);                                     

            $messageType = 1;
            $message = "Purchase created successfully !";
        try {
            
            

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Purchase creation failed !";            
        }

        return redirect(url("/purchase/view"))->with('messageType',$messageType)->with('message',$message);
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
        $purchase_details = \App\Models\PurchaseDetail::find($id);

        $category_details = \App\Models\CategoryDetail::pluck('category_name','id');

        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name','id');

        return view('purchase.edit')->with('purchase_details',$purchase_details)->with('category_details',$category_details)->with('supplier_details',$supplier_details);
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

            $purchase = \App\Models\PurchaseDetail::find($id);

            $purchase->update($request->all());

            $messageType = 1;
            $message = "Purchase ".$purchase->purchase_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Purchase updation failed !";
        }

        return redirect(url("/purchase/view"))->with('messageType',$messageType)->with('message',$message);
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
            
            $purchase = \App\Models\PurchaseDetail::find($id);

            $purchase->delete();    

            $messageType = 1;
            $message = "Purchase ".$purchase->purchase_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Purchase deletion failed !";
        }
        
        return redirect(url("/purchase/view"))->with('messageType',$messageType)->with('message',$message);
    } 
}