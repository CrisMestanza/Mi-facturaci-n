<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;

use App\Models\ventaModel;



// require_once (APPPATH .'libraries/Numletras.php');
include (APPPATH."Libraries/firma/welcome_message2.php");

// require APPPATH."Libraries/firma/xmlSinFirmar/10755184778-01-F001-1.xml";

class Unidad extends BaseController
{
    public function unidades(){
        $model = new UnidadesModel();

        $unidades = $model->getUnidades();

        

        $data = array(
            'unidades' => $unidades,
            'contador'=>1
        );
        
        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        
        return view('common/header',$dataHeader).view('unidades',$data).view('common/footer');
    }

    public function activar($id){
        $unidades = new UnidadesModel();
        $unidades->activar($id);
        return redirect('unidades');
    }


    public function desactivar($id){
        $unidades = new UnidadesModel();
        $unidades->desactivar($id);
        return redirect('unidades');
    }

}
