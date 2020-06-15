<?php
defined('BASEPATH') OR exit('No direct script access allowed');


# RUTAS PARA TODOS LOS USUARIOS
$route['/'] = "UserController/index";//de todas formas, coge la ruta por defecto
$route['lista-juegos'] = "UserController/juegos";
$route['lista-post'] = "UserController/post";
$route['post/(:num)'] = "UserController/ver_post";
$route['post/(:num)/agregar-comentario'] = 'UserController/ver_post';
$route['nuevo-post'] = 'FormController/nuevo_post';
$route['responder-comentario/(:num)'] = 'FormController/responder_comentario';
$route['contacto'] = "FormController/contactar";
$route['contacto/enviar-email/(:any)'] = "EmailController/enviar/$1";
$route['creador-blog'] = "UserController/creador_blog";
$route['aviso-legal'] = "UserController/aviso_legal";
$route['politica-cookies'] = "UserController/politica_cookies";
$route['politica-privacidad'] = "UserController/politica_privacidad";
$route['cambiar-password'] = 'UserController/cambiar_contraseña_sin_acceso';
$route['usuario/(:num)'] = 'UserController/datos_usuario';
$route['autores'] = 'UserController/autores_post';

# COOKIES
$route['aceptar-cookies'] = 'CookieController/set';
$route['comprobar-cookies'] = 'CookieController/get';
$route['borrar-cookies'] = 'CookieController/delete';


# LOGIN
$route['login'] = 'LoginController/login';
$route['login2'] = 'LoginController/login2';
$route['login/error'] = 'LoginController/login';
$route['login/no-registrado'] = 'LoginController/login';
$route['registro'] = "FormController/registro";
$route['inicio'] = 'LoginController/inicio_logueado';

# USUARIO
$route['perfil-usuario'] = 'LoginController/perfil_usuario';
$route['usuario/editar-perfil/(:num)'] = 'FormController/editar_perfil';
$route['usuario/cambiar-password/(:num)'] = 'FormController/cambiar_contraseña';
$route['usuario/cerrar-sesion'] = 'LoginController/cerrar_sesion';

# ADMIN
$route['admin'] = 'AdminController/index';
$route['admin/inicio'] = 'AdminController/index';
$route['admin/perfil-admin'] = 'AdminController/perfil_admin';
$route['admin/panel-control'] = 'AdminController/panel_control';

# Admin - juegos
$route['admin/panel-control/juegos'] = 'AdminController/listado_juegos';

# Admin - usuarios
$route['admin/panel-control/usuarios'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-username/desc'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-username/asc'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-nombre/desc'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-nombre/asc'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-modificado/desc'] = 'AdminController/listado_usuarios';
$route['admin/panel-control/usuarios/ordenar-modificado/asc'] = 'AdminController/listado_usuarios';
$route['admin/buscar-usuario'] = 'AdminController/listado_usuarios';
$route['admin/nuevo-usuario'] = "FormController/registro_admin";
$route['admin/registrar-usuario'] = 'AdminController/registrar_nuevo_usuario';
$route['admin/editar-usuario/(:num)'] = 'FormController/editar_admin';
$route['actualizar-usuario'] = 'AdminController/actualizar_usuario';
$route['admin/eliminar-usuario/(:num)'] = 'AdminController/eliminar_usuario';

# Admin - post
$route['admin/panel-control/post'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-creado/desc'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-creado/asc'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-modificado/desc'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-modificado/asc'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-visitas/desc'] = 'AdminController/listado_post';
$route['admin/panel-control/post/ordenar-visitas/asc'] = 'AdminController/listado_post';
$route['admin/buscar-post'] = 'AdminController/listado_post';
$route['admin/nuevo-post'] = "FormController/nuevo_post_admin";
$route['admin/crear-post'] = 'AdminController/registrar_nuevo_post';
$route['admin/editar-post/(:num)'] = 'FormController/editar_post_admin';
$route['actualizar-post'] = 'AdminController/actualizar_post';
$route['admin/eliminar-post/(:num)'] = 'AdminController/eliminar_post';

# Admin - comentarios
$route['admin/panel-control/comentarios'] = 'AdminController/listado_comentarios';
$route['admin/panel-control/comentarios/ordenar-creado/asc'] = 'AdminController/listado_comentarios';
$route['admin/panel-control/comentarios/ordenar-creado/desc'] = 'AdminController/listado_comentarios';
$route['admin/buscar-comentario'] = 'AdminController/listado_comentarios';
$route['admin/nuevo-comentario'] = "FormController/nuevo_comentario_admin";
$route['admin/registrar-comentario'] = 'AdminController/registrar_comentario';
$route['admin/responder-comentario/(:num)'] = 'FormController/responder_comentario_admin';
$route['actualizar-comentario'] = 'AdminController/actualizar_comentario';
$route['admin/eliminar-comentario/(:num)'] = 'AdminController/eliminar_comentario';

# Otras rutas
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

    