<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class AgencyModel extends Model
{
    protected $table = 'agencies';
    protected $allowedFields = ['name', 'email'];



    public function add_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getAgencia($where)
    {
        return $this->db
            ->table($this->table)
            ->where($where)
            ->get()
            ->getRow();
    }
    public function bulkInsert($data)
    {
        return $this->db
            ->table($this->table)
            ->insertBatch($data);
    }
}
