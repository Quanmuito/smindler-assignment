<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['first_name', 'last_name', 'address'];

    public function basket(): HasMany
    {
        return $this->hasMany(Basket::class);
    }
}
