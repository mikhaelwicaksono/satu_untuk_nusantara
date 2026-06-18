<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = ['store_id', 'qr_image', 'instagram_link', 'facebook_link'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
