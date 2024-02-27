<?php

namespace App\Models;

use CodeIgniter\Model;

class DistritoModel extends Model
{
    protected $table      = 'distritos';
    protected $primaryKey = 'iddistrito';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['iddistrito', 'nombredistrito','idprovincia','ubigeo','checked'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getDistrito($id){
        return $this->db->table('distritos')
        ->where('idprovincia',$id)
        ->get()->getResultArray();
    }

    public function getUbigueo($id){
        return $this->db->table('distritos')
        ->where('iddistrito',$id)
        ->get()->getResultArray();
    }


    public function Distrito($id){ //Para la variable session
        return $this->db->table('distritos')
        ->where('iddistrito',$id)
        ->get()->getResultArray();
    }
}