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


    // protected static function boot()
    // {
    //     parent::boot();

    //     // Automatically assign a UUID to the 'id' attribute
    //     static::creating(function ($model) {
    //         if (empty($model->{$model->getKeyName()})) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
