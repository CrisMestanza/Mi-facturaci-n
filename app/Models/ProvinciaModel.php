<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinciaModel extends Model
{
    protected $table      = 'provincias';
    protected $primaryKey = 'idprovincia';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idprovincia', 'nombreprovincia','iddepartamento'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getProvincia($id){
        return $this->db->table('provincias')
        ->where('iddepartamento',$id)
        ->get()->getResultArray();
    }
}

