<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordered_product extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'product_qty', 'product_amount', 'order_id'];
}
