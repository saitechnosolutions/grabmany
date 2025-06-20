<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model {
    protected $table = 'product_varient';
    protected $guarded = [];

    public function product() {
        return $this->belongsTo( products::class, 'product_id' );
    }
}