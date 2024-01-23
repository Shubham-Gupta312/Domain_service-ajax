<?php

namespace App\Models;

use CodeIgniter\Model;

class DomainInfoModel extends Model
{
    // ...
    protected $table = 'domain_detail';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getDataBetweenDays($startDate, $endDate)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        // $builder->where("created_at BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'");
        $builder->where("domain_expiry BETWEEN '$startDate 00:00:00' AND '$endDate 23:59:59'");
        $query = $builder->get();

        return $query->getResultArray();
    }
}

