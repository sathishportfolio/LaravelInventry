<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StockUser
 */
class StockUser extends Model
{
    protected $table = 'stock_user';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'user_type',
        'answer'
    ];

    protected $guarded = [];

        
}