<?php

namespace App\Models;

use App\Models\AuthBaseModel;

class Admin extends AuthBaseModel
{
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',

        'image',
        'phone',
        'address',
        'status',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer',
        'image' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'status' => 'integer',
        'gender' => 'integer',
    ];
}
