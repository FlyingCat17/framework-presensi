<?php

namespace App\Models;

use Riyu\Database\Utils\Model;

class User extends Model
{
    protected $table = 'admin';
    protected $timestamp = true;
    protected $primaryKey = 'id';
    protected $prefix = 'tb_';
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'image',
        'email',
    ];
}
