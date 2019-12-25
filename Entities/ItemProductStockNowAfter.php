<?php

namespace Modules\ProductStockNowAfter\Entities;

use Illuminate\Database\Eloquent\Model;

class ItemProductStockNowAfter extends Model
{
    protected $fillable = [];

    protected $dates = [
        'date_delivery_now',
        'date_delivery_after'
    ];
}
