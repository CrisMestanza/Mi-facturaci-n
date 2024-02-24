<?php

namespace App\Models;

use CodeIgniter\Model;

class proveedoresModel extends Model
{
    protected $table      = 'proveedores';
    protected $primaryKey = 'idproveedor';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['idproveedor', 'idtipocliente', 'numdoc','razonsocial','estado'];



}