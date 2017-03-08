<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryUnitsMaster
 */
class CategoryUnitsMaster extends Model
{
    protected $table = 'category_units_masters';

    protected $primaryKey = 'cu_id';

	public $timestamps = true;

    protected $fillable = [
        'category_id',
        'measure_id',
        'uom_id',
        'status'
    ];

    protected $guarded = [];

    public function measures(){

        return $this->hasone('App\Models\MeasuresMaster','measure_id','measure_id');
    } 

    public function uom(){

        return $this->hasone('App\Models\UnitOfMeasuresMaster','uom_id','uom_id')->select('uom_id','name','symbol');
    } 

        
}