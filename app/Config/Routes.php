<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login
$routes->get('login', 'Auth::login', ['as' => 'login']);
$routes->post('login', 'Auth::autentificar', ['as' => 'procesar-login']);
$routes->get('cerrar-sesion', 'Auth::salir');


// Seguridad
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('/', 'Home::index', ['as' => 'home']);

    // Personas
    $routes->get('listado-personal', 'Persona::index', ['as' => 'registrar-persona']);
    $routes->get('listado-personas-ajax', 'Persona::listadoPersonasAjax', ['as' => 'listado-personas-ajax']);
    $routes->post('crear-persona', 'Persona::vistaAgregar', ['as' => 'crear-persona']);
    $routes->post('verificar-ci', 'Persona::VerificarPersona', ['as' => 'verificar-ci']);
    $routes->post('registro-persona', 'Persona::store', ['as' => 'registro-persona']);
    $routes->post('editar-persona', 'Persona::edit', ['as' => 'editar-persona']);
    $routes->post('actualizar-persona', 'Persona::update', ['as' => 'actualizar-persona']);
    $routes->post('eliminar-persona', 'Persona::delete', ['as' => 'eliminar-persona']);
    $routes->post('activar-persona', 'Persona::active', ['as' => 'activar-persona']);

    // Roles
    $routes->get('listado-roles', 'Grupo::index', ['as' => 'listado-roles']);
    $routes->get('listado-roles-ajax', 'Grupo::listadoRolesAjax', ['as' => 'listado-roles-ajax']);

    // Categorias
    $routes->get('listado-categorias', 'Categoria::index', ['as' => 'listado-categorias']);
    $routes->get('listado-categorias-ajax', 'Categoria::listadoCategoriasAjax', ['as' => 'listado-categorias-ajax']);
    $routes->post('crear-categoria', 'Categoria::vistaAgregar', ['as' => 'crear-categoria']);
    $routes->post('registro-categoria', 'Categoria::store', ['as' => 'registro-categoria']);
    $routes->post('editar-categoria', 'Categoria::edit', ['as' => 'editar-categoria']);
    $routes->post('actualizar-categoria', 'Categoria::update', ['as' => 'actualizar-categoria']);
    $routes->post('eliminar-categoria', 'Categoria::delete', ['as' => 'eliminar-categoria']);
    $routes->post('activar-categoria', 'Categoria::active', ['as' => 'activar-categoria']);

    // Clientes 
    $routes->get('listado-clientes', 'Cliente::index', ['as' => 'listado-clientes']);
    $routes->get('listado-clientes-ajax', 'Cliente::listadoClientesAjax', ['as' => 'listado-clientes-ajax']);
    $routes->post('crear-cliente', 'Cliente::vistaAgregar', ['as' => 'crear-cliente']);
    $routes->post('registro-cliente', 'Cliente::store', ['as' => 'registro-cliente']);
    $routes->post('editar-cliente', 'Cliente::edit', ['as' => 'editar-cliente']);
    $routes->post('actualizar-cliente', 'Cliente::update', ['as' => 'actualizar-cliente']);
    $routes->post('eliminar-cliente', 'Cliente::delete', ['as' => 'eliminar-cliente']);
});