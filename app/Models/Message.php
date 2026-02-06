<?php
// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
