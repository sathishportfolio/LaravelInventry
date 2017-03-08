<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StockUnitsDetail
 */
class StockUnitsDetail extends Model
{
    protected $table = 'stock_units_details';

    protected $primaryKey = 'sud_id';

	public $timestamps = true;

    protected $fillable = [
        'stock_id',
        'category_id',
        'measure_id',
        'uom_id',
        'value',
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