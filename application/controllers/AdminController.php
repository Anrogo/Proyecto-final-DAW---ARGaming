<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('BackEndModel', 'BackEndModel');
	}
	public function index()
	{
		/* El inicio de sesión se verifica en la funcion comprobar_login(), ubicada en utiles_helper */
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {
			$vista = array(
				'vista' => 'web/index.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Inicio',
			);

			$this->layouts->view($vista);
		} else { //si no se consigue verificar correctamente, te manda al inicio
			header("Location: /");
		}
	}
	public function panel_control()
	{
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {
			$vista = array(
				'vista' => 'admin/listados.php',
				'params' => $datos,
				'layout' => 'ly_admin.php',
				'titulo' => 'Administración',
			);
			$this->layouts->view($vista);
		} else {
			header("Location: /error ");
		}
	}
	public function perfil_admin()
	{
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {
			//debug($datos);

			$vista = array(
				'vista' => 'admin/perfil_admin.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Usuario logueado',
			);

			$this->layouts->view($vista);
		} else {

			header("Location: /error ");
		}
	}
	public function listado_juegos()
	{
		//Leemos los datos recibidos en formato json
		$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=dead&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

		//Se "decodifican" del formato json y se almacenan en un array, los "items" que básicamente es el array que contiene los datos sobre los videojuegos
		$juegos = json_decode($json, true);

		//Se almacenan los datos en el array para pasarselo a la vista que corresponda
		$datos = array(
			'juegos' => $juegos['items'],
		);
		//debug($datos);
		$verif = comprobar_login();

		if (!empty($verif) && $verif['rol'] == 'administrador') {
			$datos['rol'] = $verif['rol'];
			$vista = array(
				'vista' => 'admin/listado-videojuegos.php',
				'params' => $datos,
				'layout' => 'ly_admin.php',
				'titulo' => 'Videojuegos - Admin'
			);

			$this->layouts->view($vista);
		} else {

			$vista = array(
				'vista' => 'web/listado-videojuegos.php',
				'params' => $datos,
				'layout' => 'ly_home.php',
				'titulo' => 'Videojuegos'
			);

			$this->layouts->view($vista);
		}
	}
	public function listado_usuarios()
	{
		$verif = comprobar_login();
		//debug($this->uri);
		if (!empty($verif) && $verif['rol'] == 'administrador') {

			$datos['rol'] = $verif['rol'];

			if (!empty($this->input->post('buscar'))) { //si se realiza cualquier búsqueda, pasa primero por aquí
				$cadena = $this->input->post('buscar');
				$info = $this->BackEndModel->busqueda_usuarios($cadena);
				//debug($info);

				if (!empty($info)) { //si se encuentran registros coincidentes, se devuelven
					$datos['busqueda'] = $cadena;
					$datos['usuarios'] = $info;
				} else { //si se busca pero no se encuentra, lo comunica
					$datos['busqueda'] = $cadena;
					$datos['resultado'] = 'No se han encontrado resultados';
				}
			} else { //si no se ha realizado ninguna búsqueda simplemente muestra todos los registros diponibles

				if ($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc') {
					if ($this->uri->segment(5) == 'asc') { //si se ha solicitado que sea asc se le pasa una consulta a la tabla ordenando de forma ascendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$info = $this->BackEndModel->Lista('usuarios', $filtro, 'asc');
					}
					if ($this->uri->segment(5) == 'desc') { //si se ha solicitado que sea desc se le pasa una consulta a la tabla ordenando de forma descendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$info = $this->BackEndModel->Lista('usuarios', $filtro, 'desc');
					}
				} else { //por defecto muestre a partir de los id como 'asc'
					$info = $this->BackEndModel->Lista('usuarios', 'id_usuario');
				}
				$datos['usuarios'] = $info;
				//debug($info);
			}
			//debug($datos);
			$vista = array(
				'vista' => 'admin/listado_usuarios.php',
				'params' => $datos,
				'layout' => 'ly_admin.php',
				'titulo' => 'Usuarios',
			);
			$this->layouts->view($vista);
		} else {

			header("Location: /error ");
		}
	}
	public function eliminar_usuario()
	{
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {
			//debug($this->uri);

			$where['id_usuario'] = $this->uri->segment(3);

			$this->BackEndModel->delete('usuarios', $where);

			header('Location: /admin/panel-control/usuarios');
		} else {

			header('Location: /error');
		}
	}
	public function listado_post()
	{
		$verif = comprobar_login();

		if (!empty($verif) && $verif['rol'] == 'administrador') {

			$datos['rol'] = $verif['rol'];

			if (!empty($this->input->post('buscar'))) { //si se realiza cualquier búsqueda, pasa primero por aquí
				$cadena = $this->input->post('buscar');
				$posts = $this->BackEndModel->busqueda_post($cadena);
				//debug($info);

				if (!empty($posts)) { //si se encuentran registros coincidentes, se devuelven
					$datos['busqueda'] = $cadena;
					$datos['posts'] = $posts;
				} else { //si se busca pero no se encuentra, lo comunica
					$datos['busqueda'] = $cadena;
					$datos['resultado'] = 'No se han encontrado resultados';
				}
			} else { //si no se ha realizado ninguna búsqueda simplemente muestra todos los registros diponibles

				if ($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc') {
					if ($this->uri->segment(5) == 'asc') { //si se ha solicitado que sea asc se le pasa una consulta a la tabla ordenando de forma ascendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$posts = $this->BackEndModel->Filtrar_post($filtro, 'asc');
					}
					if ($this->uri->segment(5) == 'desc') { //si se ha solicitado que sea desc se le pasa una consulta a la tabla ordenando de forma descendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$posts = $this->BackEndModel->Filtrar_post($filtro, 'desc');
					}
				} else { //por defecto muestre a partir de los id como 'asc'
					$posts = $this->BackEndModel->Listado_post_y_usuarios();
				}

				$datos['posts'] = $posts;
			}
			//debug($datos);
			$vista = array(
				'vista' => 'admin/lista-post.php',
				'params' => $datos,
				'layout' => 'ly_admin.php',
				'titulo' => 'Lista de post'
			);
			$this->layouts->view($vista);
		} else {

			header("Location: /error ");
		}
	}
	public function eliminar_post()
	{
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {

			$where['id_post'] = $this->uri->segment(3);

			$this->BackEndModel->delete('post', $where);

			header('Location: /admin/panel-control/post');
		} else {

			header('Location: /error');
		}
	}
	public function listado_comentarios()
	{
		$verif = comprobar_login();

		if (!empty($verif) && $verif['rol'] == 'administrador') {

			$datos['rol'] = $verif['rol'];

			if (!empty($this->input->post('buscar'))) { //si se realiza cualquier búsqueda, pasa primero por aquí
				$cadena = $this->input->post('buscar');
				$comentarios = $this->BackEndModel->busqueda_comentarios($cadena);
				//debug($info);

				if (!empty($comentarios)) { //si se encuentran registros coincidentes, se devuelven
					$datos['busqueda'] = $cadena;
					$datos['comentarios'] = $comentarios;
				} else { //si se busca pero no se encuentra, lo comunica
					$datos['busqueda'] = $cadena;
					$datos['resultado'] = 'No se han encontrado resultados';
				}
			} else { //si no se ha realizado ninguna búsqueda simplemente muestra todos los registros diponibles

				if ($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc') {
					if ($this->uri->segment(5) == 'asc') { //si se ha solicitado que sea asc se le pasa una consulta a la tabla ordenando de forma ascendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$comentarios = $this->BackEndModel->Listado_comentarios_post_y_usuarios($filtro, 'asc');
					}
					if ($this->uri->segment(5) == 'desc') { //si se ha solicitado que sea desc se le pasa una consulta a la tabla ordenando de forma descendente
						$filtro = explode('-', $this->uri->segment(4))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
						$comentarios = $this->BackEndModel->Listado_comentarios_post_y_usuarios($filtro, 'desc');
					}
				} else { //por defecto muestre a partir de los id como 'asc'
					$comentarios = $this->BackEndModel->Listado_comentarios_post_y_usuarios('id_comentario','asc');
				}
				
				$datos['comentarios'] = $comentarios;
				//debug($info);
			}
			//debug($datos);
			$vista = array(
				'vista' => 'admin/lista-comentarios.php',
				'params' => $datos,
				'layout' => 'ly_admin.php',
				'titulo' => 'Lista de comentarios'
			);
			$this->layouts->view($vista);
		} else {

			header("Location: /error ");
		}
	}
	public function eliminar_comentario()
	{
		$datos = comprobar_login();

		if (!empty($datos) && $datos['rol'] == 'administrador') {

			$where['id_comentario'] = $this->uri->segment(3);

			$this->BackEndModel->delete('comentarios', $where);

			header('Location: /admin/panel-control/comentarios');
		} else {

			header('Location: /error');
		}
	}
}