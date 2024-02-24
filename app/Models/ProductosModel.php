<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'idproducto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idproducto', 'idcategoria', 'nomproducto','descripcion','preciounitario','stockinicial','stockactual','imagenprod','estado'];

    public function getProductos(){
        
        $builder= $this->db->table('producto p');

        $builder->join('categoria c','c.idcategoria = p.idcategoria');

        $builder->where('p.estado', 1);
        $builder->where('c.estado', 1);  //En dudas

        $result=$builder->get()->getResultArray();
        return $result;
    }

    public function deleteProductos($idproducto){
        
        $builder= $this->db->table('producto');

        $builder->set('estado', 0);
        $builder->where('idproducto', $idproducto);
        $builder->update();

        $result= $builder->get()->getResultArray();

        return $result;
    }

    public function agregar($data){
        
        $builder= $this->db->table('producto');
        
        $builder->insertBatch($data);

        $result= $builder->get()->getResultArray();

        return $result;
    }


    public function editar($data){
        
        $builder= $this->db->table('producto');
        
        $builder->where('idproducto', $data['idproducto']);
        $builder->update($data);
        $result= $builder->get()->getResultArray();

        return $result;
    }
    public function buscarPorNombre($nombre)
    {
        $builder = $this->db->table('producto');
        $builder->like('nomproducto', $nombre); 
        $builder->where('estado', 1); 
        
        $resultados = $builder->get()->getResultArray();
        
        return $resultados;
    }
    

    public function buscarModificar($nombreProducto){
        $builder = $this->db->table('producto');
        $builder->where('nomproducto', $nombreProducto);

        $resultados = $builder->get()->getResultArray();
        return $resultados;
       
    }
    public function editarCompras($data){
        $builder = $this->db->table('producto');
        $builder->set($data);
        $builder->where('idproducto', $data['idproducto']);
        $builder->update();
        
    }

    
}