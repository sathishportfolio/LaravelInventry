<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockEntry
 */
class PurchaseDetail extends Model
{

    use SoftDeletes;
    
    protected $table = 'purchase_details';

    public $timestamps = true;

    protected $primaryKey = 'purchase_id';

    protected $fillable = [

        'stock_id',
        'category_id',
        'category_name',
        'supplier_id',
        'supplier_name',
        'supplier_address',
        'supplier_contact1',
        'opening_balance',
        'opening_due',
        'purchase_quantity',
        'purchase_total',
        'purchase_cost',
        'selling_cost',
        'opening_stock',
        'closing_stock',
        'description',
        'grand_total',
        'payment',
        'closing_balance',
        'closing_due',
        'mode',
        'billnumber',
        'billdate'

    ];

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

    public function supplier()
    {
        return $this->hasOne('App\Models\SupplierDetail','id','supplier_id')->select(array('id', 'supplier_name'));
    }

        
}