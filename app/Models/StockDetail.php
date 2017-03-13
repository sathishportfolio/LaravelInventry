<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockDetail
 */
class StockDetail extends Model
{
    use SoftDeletes;

    protected $table = 'stock_details';

    protected $primaryKey = 'stock_id';

    public $timestamps = true;

    protected $fillable = [
        'stock_name',
        'category_id',
        'category_name',
        'purchase_cost',
        'selling_cost',
        'supplier_id',
        'supplier_name',
        'stock_quatity',
        'uom'
    ];

    public function getSellingCostAttribute($value)
    {
        if($value){
            return (float) $value;    
        }else {
            return '';
        }
        
    }
    

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne('App\Models\CategoryDetail','id','category_id')->select(array('id', 'category_name'));
    } 

    public function supplier()
    {
        return $this->hasOne('App\Models\SupplierDetail','id','supplier_id')->select(array('id', 'supplier_name'));
    } 

    public function stock_unit()
    {
        return $this->hasMany('App\Models\StockUnitsDetail','stock_id','stock_id');
    }    
}