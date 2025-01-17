<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Basket extends Model
{
    protected $fillable = ['name', 'type', 'price'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
