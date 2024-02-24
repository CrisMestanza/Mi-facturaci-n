<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'idusuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idusuario', 'nombrecompleto', 'correo','contrasena','idtipousuario','celular','dni','estado'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_insert';
    protected $updatedField  = 'fecha_update';
    protected $deletedField  = 'fecha_delete';

    public function setUsuarios($correo,$contrasena){


        $db      = \Config\Database::connect();
        $builder = $db->table('usuario u');
        $builder->select('*');
        $builder->where('correo', $correo);
        $builder->join('tipousuario tp', 'tp.idtipousuario = u.idtipousuario', 'inner');
        $builder->where('contrasena',$contrasena);
        $query = $builder->get()->getResultArray();
        return $query;

   

    }
    
}