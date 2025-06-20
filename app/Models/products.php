<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table='products';
    protected $guarded = [];
    
    public function products()
    {
        return $this->hasMany(products::class, 'category_id');
    }
}