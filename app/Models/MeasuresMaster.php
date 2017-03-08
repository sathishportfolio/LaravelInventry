<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MeasuresMaster
 */
class MeasuresMaster extends Model
{
    protected $table = 'measures_master';

    protected $primaryKey = 'measure_id';

	public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

    public function unit(){
    	return $this->hasmany('App\Models\UnitOfMeasuresMaster','measure_id','measure_id');
    }

        
}