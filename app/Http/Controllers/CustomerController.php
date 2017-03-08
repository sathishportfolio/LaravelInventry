<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
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
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\CustomerDetail::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('customer_name','like',$request['search'])
                      ->orwhere('customer_email','like',$request['search'])
                      ->orwhere('customer_address','like',$request['search'])
                      ->orwhere('customer_contact1','like',$request['search'])
                      ->orwhere('customer_contact2','like',$request['search'])
                      ->orwhere('balance','like',$request['search']);
                  })->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\CustomerDetail::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('customer_name','like',$request['search'])
                      ->orwhere('customer_email','like',$request['search'])
                      ->orwhere('customer_address','like',$request['search'])
                      ->orwhere('customer_contact1','like',$request['search'])
                      ->orwhere('customer_contact2','like',$request['search'])
                      ->orwhere('balance','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('customer.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            \App\Models\CustomerDetail::create($request->all());

            $messageType = 1;
            $message = "Customer created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Customer creation failed !";            
        }

        return redirect(url("/customer/view"))->with('messageType',$messageType)->with('message',$message);
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
        $customer = \App\Models\CustomerDetail::find($id);

        return view('customer.edit')->with('customer',$customer);
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

            $customer = \App\Models\CustomerDetail::find($id);

            $customer->update($request->all());

            $messageType = 1;
            $message = "Customer ".$customer->customer_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Customer updation failed !";
        }

        return redirect(url("/customer/view"))->with('messageType',$messageType)->with('message',$message);
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
            
            $customer = \App\Models\CustomerDetail::find($id);

            $customer->delete();    

            $messageType = 1;
            $message = "Customer ".$customer->customer_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Customer deletion failed !";
        }
        
        return redirect(url("/customer/view"))->with('messageType',$messageType)->with('message',$message);
    }
}
