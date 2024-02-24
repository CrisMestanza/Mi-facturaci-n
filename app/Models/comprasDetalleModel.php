<?php

namespace App\Models;

use CodeIgniter\Model;

class comprasDetalleModel extends Model
{
    protected $table      = 'compra_detalle';
    protected $primaryKey = 'idcompradetalle';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['idcompradetalle', 'idcompra', 'idproducto','cantidad','subtotal'];


    // public function deleteProductos($idcompra,$idproducto){
        
    //     $builder= $this->db->table('compra_detalle');
       
    //     $builder->set('subtotal', );
    //     $builder->where('idcompra',$idcompra);
    //     $builder->where('idproducto', $idproducto);

    //     $builder->update();
    // }


}