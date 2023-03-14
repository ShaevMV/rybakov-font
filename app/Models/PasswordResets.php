<?php

namespace App\Models;


class PasswordResets extends Model
{
    const TABLE = 'password_resets';
    const UPDATED_AT = null;
    protected $fillable = ['token', 'email','created_at'];
}
