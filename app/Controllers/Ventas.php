<?php

namespace App\Controllers;
use App\Models\ventaModel;
use App\Models\UnidadesModel;
use App\Models\NumserieModel;
use App\Models\TipoDocumento;
use App\Models\TipoDocumentoModel;

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

        $TipoDocumentoModel = new TipoDocumentoModel();
        $tipo= $TipoDocumentoModel->getTipoDocumento();

        $data = [
            'unidades'=> $unidades,
            'tipoDocumento'=> $tipo
        ];

        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];

        return view('common/header',$dataHeader).view('ventas/agregarVenta',$data).view('common/footer');
    }

    

    //Recibir los datos para enviar a generar XML
    public function recibirDatosXml(){
        if($_POST['tipoDocumento']=="Boleta"){
            $tipoComprobante= 03;
        }elseif($_POST['tipoDocumento']=="Factura"){
            $tipoComprobante= 01;
        }
        
        $session = session();

        $_POST['fechDocumento'];
            $data= [
                'serieComprobante'=> $_POST['tipoDocumento'],
                'numComprobante'=>'001',
                'tipoComprobante'=> $tipoComprobante,
                // 'fechaEmision',//año-mes-dia
                // 'hora',
                // 'canLetras',
                'abrvMoneda'=>'PEN',
                'rucDni'=>$_POST['doccliente'],
                'rucEmisor'=>'10755184778',
                'razonSocial'=>$_POST['nomcliente'],
                'ubigueo'=>  $session->get('ubigueo'),
                'provincia'=>$session->get('provincia'),
                'departamento'=> $session->get('departamento'),
                'distrito'=>$session->get('distrito'),
                'direccion'=> $_POST['direccion'],
                // 'codCatalogo6',
                // 'igv',
                // 'gravada',
                // 'ventaTotal',
                // 'codCatalogo5',
                // 'nombreCatalogo5',
                // 'tipoCatalogo5',
                // 'totalConImpuesto',
                // 'descuento',
                // 'otrosCargos',
                // 'importeTotal',
                // 'ordenItem',
                // 'cantidadProducto',
                // 'subTotalProducto',
                // 'codUnidad',
                // 'precioUnitario',
                // 'codCatalogo16',
                // 'idProducto',
                // 'nombreProducto',
                // 'nombreProducto',
            ];
             $this->xml($data);
    }

    //Generar xml
    public function xml($data){
   
        $xmlGenerado = generarXML($data);

        $url= APPPATH.'Libraries/firma/xmlSinFirmar/output.xml';
        file_put_contents($url, $xmlGenerado);
     
        echo 'XML generado y guardado en output.xml';

        
        include(APPPATH."Libraries/firma/funcionesFirma/firmado.php");

      
        $xmlFirmado= firmarXML($url);

        
        // $data['rucemisor].'-'.$data['tipocomprobante'].
        // '-'.$data['seriecomprobante'].'-'.$data['numerocorrelativo'].'.xml'     
        
        $nombreXml= $data['rucEmisor'].'-'.$data['tipoComprobante'].'-'.$data['serieComprobante'].'-'.$data['numComprobante'].'.xml';


        $ruta = APPPATH."Libraries/firma/xmlFirmado/".$nombreXml;

        file_put_contents($ruta,  $xmlFirmado);   

        echo 'XML generado y firmado en output.xml';
    
    }
}