<?php
// app/Models/Photo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['photo_path'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
