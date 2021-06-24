<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'store_name',
        'store_status',
        'categories_id',
        'address_one',
        'address_two',
        'provinces_id',
        'regencies_id',
        'zip_code',
        'country',
        'phoneNumber',
        'photo_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $rules = [
        'email_address' => 'sometimes|required|email|unique:users',
    ];
}
