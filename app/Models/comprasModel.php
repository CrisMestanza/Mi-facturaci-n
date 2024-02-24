<?php

namespace App\Models;

use CodeIgniter\Model;

class comprasModel extends Model
{
    protected $table      = 'compras';
    protected $primaryKey = 'idcompra';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['idcompra', 'idproveedor', 'numcorrelativo','fechacompra','estado'];

    public function getCompras(){
        $builder = $this->db->table('compras c');
        $builder->select('d.idcompra,p.razonsocial, c.numcorrelativo,pr.idproducto,pr.nomproducto,pr.descripcion,pr.preciounitario,
                          pr.stockactual,ca.nomcategoria,ca.idcategoria,c.fechacompra, SUM(d.subtotal) AS total_compra');
        $builder->join('compra_detalle d', 'c.idcompra = d.idcompra');
        $builder->join('producto pr', 'pr.idproducto = d.idproducto'); //union con producto
        $builder->join('categoria ca', 'pr.idcategoria = ca.idcategoria'); //union con categoria
        $builder->join('proveedores p', 'p.idproveedor = c.idproveedor');
        $builder->where('c.estado', 1);   //Falto agregar este where XD
        $builder->where('pr.estado', 1);   //Falto agregar este where XD
        $builder->groupBy('c.idcompra, c.numcorrelativo');
        $builder->groupBy('c.idcompra, c.numcorrelativo, d.idcompra, p.razonsocial, c.numcorrelativo, pr.idproducto, pr.nomproducto, pr.descripcion, pr.preciounitario, pr.stockactual, ca.nomcategoria, ca.idcategoria, c.fechacompra');


        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }
    public function eliminar($id){
        $builder = $this->db->table('compras');
        $builder->set('estado', 0);
        $builder->where('idcompra', $id);
        $builder->update();
        
    }
    public function editar($data){
        $builder = $this->db->table('compras');
        $builder->set($data);
        $builder->where('idcompra', $data['idcompra']);
        $builder->update();
        
    }

}