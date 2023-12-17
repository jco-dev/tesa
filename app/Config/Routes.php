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
});