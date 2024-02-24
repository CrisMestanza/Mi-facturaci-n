<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\DepartamentosModel;
use App\Models\ProvinciaModel;
use App\Models\DistritoModel;
use App\Models\ventaModel;
use App\Models\UnidadesModel;


class Ventas extends BaseController
{

    public function ventas(){

        $model = new ventaModel();
        
        $ventas = $model->getVentas();
        

        $data = array(
            'ventas' => $ventas,
            'contador' => 0
        );
        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        
        return view('common/header',$dataHeader).view('simventas',$data).view('common/footer');
    }

    public function setVenta(){

        $unidadesModel = new UnidadesModel();
        $unidades = $unidadesModel->getUnidadesVentas();
        $data = [
            'unidades'=> $unidades
        ];

        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];

        return view('common/header',$dataHeader).view('ventas/agregarVenta',$data).view('common/footer');
    }
}