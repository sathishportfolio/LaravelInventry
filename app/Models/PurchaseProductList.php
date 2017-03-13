<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProductList extends Model
{
    use SoftDeletes;
    
    protected $table = 'purchase_product_list';

    protected $primaryKey = 'purchase_product_id';

	public $timestamps = true;

    protected $fillable = [
        
        'purchase_id',
        'stock_id',
	    'category_id',
	    'category_name',
	    'purchase_cost',
	    'selling_cost',
	    'opening_stock',
	    'closing_stock',
	    'sales_quantity',
        'sub_total'

    ];


    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function purchase()
    {
        return $this->belongsTo('App\Models\PurchaseDetail','purchase_id','purchase_id');
    } 


        
}
