<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
    protected $table      = 'categoria';
    protected $primaryKey = 'idcategoria';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['idcategoria', 'nomcategoria', 'estado'];

    // Dates
    public function gerCategoria(){
        $db      = \Config\Database::connect();
        $builder = $db->table('categoria');
        $builder-> where('estado',1);
        $query = $builder->get()->getResultArray();
        return $query;
    }

   
    public function editar($data){
        $builder = $this->db->table('categoria');
        $builder->set($data);
        $builder->where('idcategoria', $data['idcategoria']);
        $builder->update();
    }
        
    public function eliminar($id){
        $data=[
            'idcategoria'=>$id,
            'estado'=>0
        ];
        $builder = $this->db->table('categoria');
        $builder->set($data);
        $builder->where('idcategoria', $data['idcategoria']);
        $builder->update();
        
    }

}