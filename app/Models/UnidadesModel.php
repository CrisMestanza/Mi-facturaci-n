<?php

namespace App\Models;

use CodeIgniter\Model;

class UnidadesModel extends Model
{
    protected $table      = 'unidades';
    protected $primaryKey = 'idunidad';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['idunidad', 'codigounidad	', 'abrunidad','estado'];

    public function getUnidades(){
        $db      = \Config\Database::connect();
        $builder = $db->table('unidades');
        $query = $builder->get()->getResultArray();
        return $query;

    }

    public function activar($id){
        $data=
        [
            'idunidad' => $id,
            'estado' => 1
        ];
        $builder = $this->db->table('unidades');
        $builder->set($data);
        $builder->where('idunidad', $data['idunidad']);
        $builder->update();
        
    }

    public function desactivar($id){
        $data=
        [
            'idunidad' => $id,
            'estado' => 0
        ];
        $builder = $this->db->table('unidades');
        $builder->set($data);
        $builder->where('idunidad', $data['idunidad']);
        $builder->update();
        
    }

    public function getUnidadesVentas(){
        $db      = \Config\Database::connect();
        $builder = $db->table('unidades');
        $builder->where('estado', 1);
        $query = $builder->get()->getResultArray();
        return $query;

    }

}