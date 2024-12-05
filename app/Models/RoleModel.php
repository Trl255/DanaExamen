<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model; 
class RoleModel extends Model
{
    protected $table = 'roles';
    protected $allowedFields = ['role'];
    
    
   

	public function add_batch($data) {
		return $this->db->insert_batch($this->table, $data);
	}
    
    public function getRole($where) {
        return $this->db
                        ->table($this->table)
                        ->where($where)
                        ->get()
                        ->getRow();
    }
     public function bulkInsert($data) {
        return $this->db
                        ->table($this->table)
                        ->insertBatch($data);
    }
}