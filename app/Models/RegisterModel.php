<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    // ...
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $protectFields = [];
}