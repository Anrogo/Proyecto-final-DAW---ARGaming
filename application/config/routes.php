<?php
defined('BASEPATH') OR exit('No direct script access allowed');


# RUTAS PARA TODOS LOS USUARIOS
$route['/'] = "UserController/index";//de todas formas, coge la ruta por defecto
$route['lista-juegos'] = "UserController/juegos";
$route['lista-post'] = "UserController/post";


#$route['nuevo-usuario'] = 'UserController/registro_usuario';
#$route['registrar-usuario'] = 'UserController/registrar_nuevo_usuario';

$route['contacto'] = "FormController/contactar";
$route['creador-blog'] = "UserController/creador_blog";
$route['aviso-legal'] = "UserController/aviso_legal";
$route['politica-cookies'] = "UserController/politica_cookies";
$route['politica-privacidad'] = "UserController/politica_privacidad";

# LOGIN
$route['login'] = 'LoginController/login';
$route['login2'] = 'LoginController/login2';
$route['login/error'] = 'LoginController/login';
$route['registro'] = "FormController/registro";
$route['inicio'] = 'LoginController/inicio_logueado';
$route['perfil-usuario'] = 'LoginController/perfil_usuario';
$route['usuario/editar-perfil/(:num)'] = 'FormController/editar_perfil';
$route['usuario/resetear-password'] = 'FormController/cambiar_password';
$route['usuario/cerrar-sesion'] = 'LoginController/cerrar_sesion';

# ADMIN
$route['admin'] = 'AdminController/index';
$route['admin/inicio'] = 'AdminController/index';
$route['admin/perfil-admin'] = 'AdminController/perfil_admin';
$route['admin/panel-control'] = 'AdminController/panel_control';
# - usuarios
$route['admin/panel-control/usuarios'] = 'AdminController/listado_usuarios';
$route['admin/nuevo-usuario'] = "FormController/registro_admin";
$route['admin/registrar-usuario'] = 'AdminController/registrar_nuevo_usuario';
$route['editar-usuario/(:num)'] = 'FormController/editar_admin';
$route['actualizar-usuario'] = 'AdminController/actualizar_usuario';
$route['admin/eliminar-usuario/(:num)'] = 'AdminController/eliminar_usuario';

# - post
$route['admin/panel-control/post'] = 'AdminController/listado_post';

# - comentarios
$route['admin/panel-control/comentarios'] = 'AdminController/listado_comentarios';




$route['default_controller'] = 'UserController/index';
$route['404_override'] = 'UserController/error_404';
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

    