<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'price',
        'credits',
        'session_id',
        'user_id',
        'package_id'
    ];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
