<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['total_products'] = \App\Models\StockDetail::count();
        $data['sales_transactions'] = \App\Models\SalesDetail::count();
        $data['suppliers'] = \App\Models\SupplierDetail::count();
        $data['customers'] = \App\Models\CustomerDetail::count();

        return view('home')->with('data',$data);
    }
}
