<?php

namespace App\Models;

use CodeIgniter\Model;

class ventaModel extends Model
{
    protected $table      = 'venta_detalle';
    protected $primaryKey = 'idventadetalle';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idventadetalle', 'idventa', 'idproducto','cantidad','preciosubtotal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function getVentas(){


        return $this->db->table('venta_detalle vd')
        ->select('vd.idventadetalle,C.razonsocial, SUM(vd.preciosubtotal) AS total_venta,v.fechaemision,v.numcorrelativo')

        ->join('venta v','v.idventa = vd.idventa')
        ->join('clientes c','v.idcliente = c.idcliente')
        ->join('producto p','p.idproducto = vd.idproducto')
        ->join('numserie n','n.idnumserie = v.idnumserie')

        ->where('p.estado',1)
        ->where('v.estado',1)
        ->where('n.estado',1)
        ->where('c.estado',1)
        ->groupBy('C.razonsocial, v.fechaemision, v.numcorrelativo,vd.idventadetalle')
        ->get()->getResultArray();


    }
    
}