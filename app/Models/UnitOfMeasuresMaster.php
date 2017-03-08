<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UnitOfMeasuresMaster
 */
class UnitOfMeasuresMaster extends Model
{
    protected $table = 'unit_of_measures_master';

    protected $primaryKey = 'uom_id';

	public $timestamps = true;

    protected $fillable = [
        'name',
        'symbol',
        'measure_id',
        'status'
    ];

    protected $guarded = [];

        
}