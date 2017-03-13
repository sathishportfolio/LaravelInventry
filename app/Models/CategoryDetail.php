<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryDetail
 */
class CategoryDetail extends Model
{
    protected $table = 'category_details';

    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    
    protected $guarded = [];

    public function units(){

    	return $this->hasmany('App\Models\CategoryUnitsMaster','category_id','id')->select('category_id','measure_id','uom_id');
    } 

    public function stocks(){

    	return $this->hasmany('App\Models\StockDetail','category_id','id');
    }    
}