<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'products_id',
        'post',
    ];

    protected $hidden = [];

    public function user() {
        return $this->hasOne(User::class, 'id' ,'users_id');
    }

    public function product() {
        return $this->hasOne(User::class, 'id' ,'products_id');
    }
}
