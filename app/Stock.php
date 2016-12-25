<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $guarded = ['id'];


    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}