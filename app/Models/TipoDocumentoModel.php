<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoDocumentoModel extends Model
{
    protected $table      = 'tipodocumento';
    protected $primaryKey = 'idtipodocumento';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idtipodocumento', 'codigosunat', 'nombredocumento','abrrdoc','estado'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getTipoDocumento(){
        $builder= $this->db->table('tipodocumento ');
        $builder->where('estado', 1);
        $result=$builder->get()->getResultArray();
        return $result;
    }

    public function getTipoDocumentoId($id){
        $builder= $this->db->table('tipodocumento ');
        $builder->where('estado', 1);
        $builder->where('idtipodocumento', $id);
        $result=$builder->get()->getResultArray();
        return $result;
    }


}