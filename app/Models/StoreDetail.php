<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StoreDetail
 */
class StoreDetail extends Model
{
    protected $table = 'store_details';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'log',
        'type',
        'address',
        'place',
        'city',
        'phone',
        'email',
        'web',
        'pin'
    ];

    protected $guarded = [];

        
}