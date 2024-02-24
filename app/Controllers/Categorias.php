<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;

use App\Models\ventaModel;



// require_once (APPPATH .'libraries/Numletras.php');
include (APPPATH."Libraries/firma/welcome_message2.php");

// require APPPATH."Libraries/firma/xmlSinFirmar/10755184778-01-F001-1.xml";

class Categorias extends BaseController
{

    public function categorias(){
        $model = new CategoriasModel();

        $categorias = $model->gerCategoria();
        
        $data = array(
            'categorias' => $categorias
        );

        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        
        return view('common/header',$dataHeader).view('categorias',$data).view('common/footer');
    }

    public function agregar(){
       
       
        $categorias = new CategoriasModel();

        $data= [
            'nomcategoria' =>  $_POST['nameCategoriaAgregar'],
            'estado'=>1
        ];
    
        $categorias->insert($data);
    }

    public function editar(){
        $data= [
            'idcategoria'=> $_POST['idCategoria'],
            'nomcategoria'=> $_POST['nameCategoria']
        ];

        $categoria = new CategoriasModel();
        $categoria->editar($data);
        return redirect('categorias');
    }

    public function eliminar($id){


        $model = new CategoriasModel();

        $model->eliminar($id);

        return redirect()->to(base_url('categorias'));

    }


}
