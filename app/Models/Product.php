<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['store_id', 'name', 'category', 'price', 'description', 'photo', 'social_link'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
