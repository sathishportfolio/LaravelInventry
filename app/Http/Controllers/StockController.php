<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
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
            if($request['sort']!='stock_id')
            $request['sort']='stock_id';
        
        }

        $rows = \App\Models\StockDetail::where(function($query) use($request){
                      
                      $query->orwhere('stock_id','like',$request['search'])
                      ->orwhere('stock_name','like',$request['search'])
                      ->orwhere('category_id','like',$request['search'])
                      ->orwhere('purchase_cost','like',$request['search'])
                      ->orwhere('selling_cost','like',$request['search'])
                      ->orwhere('category_name','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search']);

                  })->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\StockDetail::where(function($query) use($request){

                      $query->orwhere('stock_id','like',$request['search'])
                      ->orwhere('stock_name','like',$request['search'])
                      ->orwhere('category_id','like',$request['search'])
                      ->orwhere('purchase_cost','like',$request['search'])
                      ->orwhere('selling_cost','like',$request['search'])
                      ->orwhere('category_name','like',$request['search'])
                      ->orwhere('supplier_name','like',$request['search']);

                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('stock.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_details = \App\Models\CategoryDetail::pluck('category_name','id');

        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name','id');

        return view('stock.create')->with('category_details',$category_details)->with('supplier_details',$supplier_details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $measure_id = $request['measure_id'];
      $uom_id = $request['uom_id'];
      $stock_value = $request['value'];

      $symbol = \App\Models\UnitOfMeasuresMaster::whereIn('uom_id',$uom_id)->pluck('symbol');

      foreach ($request['value'] as $rkey => $rval) {
        
        if(isset($request['stock_name'])){
          $request['stock_name'] = $request['stock_name'].' x '.$rval.$symbol[$rkey];  
        }else{
          $request['stock_name'] = $rval.$symbol[$rkey];  
        }

      }

      $stock_units = array();

      unset($request['measure_id'],$request['uom_id'],$request['value']);

        try {
            
            
            $stock = \App\Models\StockDetail::create($request->all());

            // \App\Models\StockAvail::create(['stock_id'=>$stock->stock_id,'stock_name'=>$stock->stock_name]);

            foreach ($measure_id as $key => $value) {

              $stock_units[$key]['stock_id'] = $stock->stock_id;
              $stock_units[$key]['category_id'] = $stock->category_id;
              $stock_units[$key]['measure_id'] = $value;
              $stock_units[$key]['uom_id'] = $uom_id[$key];
              $stock_units[$key]['value'] = $stock_value[$key];
              $stock_units[$key]['created_at'] = \Carbon\Carbon::now();

            }

            $stock_units_detail = \App\Models\StockUnitsDetail::insert($stock_units);

            $messageType = 1;
            $message = "Stock created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Stock creation failed !";            
        }

        return redirect(url("/stock/view"))->with('messageType',$messageType)->with('message',$message);
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
        $stock_details = \App\Models\StockDetail::where('stock_id',$id)->with('category')->with('stock_unit.measures')->with('stock_unit.uom')->get();

        // dd($stock_details[0]->toarray());

        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name','id');

        return view('stock.edit')->with('stock_details',$stock_details[0])->with('supplier_details',$supplier_details);
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

        $measure_id = $request['measure_id'];
        $uom_id = $request['uom_id'];
        $stock_value = $request['value'];

        $symbol = \App\Models\UnitOfMeasuresMaster::whereIn('uom_id',$uom_id)->pluck('symbol');

        foreach ($request['value'] as $rkey => $rval) {
          
          if(isset($request['stock_name'])){
            $request['stock_name'] = $request['stock_name'].' x '.$rval.$symbol[$rkey];  
          }else{
            $request['stock_name'] = $rval.$symbol[$rkey];  
          }

        }

        $stock_units = array();

        unset($request['measure_id'],$request['uom_id'],$request['value'],$request['_token']);

        try {

            $stock = \App\Models\StockDetail::find($id);

            $stock->update($request->all());

            // dd($stock->toarray());

            foreach ($measure_id as $key => $value) {

              $stock_units[$key]['stock_id'] = $stock->stock_id;
              $stock_units[$key]['category_id'] = $stock->category_id;
              $stock_units[$key]['measure_id'] = $value;
              $stock_units[$key]['uom_id'] = $uom_id[$key];
              $stock_units[$key]['value'] = $stock_value[$key];
              $stock_units[$key]['created_at'] = \Carbon\Carbon::now();

            }

            \App\Models\StockUnitsDetail::where('stock_id',$id)->delete();

            \App\Models\StockUnitsDetail::insert($stock_units);

            $messageType = 1;
            $message = "Stock ".$stock->stock_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Stock updation failed !";
        }

        return redirect(url("/stock/view"))->with('messageType',$messageType)->with('message',$message);
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
            
            $stock = \App\Models\StockDetail::find($id);

            $stock->delete();    

            $messageType = 1;
            $message = "Stock ".$stock->stock_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Stock deletion failed !";
        }
        
        return redirect(url("/stock/view"))->with('messageType',$messageType)->with('message',$message);
    }

    public function view_availability()
    {   
        return view('stock.available');
    }

    public function get_stock_count()
    {   

        $stock = \App\Models\StockDetail::get();

        $backgroundColor = ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(255, 159, 64, 0.2)'];

        $borderColor = ['rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)'];

        foreach ($stock as $skey => $svalue) {
          
          $data['labels'][] = $svalue->stock_name;

          $data['stock'][] = $svalue->stock_quantity;

          $data['backgroundColor'][] = $backgroundColor[($skey+1) % 6];
          
          $data['borderColor'][] = $borderColor[($skey+1) % 6];

          
        }

        return $data;
    }

    public function get_availability(Request $request)
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
            if($request['sort']!='stock_id')
            $request['sort']='stock_id';
        
        }

        // dd($request->all());

        $rows = \App\Models\StockDetail::with('category')->where(function($query) use($request){
                      $query->orwhere('stock_id','like',$request['search'])
                      ->orwhere('stock_name','like',$request['search'])
                      ->orwhere('stock_quantity','like',$request['search']);
                  })->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get(['stock_id','stock_name','stock_quantity','category_id','purchase_cost','selling_cost']);

                    // dd($rows->toarray());

        $total = \App\Models\StockDetail::where(function($query) use($request){
                      $query->orwhere('stock_id','like',$request['search'])
                      ->orwhere('stock_name','like',$request['search'])
                      ->orwhere('stock_quantity','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }
}
