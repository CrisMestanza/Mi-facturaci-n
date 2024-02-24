<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/mostrar', 'Home::recibirDatosXml');

$routes->post('/login', 'Home::login');

$routes->get('/practica', 'Home::practica');

$routes->get('/cpanel', 'Home::cpanel');


// categoriasñ
$routes->get('/categorias','Categorias::categorias');
$routes->post('categoria/edit/','Categorias::editar');
$routes->post('categoria/agregar/','Categorias::agregar');
$routes->get('categoria/eliminar/(:num)','Categorias::eliminar/$1');

//unidades
$routes->get('/unidades','Unidad::unidades');
$routes->get('unidades/activar/(:num)','Unidad::activar/$1');
$routes->get('unidades/desactivar/(:num)','Unidad::desactivar/$1');

//Productos
$routes->get('/productos','Productos::producto');
$routes->post('/productos/agregar','Productos::agregar');
$routes->post('/productos/update','Productos::update');
$routes->get('/productos/eliminar/(:num)','Productos::eliminar/$1');
//Compras
$routes->get('/compras','Compras::index');
$routes->post('/compras/agregar','Compras::agregar');
$routes->post('/compras/buscarFecha','Compras::buscarFecha');
$routes->post('/compras/mostrarFechas','Compras::mostrarFechas');
$routes->get('/compras/setViewAgregar','Compras::setViewAgregar');
$routes->post('/compras/busqueda','Compras::busqueda');
$routes->post('/compras/editar','Compras::editar');
$routes->get('/compras/eliminar/(:num)','Compras::eliminar/$1');

//configuración
$routes->get('/configuracion','configController::configuracion');
$routes->get('/configuracion/getProvincia','configController::getProvincia');
$routes->get('/configuracion/getDistrito','configController::getDistrito');
$routes->get('/configuracion/getUbigueo','configController::getUbigueo');
$routes->get('/configuracion/activar','configController::activar');
$routes->get('/configuracion/desactivar','configController::desactivar');
$routes->post('/configuracion/editar/','configController::editar/');

//Ventas
$routes->get('/ventas','Ventas::ventas');
$routes->get('/ventas/nuevaventa','Ventas::setVenta');

//Home
$routes->get('/logout','Home::logout');
$routes->get('/ventas/api','Home::api');