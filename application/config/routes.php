<?php
defined('BASEPATH') OR exit('No direct script access allowed');


# nuevas rutas
$route['/'] = "UserController/index";//de todas formas, coge la ruta por defecto
$route['lista-juegos'] = "UserController/juegos";
$route['lista-post'] = "UserController/post";

$route['contacto'] = "UserController/contacto";
$route['creador-blog'] = "UserController/creador_blog";
$route['aviso-legal'] = "UserController/aviso_legal";
$route['politica-cookies'] = "UserController/politica_cookies";
$route['politica-privacidad'] = "UserController/politica_privacidad";

# LOGIN
$route['login'] = 'LoginController/login';
$route['login2'] = 'LoginController/login2';
$route['login/error'] = 'LoginController/login';
$route['usuario/registro'] = 'LoginController/registro';
$route['inicio'] = 'LoginController/inicio_logueado';
$route['perfil-usuario'] = 'LoginController/perfil_usuario';
$route['usuario/cerrar-sesion'] = 'LoginController/cerrar_sesion';


# ADMIN
$route['admin/panel-control'] = 'AdminController/panel_control';


$route['default_controller'] = 'UserController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



/*
    # BLOG
    $route['/'] = "PostController/index";//coge la ruta por defecto
    $route['post/(:num)'] = 'PostController/post';
    $route['autor/(:num)'] = 'PostController/autor';

    # POST
    $route['new_post'] = 'AdminController/new_post';
    $route['add'] = 'AdminController/add';
    $route['autores'] = 'AdminController/autores';
    $route['edit/(:num)'] = 'AdminController/edit';
    $route['update'] = 'AdminController/update';
    $route['edit_autor/(:num)'] = 'AdminController/edit_autor';
    $route['update_autor'] = 'AdminController/update_autor';
    $route['delete/(:num)'] = 'AdminController/delete';
    $route['delete_autor/(:num)'] = 'AdminController/delete_autor';

    $route['admin'] = 'AdminController/list';

    # LOGIN
    $route['admin/login'] = 'AdminController/login';
    $route['login/error'] = 'AdminController/login';
    $route['admin/login2'] = 'AdminController/login2';
    $route['admin/registro'] = 'AdminController/registro';
    $route['add_autor'] = 'AdminController/add_autor';
    $route['list'] = 'AdminController/list';

*/

    