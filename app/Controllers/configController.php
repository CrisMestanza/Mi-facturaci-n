<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use App\Models\DepartamentosModel;
use App\Models\ProvinciaModel;
use App\Models\DistritoModel;


class configController extends BaseController
{
    public function configuracion(){

        $empresa = new EmpresaModel();
        $datos = $empresa->setEmpresa();
        
        $departamentos = new DepartamentosModel();
        $datosDepartamento = $departamentos->getDepartamentos(); 

        $data= [
            'empresas' => $datos,
            'departamentos' => $datosDepartamento
        ];

        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        return view('common/header',$dataHeader).view('configuracion/configuracion',$data).view('common/footer');
    }

    public function editar(){
//Para las variables de sesión en ventas
        $departamento = $_POST['departamento'];
        $departamentosModel = new DepartamentosModel();
        $getDepartamento = $departamentosModel->Departamentos($departamento);
        $resultDepartamento = $getDepartamento[0]['nombredepartamento']; 
        
        $provincia = $_POST['provincia'];
        $provinciasModel = new ProvinciaModel();
        $getProvincia = $provinciasModel->Provincia($provincia);
        $resultProvincia = $getProvincia[0]['nombreprovincia'];
 

        $distrito = $_POST['distrito'];
        $provinciasModel = new DistritoModel();
        $getDistrito = $provinciasModel->Distrito($distrito);
        $resultDistrito = $getDistrito[0]['nombredistrito'];

        $session = session();
        $session->set('rucEmisor',$_POST['rucCategoria']);
        $session->set('razonSocialEmisor',$_POST['razonSocial']);
        $session->set('ubigueo',$_POST['ubigueo']);
        $session->set('provincia',$resultProvincia);
        $session->set('distrito',$resultDistrito);
        $session->set('departamento',$resultDepartamento);
//Fin de las session de ventas

        $ruc = $_POST['rucCategoria'];
        $razonsocial = $_POST['razonSocial'];
        $nombrecomercia = $_POST['nombreComercia'];
        $direccion = $_POST['Direccion'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $ubigueo = $_POST['ubigueo'];
        $telefono = $_POST['telefono'];



        if ($this->request->getMethod() === 'post') {
            $imagen = $this->request->getFile('imagenEmpresa');
            
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();
                // 'assets/img/productos'
                $imagen->move(FCPATH . 'assets/img/empresa', $nombreImagen);
                // $ruta= file_get_contents(WRITEPATH . '/uploads/productos/' . $nombreImagen);
                $data = [
            
                    'ruc' => $ruc,
                    'razonsocial'  => $razonsocial,
                    'nombrecomercial'  => $nombrecomercia,
                    'direccion'  => $direccion,
                    'logo' =>$nombreImagen,
                    'telefono'  => $telefono,
                    'usersec'  => $user,
                    'passwordsec'  => $password,
                    'ubigueo'  => $ubigueo,

                ];
   
            } else{
                $data = [
                    'ruc' => $ruc,
                    'razonsocial'  => $razonsocial,
                    'nombrecomercial'  => $nombrecomercia,
                    'direccion'  => $direccion,
                    'telefono'  => $telefono,
                    'usersec'  => $user,
                    'passwordsec'  => $password,
                    'ubigueo'  => $ubigueo,
                ];
            }
           
        }
        $model = new EmpresaModel();

        $model->editar($data);
       
       return redirect()->to(base_url('/configuracion'));
    }

    public function getProvincia(){
      

        $selectedValue = $_GET['selected_value'];
      
        $provincias = new ProvinciaModel();
        $datos = $provincias->getProvincia($selectedValue); 

        
        return $this->response->setJSON($datos);
     
    }

    public function getDistrito(){
      

        $selectedValue = $_GET['selected_value'];
      
        $provincias = new DistritoModel();
        $datos = $provincias->getDistrito($selectedValue); 

        
        return $this->response->setJSON($datos);
     
    }

    public function getUbigueo(){
      

        $selectedValue = $_GET['selected_value'];
      
        $provincias = new DistritoModel();
        $datos = $provincias->getUbigueo($selectedValue); 

        
        return $this->response->setJSON($datos);
     
    }

    public function activar(){
        $mododev = $_GET['mododev1'];
        $empresa = new EmpresaModel();
        $empresa->activar($mododev);
       
    }
    public function desactivar(){
        $mododev = $_GET['mododev1'];
        $empresa = new EmpresaModel();
        $empresa->activar($mododev);
       
    }
}