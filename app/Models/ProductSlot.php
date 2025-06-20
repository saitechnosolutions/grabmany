<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSlot extends Model {
    protected $table = 'product_slots';
    protected $guarded = [];

    public function Varient() {
        return $this->belongsTo( products::class, 'product_varient_id' );
    }
}