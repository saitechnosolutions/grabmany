<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table='categories';
    

    public function products()
    {
        return $this->hasMany(products::class, 'category_id');
    }
}
