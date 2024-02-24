<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\CategoriasModel;


class Productos extends BaseController
{
    public function producto(){

        $model = new ProductosModel();
        
        $categoria = new CategoriasModel();

        $productos = $model->getProductos();
        
        $categorias= $categoria->findAll();


        $data = array(
            'productos' => $productos,
            'contador'=>1,
            'categorias'=>$categorias
        );
        
        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];
        return view('common/header',$dataHeader).view('productos',$data).view('common/footer');
    }

    
    public function eliminar($idproducto){
        

        $model = new ProductosModel();

        $model->deleteProductos($idproducto);

        return redirect()->to(base_url('/productos'));

      
    }

    public function agregar(){
        $nombre= $_POST['nombreProducto'];
        $descripcionProducto= $_POST['descripcionProducto'];
        $precioProducto= $_POST['precioProducto'];
        $stockProducto= $_POST['stockProducto'];
        $idCategoriaSeleccionada = $_POST['categoria'];

        if ($this->request->getMethod() === 'post') {
            $imagen = $this->request->getFile('imagenProducto');
            
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();
                // 'assets/img/productos'
                $imagen->move(FCPATH . 'assets/img/productos', $nombreImagen);
                // $ruta= file_get_contents(WRITEPATH . '/uploads/productos/' . $nombreImagen);
                $data = [
            
                    'nomproducto' => $nombre,
                    'descripcion'  => $descripcionProducto,
                    'preciounitario'  => $precioProducto,
                    'stockactual'  => $stockProducto,
                    'estado'  => 1,
                    'idcategoria'  => $idCategoriaSeleccionada,
                    'imagenprod' =>$nombreImagen,
                    // 'nombreImagen' =>$ruta
        
                ];
   
            } else{
                $data = [
            
                    'nomproducto' => $nombre,
                    'descripcion'  => $descripcionProducto,
                    'preciounitario'  => $precioProducto,
                    'stockactual'  => $stockProducto,
                    'estado'  => 1,
                    'idcategoria'  => $idCategoriaSeleccionada
                    
                    // 'nombreImagen' =>$ruta
        
                ];
            }
           
        }
        $model = new ProductosModel();

        $model->agregar($data);
       
       return redirect()->to(base_url('/productos'));
    }

    public function update(){
        $idproducto= $_POST['idproducto2'];
        $nombre= $_POST['nombreProducto2'];
        $descripcionProducto= $_POST['descripcionProducto2'];
        $precioProducto= $_POST['precioProducto2'];
        $stockProducto= $_POST['stockProducto2'];
        $idCategoriaSeleccionada = $_POST['categoria2'];

        if ($this->request->getMethod() === 'post') {
            $imagen = $this->request->getFile('imagenProducto2');
            
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $nombreImagen = $imagen->getRandomName();
                $imagen->move(FCPATH . 'assets/img/productos', $nombreImagen);
                $data = [
            
                    'idproducto'=>$idproducto,
                    'nomproducto' => $nombre,
                    'descripcion'  => $descripcionProducto,
                    'preciounitario'  => $precioProducto,
                    'stockactual'  => $stockProducto,
                    'estado'  => 1,
                    'idcategoria'  => $idCategoriaSeleccionada,
                    'imagenprod' =>$nombreImagen
                ];
   
            } else{
                $data = [
            
                    'idproducto'=>$idproducto,
                    'nomproducto' => $nombre,
                    'descripcion'  => $descripcionProducto,
                    'preciounitario'  => $precioProducto,
                    'stockactual'  => $stockProducto,
                    'estado'  => 1,
                    'idcategoria'  => $idCategoriaSeleccionada
                ];
            }
           
        }




        $model = new ProductosModel();

        $model->editar($data);
        
        return redirect()->to(base_url('/productos'));

      
    }


    
}