<?php

namespace App\Models;

use CodeIgniter\Model;

class NumserieModel extends Model
{
    protected $table      = 'numserie';
    protected $primaryKey = 'idnumserie';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idnumserie', 'idtipodocumento', 'numserie','estado'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getNumseries(){
        $builder= $this->db->table('numserie ');
        $builder->where('estado', 1);
        $result=$builder->get()->getResultArray();
        return $result;
    }

}