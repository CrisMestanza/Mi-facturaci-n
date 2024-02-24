<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'departamentos';
    protected $primaryKey = 'iddepartamento';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['iddepartamento', 'nombredepartamento'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getProductos(){
        return $this->db->table('productos p')
        ->join('unidades u','u.id = p.unidad_id')
        ->join('categorias c','c.id = p.categoria_id')
        ->where('p.fecha_delete',NULL)
        ->where('u.activo',1)
        ->where('c.estado',1)
        ->get()->getResultArray();
    }
}