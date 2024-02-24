<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table      = 'empresa';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['ruc', 'razonsocial', 'ubigeo','departamento','provincia','distrito','direccion','numserieactualf','numserieactualb'];

    public function setEmpresa(){
        $query = $this->db->table('empresa');
        $result = $query->get()->getResultArray();
        return $result;
    }

    public function editar($data){
        
        $builder= $this->db->table('empresa');
        
        $builder->update($data);

        $result= $builder->get()->getResultArray();

        return $result;
    }

    public function activar($activar){
        $builder = $this->db->table('empresa');
        $builder->set('mododev', $activar);
        $builder->where('idempresa', 1);
        $builder->update();
        
    }

    public function desactivar($desactivar){
        $builder = $this->db->table('empresa');
        $builder->set('mododev', $desactivar);
        $builder->where('idempresa', 1);
        $builder->update();
        
    }
}