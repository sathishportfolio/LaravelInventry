<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalesDetail
 */
class SalesDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'sales_details';

    protected $primaryKey = 'sales_id';

	public $timestamps = true;

    protected $fillable = [
        
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_contact1',
        'opening_balance',
        'opening_due',
        'sales_total',
        'discount_percent',
        'discount_amount',
        'tax_description',
        'tax_percent',
        'tax_amount',
        'sales_description',
        'grand_total',
        'payment',
        'closing_balance',
        'closing_due',
        'mode',
        'billnumber',
        'billdate'
    ];

    /*'stock_id',
    'category_id',
    'category_name',
    'purchase_cost',
    'selling_cost',
    'opening_stock',
    'closing_stock',
    'sales_quantity',*/

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function stock()
    {
        return $this->hasOne('App\Models\StockDetail','stock_id','stock_id')->select(array('stock_id', 'stock_name'));
    } 

    public function category()
    {
        return $this->hasOne('App\Models\CategoryDetail','id','category_id')->select(array('id', 'category_name'));
    } 

    public function customer()
    {
        return $this->hasOne('App\Models\CustomerDetail','id','customer_id')->select(array('id', 'customer_name'));
    }

        
}