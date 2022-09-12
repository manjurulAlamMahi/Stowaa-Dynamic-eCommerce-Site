<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    use HasFactory;

    function rel_to_product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    function rel_to_customer()
    {
        return $this->belongsTo(customerUser::class, 'customer_id');
    }
}
