<?php

namespace App\Controllers;
use App\Models\UsuariosModel;
use App\Models\EmpresaModel;
use App\Models\UnidadesModel;
use App\Models\CategoriasModel;

use App\Models\ventaModel;



// require_once (APPPATH .'libraries/Numletras.php');
include (APPPATH."Libraries/firma/welcome_message2.php");

// require APPPATH."Libraries/firma/xmlSinFirmar/10755184778-01-F001-1.xml";

class Home extends BaseController
{
    public function index(): string
    {
        
        return view('welcome_message');
    }

    public function mostrar($data){
   
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
    public function recibirDatosXml(){
            $data= [
                'serieComprobante'=>'F001',
                'numComprobante'=>'001',
                'tipoComprobante'=>'01',
                // 'fechaEmision',//año-mes-dia
                // 'hora',
                // 'canLetras',
                // 'abrvMoneda',
                'rucDni'=>'12345678',
                'rucEmisor'=>'10755184778',
                'razonSocial'=>'CLIENTE DE PRUEBA',
                // 'ubigueo',
                // 'provincia',
                // 'departamento',
                // 'distrito',
                // 'direccion',
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
             $this->mostrar($data);
    }
    public function login(){

        $result= new UsuariosModel();
        // var_dump($usuarios["contrasena"]);die;
        // $usuarios = $model->where('fecha_delete',NULL)->findAll();
        $correo= $_POST['email_1'];
        $contrasena= $_POST['contrasena'];
        
        $usuarios= $result->setUsuarios($correo,$contrasena);
     

        foreach ($usuarios as $usuario) {
            if($correo == $usuario['correo']){
                
                if ($contrasena == $usuario['contrasena']) {

                    $session = session();

                    $model2 = new EmpresaModel();
                    $empresa = $model2->findAll();

                    $session->set('usuario',$usuario['nombrecompleto']);
                    $session->set('tipoUsuario',$usuario['nombretipousuario']);

                    $session->set('empresa',$empresa[0]['mododev']);

                    return redirect()->to('cpanel');

                }else{
                    echo '<script type="text/javascript">alert("Contraseña incorrecta.");window.location.href = "'.base_url().'";</script>';
                }
            }
        }

        echo '<script type="text/javascript">alert("Usuario no encontrado.");window.location.href = "'.base_url().'";</script>';
    }

    public function cpanel(){
        $session = session();
        $data = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
       
        return view('common/header',$data).view('cpanel').view('common/footer');
    }
    //Para practicar querys
    // public function practica(){
    //     $usuario = new UsuariosModel();
    //     $result= $usuario->setUsuarios(12,12);
    //     var_dump($result);
    // }





    public function logout(){
        $session = session();
        $session->destroy();

        echo '<script type="text/javascript">window.location.href = "'.base_url().'";</script>';
    }

    public function api(){
        $doc = $_GET['doc'];

        $token = 'apis-token-7422.K4qsT4qnQsAvf7Eb6rovatLjtysiiCge';

        if(strlen($doc) == 8) {
           // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
            // para user api versión 2
            CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $doc,
            // para user api versión 1
            // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $token
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos listos para usar
            $persona = json_decode($response);
            
            return $this->response->setJSON($persona);

        }
        else{
            $curl = curl_init();

            // Buscar ruc sunat
            curl_setopt_array($curl, array(
              // para usar la versión 2
              CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $doc,
              // para usar la versión 1
              // CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_CUSTOMREQUEST => 'GET',
              CURLOPT_HTTPHEADER => array(
                'Referer: http://apis.net.pe/api-ruc',
                'Authorization: Bearer ' . $token
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            // Datos de empresas según padron reducido
            $empresa = json_decode($response);

            return $this->response->setJSON($empresa);
            
        }
    }

    public function XML(){
        return view('welcome_message2');
    }
    
}
