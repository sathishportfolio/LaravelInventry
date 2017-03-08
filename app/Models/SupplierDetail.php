<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SupplierDetail
 */
class SupplierDetail extends Model
{
    protected $table = 'supplier_details';

    public $timestamps = true;

    protected $fillable = [
        'supplier_name',
        'supplier_email',
        'supplier_address',
        'supplier_contact1',
        'supplier_contact2',
        'balance',
        'due'
    ];

    protected $guarded = [];

        
}