<?php

namespace App\Models;

use CodeIgniter\Model;

class DomainInfoModel extends Model
{
    // ...
    protected $table = 'domain_detail';
    protected $primaryKey = 'id';
    protected $protectFields = [];
}