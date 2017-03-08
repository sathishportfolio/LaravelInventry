<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 */
class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'sales_id',
        'purchase_id',
        'customer_id',
        'supplier_id',
        'subtotal',
        'payment',
        'balance',
        'due',
        'mode'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function supplier()
    {
        return $this->hasOne('App\Models\SupplierDetail','id','supplier_id')->select(array('id', 'supplier_name'));
    }  

    public function customer()
    {
        return $this->hasOne('App\Models\CustomerDetail','id','customer_id')->select(array('id', 'customer_name'));
    }
        
}