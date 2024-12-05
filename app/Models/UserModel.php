<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['act_user', 'firstname', 'lastname', 'email', 'password', 'id_roles', 'created_at', 'updated_at'];
    public function add_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getUser($where)
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
