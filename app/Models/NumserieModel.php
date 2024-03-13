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
//Para el crud de serie
    public function getNumseries(){
        $builder= $this->db->table('numserie n')
        ->select('n.idnumserie,n.numserie,tp.nombredocumento,n.idtipodocumento')
        ->join('tipodocumento tp','n.idtipodocumento = tp.idtipodocumento')
        ->where('n.estado', 1);
        $result=$builder->get()->getResultArray();
        return $result;
    }
    public function agregarNumSerie($data){
        $builder= $this->db->table('numserie');
        $builder->insert($data);
    }
    public function editarNumSerie($data) {
        $builder = $this->db->table('numserie');
        $builder->where('idnumserie', $data['idnumserie']);
        $builder->update($data);
    }
    
    public function eliminarNumSerie($id) {
        $builder = $this->db->table('numserie');
        $builder->where('idnumserie', $id);
        $builder->update(['estado' => 0]);
    }
    
//Fin del curd de serie
    public function buscarTipoDocumento($tipo){
        $builder= $this->db->table('numserie');
        $builder->where('idtipodocumento', $tipo);
        $result=$builder->get()->getResultArray();
        return $result;
    }

    public function buscarNumSerie($tipo){
        $builder= $this->db->table('numserie');
        $builder->where('idnumserie', $tipo);
        $result=$builder->get()->getResultArray();
        return $result;
    }



}