<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPriceLog extends Model
{
    protected $table = 'item_price_log';

    protected $fillable = [
        'item_id',
        'price',
        'price_discount',
        'pivot',
        'condition'
    ];
}
