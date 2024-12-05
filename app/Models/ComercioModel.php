<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class ComercioModel extends Model
{
    protected $table = 'comercios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_comercial', 'razon_social', 'cif_nif_nie', 'telefono', 'email', 'persona_contacto', 'file_logo', 'id_tipo_facturacion', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function listaComercios()
    {
        $comercios = $this
            ->join('tipo_facturacion', 'comercios.id_tipo_facturacion=tipo_facturacion.id')
            ->select('comercios.id,comercios.nombre_comercial, comercios.razon_social, comercios.cif_nif_nie, comercios.telefono, comercios.email, comercios.persona_contacto, comercios.file_logo, comercios.id_tipo_facturacion,tipo_facturacion.tipo_facturacion')
            ->findAll();
        return $comercios;
    }

    public function listaComerciosBuilder()
    {
        $builder = $this->db->table('comercios');
        $builder->select('comercios.id,comercios.nombre_comercial, comercios.razon_social, comercios.cif_nif_nie, comercios.telefono, comercios.email, comercios.persona_contacto, comercios.file_logo, comercios.id_tipo_facturacion,tipo_facturacion.tipo_facturacion');
        $builder->join('tipo_facturacion', 'comercios.id_tipo_facturacion=tipo_facturacion.id');
        $query = $builder->get();
        return $query;
    }

    public function listaComerciosBuilderQuery()
    {
        $query = $this->query("SELECT comercios.id,comercios.nombre_comercial, comercios.razon_social, comercios.cif_nif_nie, comercios.telefono, comercios.email, comercios.persona_contacto, comercios.file_logo, comercios.id_tipo_facturacion,tipo_facturacion.tipo_facturacion FROM comercios INNER JOIN tipo_facturacion ON comercios.id_tipo_facturacion=tipo_facturacion.id");
        return $query;
    }




    public function add_batch($data)
    {
        return $this->db->insert_batch($this->table, $data);
    }

    public function getComercio($where)
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
