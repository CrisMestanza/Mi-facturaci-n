<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\CategoriasModel;
use App\Models\NumserieModel;
use App\Models\TipoDocumentoModel;


class Series extends BaseController
{

    public function series(){
        //Obtener tipo de documento para agregar
        $tipoDoc = new TipoDocumentoModel();
        $resultTipo= $tipoDoc->getTipoDocumento();

        //Obtener numero de serie y tipo de documento (Visualizar)
        $series = new NumserieModel();
        $serie = $series->getNumseries();

        $data=[
            'series'=>$serie,
            'contador'=>1,
            'tipoDocumentos'=>$resultTipo,
        ];

        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        
        return view('common/header',$dataHeader).view('series/serie',$data).view('common/footer');
    }

    public function agregarSerie(){
        $data = [
            'idtipodocumento' => $_POST['tipoDoc'],
            'numserie' => $_POST['numSerie'],
            'estado' => 1,
        ];
        $series = new NumserieModel();
        $series->agregarNumSerie($data);
        return redirect()->to('/series');
    }
    public function editarSerie(){
        $data = [
            'idtipodocumento' => $_POST['tipoDoc'],
            'numserie' => $_POST['numSerie'],
            'idnumserie' => $_POST['idNumSerie'],
            'estado' => 1,
        ];
        $series = new NumserieModel();
        $series->editarNumSerie($data);
        return redirect()->to('/series');
    }

    public function eliminarNumSerie($id){
        $series = new NumserieModel();
        $series->eliminarNumSerie($id);
        return redirect()->to('/series');
    }
}