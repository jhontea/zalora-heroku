<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'url',
        'sku',
        'title',
        'brand',
        'price',
        'price_discount',
        'image_link',
        'discount',
        'is_active',
        'category',
        'segment'
    ];
}
