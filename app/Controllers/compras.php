<?php

namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\comprasModel;
use App\Models\comprasDetalleModel;
use App\Models\proveedoresModel;
use App\Models\CategoriasModel;

class Compras extends BaseController
{
    public function index(){
        $comprasModel = new comprasModel();
        $result= $comprasModel->getCompras();

        $proveedoresModel= new proveedoresModel();
        $getProveedores = $proveedoresModel->findAll();


        $data=['compras'=>$result,
                'contador'=>1,
                'Proveedores'=>$getProveedores,
                // 'categorias'=>$getcategorias,
                ];
                // var_dump($data);die;
                $session = session();
                $dataHeader = [
                    'nombreUsaurio' => $session->get('usuario'),
                    'tipoUsuario' => $session->get('tipoUsuario'),
                    'modoEmpresa' => $session->get('empresa')
                ];
        return view('common/header',$dataHeader).view('compras/compras',$data).view('common/footer');
    }
    public function buscarFecha(){
        
        $comprasModel = new comprasModel(); 
        $data['compras'] = $comprasModel->where('fechacompra >=', $_POST['fecha_inicio'])
                                       ->where('fechacompra <=', $_POST['fecha_fin'])
                                       ->findAll();
        
                                       $session = session();
                                       $dataHeader = [
                                           'nombreUsaurio' => $session->get('usuario'),
                                           'tipoUsuario' => $session->get('tipoUsuario'),
                                           'modoEmpresa' => $session->get('empresa')
                                       ];
                                                      
        return view('common/header',$dataHeader).view('compras/mostrarFechas',$data).view('common/footer');
    }
    public function setViewAgregar(){
        //Proveedores
        $proveedoresModel= new proveedoresModel();
        $getProveedores = $proveedoresModel->findAll();
        //Categorias
        $categoriasModel= new CategoriasModel();
        $getCategorias= $categoriasModel->findAll();

        $data=[
            'Proveedores'=>$getProveedores,
            'categorias'=>$getCategorias
        ];

        
        $session = session();
        $dataHeader = [
            'nombreUsaurio' => $session->get('usuario'),
            'tipoUsuario' => $session->get('tipoUsuario'),
            'modoEmpresa' => $session->get('empresa')
        ];

        return view('common/header',$dataHeader).view('compras/agregarCompras',$data).view('common/footer');
    }

    public function agregar(){

        $nombre_compra = $_POST['numcorrelativo'];
    
        $modelCompras = new comprasModel();
        $data= [
            'numcorrelativo' => $nombre_compra, 
            'idproveedor'=>$_POST['proveedor'],
            'fechacompra'=>$_POST['fechDocumento']
        ];
    
        $modelCompras->insert($data);
        // Obtener el id del registro agregado de compra
        $idInsertado = $modelCompras->insertID();
    
        
        $productos = $_POST['producto'];
        $idProductos = [];
    
        foreach ($productos["nombre"] as $key => $nombreProducto) {

            $descripcionProducto = $productos["detalle"][$key];
            $precio = intval($productos["precio"][$key]);
            $stock= intval($productos["stock"][$key]);
            $categoria= $productos["categoria"][$key];
            
            // Verificar si el producto ya existe en la base de datos
            $model = new ProductosModel();

            $productoExistente = $model->buscarModificar($nombreProducto);

            if ($productoExistente) {
                // Si el producto ya existe, actualiza el stock existente
                $nuevoStock = $productoExistente[0]['stockactual'] + $stock;
                $model->update($productoExistente[0]['idproducto'], ['stockactual' => $nuevoStock]);
                
            }else{
                // Si el producto no existe, inserta uno nuevo
                $dataProducto=[
                    'idcategoria'=>$categoria,
                    'nomproducto' => $nombreProducto,
                    'descripcion' => $descripcionProducto,
                    'preciounitario' =>$precio,
                    'stockactual'=>$stock,
                ];
                
          
                $model->insert($dataProducto);
                $idProducto = $model->insertID();
            

                $dataCompraDetalle= [
                    'idcompra' => $idInsertado,
                    'idproducto'=>$idProducto,
                    'cantidad'=>$stock,  
                    'subtotal'=>$stock*$precio,
                ];
                $compraDetalle= new comprasDetalleModel();
                $compraDetalle->insert($dataCompraDetalle);
            }
        }
    
        return redirect()->to('/compras');
    }
    
    public function busqueda(){   //Busca productos relacionados a lo ingresado en el input

        $nombre= $_POST['busqueda'];
    

        $producto= new ProductosModel();

        $resultados= $producto->buscarPorNombre($nombre);

        // $nomproductos = array_column($resultados, 'nomproducto');

        // Devolver los resultados como JSON
        return $this->response->setJSON($resultados);
    }

    public function eliminar($id){
        // echo $id;die;
        $eliminar = new comprasModel();
        $eliminar->eliminar($id);
        return redirect()->to('/compras');
    }
    public function editar(){

       
        $dataCompras=[
            'numcorrelativo'=>$_POST['numcorrelativo'],
            'idcompra'=>$_POST['idcompra'],
            'fechacompra'=>$_POST['fechDocumento'],
            'idproveedor'=>$_POST['proveedor'],
        ];

        $dataProducto=[
            'idproducto'=>$_POST['idproducto'],
            'idcategoria'=>$_POST['categoria'],
            'nomproducto'=>$_POST['nombre'],
            'descripcion'=>$_POST['detalle'],
            'preciounitario'=>$_POST['precio'],
            'stockactual'=>$_POST['stock'],
        ];
    
        $compras= new comprasModel();
        $compras->editar($dataCompras);

        $producto= new ProductosModel();
        $producto->editarCompras($dataProducto);

        return redirect()->to(base_url('compras'));
    }
}