<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/inicio', 'Home::index');
$routes->get('/luis', 'Home::luis');

//AGENCIAS
$routes->get('/agencias', 'Agencias::index');
$routes->get('/agencias/nuevo', 'Agencias::nuevo');
$routes->get('/agencias/exportar', 'Agencias::exportar');

//form nuevo
$routes->match(['get','post'],'/agencias/guardar', 'Agencias::save');
$routes->match(['get','post'],'/agencias/editar', 'Agencias::editar');
$routes->match(['get','post'],'/agencias/actualizar', 'Agencias::update');
$routes->match(['get','post'],'/agencias/importar', 'Agencias::importar');

$routes->match(['get','post'],'/agencias/eliminar', 'Agencias::eliminar');

//USERS
$routes->get('/users', 'Users::index',['filter' => 'authGuardAdmin']);
$routes->get('/users/nuevo', 'Users::nuevo');
$routes->get('/users/exportar', 'Users::exportar');


//form nuevo
$routes->match(['get','post'],'/users/guardar', 'Users::save');
$routes->match(['get','post'],'/users/editar', 'Users::editar',['filter' => 'AuthGuardAdminPropietario']);
$routes->match(['get','post'],'/users/actualizar', 'Users::update');

$routes->match(['get','post'],'/users/eliminar', 'Users::eliminar');
$routes->match(['get','post'],'/users/importar', 'Users::importar');



$routes->get('notification', 'MessageController::showSweetAlertMessages');
$routes->match(['get','post'],'borrar','MessageController::showDeleteAlertMessages');

$routes->match(['get','post'],'info','MessageController::showInfoTimerIntervalAlertMessages');

$routes->match(['get','post'],'infoAccion','MessageController::showInfoAlertMessages');
//COMERCIOS
$routes->get('/comercios', 'ComerciosController::index',['filter' => 'authGuard']);
$routes->get('/comercios/nuevo', 'ComerciosController::nuevo');
$routes->get('/comercios/exportar', 'ComerciosController::exportar');
$routes->match(['get','post'],'/comercios/guardar', 'ComerciosController::save');
$routes->match(['get','post'],'/comercios/eliminar', 'ComerciosController::eliminar');
$routes->match(['get','post'],'/comercios/editar', 'ComerciosController::editar');
$routes->match(['get','post'],'/comercios/actualizar', 'ComerciosController::update');
$routes->match(['get','post'],'/comercios/importar', 'ComerciosController::importar');


$routes->get('/comercios/nuevo2', 'ComerciosController::nuevo2');
$routes->match(['get','post'],'/comercios/guardar2', 'ComerciosController::save2');

$routes->get('/comercios/nuevo3', 'ComerciosController::nuevo3');
$routes->match(['get','post'],'/comercios/guardar3', 'ComerciosController::save3');

$routes->get('/comercios/nuevo4', 'ComerciosController::nuevo4');
$routes->match(['get','post'],'/comercios/guardar3', 'ComerciosController::save4');

$routes->match(['get','post'],'/comercios/editar2', 'ComerciosController::editar2');
$routes->match(['get','post'],'/comercios/actualizar2', 'ComerciosController::update2');

$routes->match(['get','post'],'/comercios/editar4', 'ComerciosController::editar4');
$routes->match(['get','post'],'/comercios/actualizar4', 'ComerciosController::update4');

//Tipos facturacion
$routes->get('/tipo_facturacion', 'Tipo_facturacionController::index');
$routes->get('/tipo_facturacion/nuevo', 'Tipo_facturacionController::nuevo');
$routes->get('/tipo_facturacion/nuevo2', 'Tipo_facturacionController::nuevo2');
$routes->get('/tipo_facturacion/exportar', 'Tipo_facturacionController::exportar');

$routes->match(['get','post'],'/tipo_facturacion/guardar', 'Tipo_facturacionController::save');
$routes->match(['get','post'],'/tipo_facturacion/guardar2', 'Tipo_facturacionController::save2');
$routes->match(['get','post'],'/tipo_facturacion/eliminar', 'Tipo_facturacionController::eliminar');
$routes->match(['get','post'],'/tipo_facturacion/editar', 'Tipo_facturacionController::editar');
$routes->match(['get','post'],'/tipo_facturacion/editar2', 'Tipo_facturacionController::editar2');
$routes->match(['get','post'],'/tipo_facturacion/actualizar', 'Tipo_facturacionController::update');
$routes->match(['get','post'],'/tipo_facturacion/imprimir', 'Tipo_facturacionController::exportar');
$routes->match(['get','post'],'/tipo_facturacion/importar', 'Tipo_facturacionController::importar');




$routes->get('form2', "Form::form2");
$routes->post('form2', 'Form::form2');




$routes->get('/', 'SigninController::index',['filter' => 'Noauth']);
$routes->get('/signup', 'SignupController::index');
$routes->match(['get', 'post'], 'SignupController/store', 'SignupController::store');
$routes->match(['get', 'post'], 'SigninController/loginAuth', 'SigninController::loginAuth');
$routes->get('/signin', 'SigninController::index',['filter' => 'Noauth']);
$routes->get('/profile', 'ProfileController::index',['filter' => 'authGuard']);



//ROLE
$routes->get('/roles', 'RolesController::index');
$routes->get('/roles/nuevo', 'RolesController::nuevo');
$routes->match(['get','post'],'/roles/guardar', 'RolesController::save');
$routes->match(['get','post'],'/roles/editar', 'RolesController::editar');
$routes->match(['get','post'],'/roles/actualizar', 'RolesController::update');
$routes->match(['get','post'],'/roles/eliminar', 'RolesController::eliminar');
$routes->get('/roles/exportar', 'RolesController::exportar');
$routes->match(['get','post'],'/roles/importar', 'RolesController::importar');




//CLIENTES
$routes->get('/clientes', 'ClientesController::index');
$routes->get('/clientes/nuevo', 'ClientesController::nuevo');
$routes->match(['get','post'],'/clientes/guardar', 'ClientesController::save2');
$routes->match(['get','post'],'/cliente/editar', 'ClientesController::editar');
$routes->match(['get','post'],'/cliente/actualizar', 'ClientesController::update');
$routes->match(['get','post'],'/cliente/eliminar', 'ClientesController::eliminar');
$routes->get('/cliente/exportar', 'ClientesController::exportar');
$routes->match(['get','post'],'/cliente/importar', 'ClientesController::importar');
