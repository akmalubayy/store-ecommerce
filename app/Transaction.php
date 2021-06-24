<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'insurance_price',
        'shipping_price',
        'total_price',
        'transaction_status',
        'code',
    ];

    protected $dates = ['created_at'];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
