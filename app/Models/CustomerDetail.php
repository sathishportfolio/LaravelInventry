<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CustomerDetail
 */
class CustomerDetail extends Model
{
    use SoftDeletes;

    protected $table = 'customer_details';

    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_contact1',
        'customer_contact2',
        'balance',
        'due'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

        
}