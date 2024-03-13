<?php

namespace App\Controllers;
use App\Models\ventaModel;
use App\Models\UnidadesModel;
use App\Models\NumserieModel;
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

    public function buscarTipoDoc(){
        $tipo= new NumserieModel();
        $result = $tipo->buscarTipoDocumento($_POST['doc']);
        return $this->response->setJSON($result);
    }
    

    //Recibir los datos para enviar a generar XML
    public function recibirDatosXml(){

        //Obtener tipo F001 o B001
        $numserie = new NumserieModel();
        $resultNumserie = $numserie->buscarNumSerie($_POST['serie']);
        //Obtener el ultimo numero correlativo
        $venta = new ventaModel();
        $resultVenta= $venta->getNumeroCorrelativo($_POST['serie']);
        $numero = $resultVenta[0]['numcorrelativo'];
        $nuevoNumero = $this->incrementarNumero($numero);
    
        //Paraa hacer piola el array de producto
        $producto = $_POST['producto'];
        foreach ($producto['nombre'] as $index => $nombreProducto) {
            $productos[] = [
                'cantidadprod' => $producto['unidad'][$index],
                'codunidad' => 'NIU', // No se especifica en el primer array
                'subtotal' => $producto['total'][$index], // No se especifica en el primer array
                'preciounit' => $producto['precioUnitario'][$index],
                'nomproducto' => $nombreProducto,
                'codprod' => 'P0001' . ($index + 1) // Generar códigos de producto únicos

            ];
        }

        //Buscar tipo de documento a partir del id que llega
        $TipoDocumentoModel = new TipoDocumentoModel();
        $resultTipoDoc = $TipoDocumentoModel->getTipoDocumentoId($_POST['tipoDocumento']);

         // Establecer la zona horaria a Perú
         date_default_timezone_set('America/Lima');

         // Carga el helper de fecha
         helper('date');
 
         // Obtiene la hora actual mas la fecha
         $horaActualFecha = date('Y-m-d H:i:s');
 
         // Extraer solamente la hora
         $horaAcutalPeru = substr($horaActualFecha, 11, 8);
        //Convertir de numeros a letras 
        $numero = $_POST['importeTotal'];
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://nal.azurewebsites.net/api/NAL?num=$numero",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);
        
        $response = curl_exec($curl);
        
        $result = ""; 
        
        $err = curl_error($curl);
                
        curl_close($curl);
                
        if ($err) {
            $result = "cURL Error #:" . $err;
        } else {
            // Decodificar el JSON
            $json_response = json_decode($response, true);
            // Obtener el valor de la clave "letras" del json
            $result = $json_response['letras'];
        }


        //Igv para mas adelante el catalogo 16 sea 1// Veo si meter igv al subtotal o total, si trabajo una o otra forma
        //Si es catalogo 16 (1) aplico igv al total
        //Si es catalogo 16 (2) aplico igv al subtotal

        // Busqueda por Numero de serie  
        // Independiente si anulo una boleta y continua desde el ultimo eje 12 y anulo el 12 sigue el 13 con normalidad
        // Enviado, anulado, sin enviar en detalle_venta
        $session = session();
            //   veinte y tres
            //  30/100 soles para decimales
            //  23.50 veinte y tres con 50/100 soles
            //  23    veinte y tres con 00/100 soles


            //---- Poner de frente 8 que costaba 10 procesar internamente o  poner 10 y que hay descuento de 2 soles en la boleta (+ al igv)
            $data= [
                'serieComprobante'=> $resultNumserie[0]['numserie'], //Ya esta
                'numComprobante'=>$nuevoNumero,
                'tipoComprobante'=> $resultTipoDoc[0]['codigosunat'], //Ya esta
                'fechaEmision'=> $_POST['fechDocumento'], //Ya esta
                'hora'=> $horaAcutalPeru, //Ya esta
                'canLetras'=>$result,//Ya esta
                'abrvMoneda'=>'PEN', //Ya esta
                'rucDni'=>$_POST['doccliente'], //Ya esta
                'rucEmisor'=>$session->get('rucEmisor'), //Ya esta
                'razonSocialCliente'=>$_POST['nomcliente'], //Ya esta
                'razonSocialEmisor'=>$session->get('razonSocialEmisor'), //Ya esta
                'ubigueo'=>  $session->get('ubigueo'),  //Ya esta
                'provincia'=>$session->get('provincia'), //Ya esta
                'departamento'=> $session->get('departamento'), //Ya esta
                'distrito'=>$session->get('distrito'), //Ya esta
                'direccion'=> $_POST['direccion'], //Ya esta
                // 'codCatalogo6',
                'igv'=>'0,00', //Ya esta
                'gravada'=>'0', //Ya esta
                'ventaTotal'=> $_POST['importeTotal'],  //Ya esta
                // 'codCatalogo5', //Borrar para mas adelante
                // 'nombreCatalogo5', //Borrar para mas adelante
                // 'tipoCatalogo5', //Borrar para mas adelante
                'totalConImpuesto'=>$_POST['importeTotal'], //Ya esta
                // 'descuento', //Borrar para mas adelante
                // 'otrosCargos', //Borrar para mas adelante
                'importeTotal'=>$_POST['importeTotal'],
                // 'ordenItem', //Borrar para mas adelante
                // 'codCatalogo16', //Borrar para mas adelante
                'productos' => $productos//Esta tip array aca
            ];
            echo '<pre>';
            // var_dump($data);die();
            // Acceder al subarray "productos" e iterar sobre él
 
            foreach ($data['productos'] as $indice=>$producto) {
                Echo $indice+1;
                var_dump($producto);
            }die();
             $this->xml($data);
            

    }

    //Para pasar de 00001 a 00002
    public function incrementarNumero($numero) {
        // Convertir el número a entero y luego incrementarlo
        $numeroIncrementado = intval($numero) + 1;
    
        // Convertir el número incrementado de nuevo a cadena con ceros a la izquierda
        $numeroFormateado = str_pad($numeroIncrementado, strlen($numero), '0', STR_PAD_LEFT);
    
        return $numeroFormateado;
    }
    
    
    

    //Generar xml
    public function xml($data){
        include(APPPATH."Libraries/firma/welcome_message2.php");

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