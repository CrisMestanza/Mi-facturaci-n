<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartamentosModel extends Model
{
    protected $table      = 'departamentos';
    protected $primaryKey = 'iddepartamento';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['iddepartamentos', 'nombredepartamento'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getDepartamentos(){
        return $this->db->table('departamentos')
        ->get()->getResultArray();
    }
}