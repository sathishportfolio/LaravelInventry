<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesProductList extends Model
{
    use SoftDeletes;
    
    protected $table = 'sales_product_list';

    protected $primaryKey = 'sales_product_id';

	public $timestamps = true;

    protected $fillable = [
        
        'sales_id',
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

    public function sales()
    {
        return $this->belongsTo('App\Models\SalesDetail','sales_id','sales_id');
    } 


        
}
