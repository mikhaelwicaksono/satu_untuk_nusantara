<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['user_id', 'name', 'category', 'description', 'address', 'city', 'phone', 'instagram', 'logo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function qrCode()
    {
        return $this->hasOne(QrCode::class);
    }
}
