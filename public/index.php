<?php 

require __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\VendedorController;
use Controllers\PropiedadController;


$router = new Router();

// ZONA PRIVADA

$router->GET('/admin', [PropiedadController::class, 'index']);
$router->GET('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->POST('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->GET('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->POST('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->POST('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->GET('/vendedores/crear', [VendedorController::class, 'crear']);
$router->POST('/vendedores/crear', [VendedorController::class, 'crear']);
$router->GET('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->POST('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->POST('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

// ZONA PUBLICA

$router->GET('/', [PaginasController::class, 'index']);
$router->GET('/nosotros', [PaginasController::class, 'nosotros']);
$router->GET('/propiedades', [PaginasController::class, 'propiedades']);
$router->GET('/propiedad', [PaginasController::class, 'propiedad']);
$router->GET('/blog', [PaginasController::class, 'blog']);
$router->GET('/entrada', [PaginasController::class, 'entrada']);
$router->GET('/contacto', [PaginasController::class, 'contacto']);
$router->POST('/contacto', [PaginasController::class, 'contacto']);

// Login y Autenticacion
$router->GET('/login', [LoginController::class, 'login']);
$router->POST('/login', [LoginController::class, 'login']);
$router->GET('/logout', [LoginController::class, 'logout']);


$router->comprobarRutas();