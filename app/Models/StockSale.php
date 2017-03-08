<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StockSale
 */
class StockSale extends Model
{
    protected $table = 'stock_sales';

    public $timestamps = false;

    protected $fillable = [
        'transactionid',
        'transidnumber',
        'stock_name',
        'category',
        'supplier_name',
        'selling_price',
        'quantity',
        'amount',
        'date',
        'username',
        'customer_id',
        'subtotal',
        'payment',
        'balance',
        'discount',
        'tax',
        'tax_dis',
        'dis_amount',
        'grand_total',
        'due',
        'mode',
        'description',
        'count1',
        'billnumber'
    ];

    protected $guarded = [];

        
}