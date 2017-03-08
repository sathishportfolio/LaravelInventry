<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
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

        // $result = \App\Models\CategoryDetail::with('units.measures')->with('units.uom')->get();
        // dd($result->toarray());

        $rows = \App\Models\CategoryDetail::with('units.measures')
                ->with('units.uom')
                ->where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('category_name','like',$request['search']);
                  })->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\CategoryDetail::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('category_name','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('category.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $details = \App\Models\MeasuresMaster::with('unit')->get();

        return view('category.create')->with('details',$details);
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
            
            $category =\App\Models\CategoryDetail::create( ['category_name' => $request['category_name']] );

            foreach ($request['measure_id'] as $key => $value) {
                $data[$key]['category_id'] = $category->id;
                $data[$key]['measure_id'] = $value;
                $data[$key]['uom_id'] = $request['uom_id_'.$value];
                $data[$key]['created_at'] = \Carbon\Carbon::now();

            }

            \App\Models\CategoryUnitsMaster::insert($data);

            $messageType = 1;
            $message = "Category created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Category creation failed !";            
        }

        return redirect(url("/category/view"))->with('messageType',$messageType)->with('message',$message);
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
        $category = \App\Models\CategoryDetail::where('id',$id)->with('units')->get();

        $measure_id = \App\Models\CategoryUnitsMaster::where('category_id',$id)->pluck('measure_id')->toarray();
        
        $uom_id = \App\Models\CategoryUnitsMaster::where('category_id',$id)->pluck('uom_id')->toarray();

        $details = \App\Models\MeasuresMaster::with('unit')->get();

        return view('category.edit')->with('category',$category)->with('details',$details)->with('measures_array',$measure_id)->with('uom_array',$uom_id);
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

            $category = \App\Models\CategoryDetail::find($id);

            $category->update(['category_name' => $request['category_name']]);

            foreach ($request['measure_id'] as $key => $value) {
                $data[$key]['category_id'] = $category->id;
                $data[$key]['measure_id'] = $value;
                $data[$key]['uom_id'] = $request['uom_id_'.$value];
                $data[$key]['created_at'] = \Carbon\Carbon::now();

            }

            \App\Models\CategoryUnitsMaster::where('category_id',$id)->delete();

            \App\Models\CategoryUnitsMaster::insert($data);

            $messageType = 1;
            $message = "Category ".$category->category_name." details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Category updation failed !";
        }

        return redirect(url("/category/view"))->with('messageType',$messageType)->with('message',$message);
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
            
            $category = \App\Models\CategoryDetail::find($id);

            $category->delete();    

            \App\Models\CategoryUnitsMaster::where('category_id',$id)->delete();

            $messageType = 1;
            $message = "Category ".$category->category_name." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Category deletion failed !";
        }
        
        return redirect(url("/category/view"))->with('messageType',$messageType)->with('message',$message);
    }
}