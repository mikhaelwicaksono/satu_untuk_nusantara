<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['store_id', 'title', 'code', 'banner', 'promo_link', 'expires_at', 'status'];

    protected $casts = ['expires_at' => 'date'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
