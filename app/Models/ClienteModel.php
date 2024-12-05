<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';

    protected $allowedFields = ['id_comercios', 'nombre_comercial', 'razon_social', 'nombre', 'apellidos', 'cif_nif_nie', 'id_provincias', 'id_localidades', 'direccion', 'numero', 'piso', 'escalera', 'cp', 'telefono', 'email', 'id_operadores', 'atendido', 'created_at', 'updated_at'];
    //protected $allowedFields = ['id_clientes', 'nombre_comercial', 'razon_social', 'cif_nif_nie', 'telefono', 'email', 'id_provincias', 'id_operadores'];
    public function add_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getCliente($where)
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
