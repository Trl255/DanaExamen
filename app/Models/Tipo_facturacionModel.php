<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model; 
class Tipo_facturacionModel extends Model
{
    protected $table = 'tipo_facturacion';
     protected $allowedFields = ['tipo_facturacion', 'created_at', 'updated_at' ];
   

	public function add_batch($data) {
		return $this->db->insert_batch($this->table, $data);
	}
    
    public function getTipoFacturacion($where) {
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