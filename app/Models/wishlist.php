<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;

    function rel_to_product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    function rel_to_inventories()
    {
        return $this->belongsTo(inventory::class, 'product_id');
    }

}
