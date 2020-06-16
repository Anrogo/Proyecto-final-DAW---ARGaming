<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('FrontEndModel', 'FrontEndModel');
		$this->load->model('BackEndModel', 'BackEndModel');
	}
	public function index()
	{
		$posts = $this->FrontEndModel->Lista('post', 'visitas');
		//Se almacenan los datos en el array para pasarselo a la vista que corresponda
		$datos['posts'] = $posts;

		/* Mensaje de cookies: se comprueba si existe la cookie de nuestra web, en caso de que no exista se muestra el mensaje */

		if (!isset($_COOKIE['cookies_aceptadas'])) {

			$datos['cookies'] = '<p>Éste sitio web usa cookies, si permanece aquí acepta su uso.
			Puede leer más sobre el uso de cookies en nuestra <a href="/politica-privacidad">política de privacidad</a>
			<br>
			<a href="/aceptar-cookies"><button class="btn btn-primary mt-3">Aceptar y cerrar  <i class="fa fa-times"></i></button></a>
			</p>';
		}

		//debug($datos);
		/*Tras obtener los datos que se van a mostrar, 
		se comprueba si hay una sesión abierta por parte del usuario*/
		$verif = comprobar_login();
		if (!empty($verif)) {
			$datos['rol'] = $verif['rol'];
			$vista = array(
				'vista' => 'web/index.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Inicio'
			);
			$this->layouts->view($vista);
		} else {
			$vista = array(
				'vista' => 'web/index.php',
				'params' => $datos,
				'layout' => 'ly_home.php',
				'titulo' => 'Inicio'
			);
			$this->layouts->view($vista);
		}
	}
	public function cambiar_contraseña_sin_acceso()
	{
		$datos = array();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation'); //llamamos a las reglas de validación
		$config = array(
			array(
				'field' => 'email',
				'label' => 'Correo',
				'rules' => 'trim|required|valid_email',
				'errors' => array(
					'required' => 'El %s es obligatorio',
					'valid_email' => 'El %s debe tener un formato válido'
				)
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == TRUE) {
			//Si la validación es correcta, y el correo está registrado en la plataforma, se manda al correo con una nueva contraseña al email solicitado
			foreach ($_POST as $key => $value) {
				$datos[$key] = $value;
			}
			$registro_correo = $this->FrontEndModel->Buscar('usuarios', 'email', $datos['email']);
			//debug($registro_correo);
			if ($registro_correo == null) {
				$datos['error'] = 'El correo ' . $datos['email'] . ' no está registrado en nuestra web. Vaya al apartado de registro y rellene sus datos por favor.';
				$vista = array(
					'vista' => 'web/cambiar-contraseña-sin-acceso.php',
					'params' => $datos,
					'layout' => 'ly_registro.php',
					'titulo' => 'Conseguir nueva credencial'
				);
				//debug($datos);
				$this->layouts->view($vista);
			} else {
				header('Location: /');
			}
		} else {
			$vista = array(
				'vista' => 'web/cambiar-contraseña-sin-acceso.php',
				'params' => $datos,
				'layout' => 'ly_registro.php',
				'titulo' => 'Conseguir nueva credencial'
			);
			$this->layouts->view($vista);
		}
	}
	public function datos_usuario()
	{
		$where['id_usuario'] = $this->uri->segment(2);

		$usuario = $this->FrontEndModel->Buscar('usuarios', 'id_usuario', $where['id_usuario']); //info del usuario si existe
		$posts = $this->FrontEndModel->Datos_autor_post($where['id_usuario']); //info de los post que ha creado el usuario

		if (!empty($usuario)) { //si existe el usuario se cargan los datos y se muestran en la vista
			$datos = array(
				'id_usuario' => $usuario[0]['id_usuario'],
				'username' => $usuario[0]['username'],
				'nombre' => $usuario[0]['nombre'],
				'apellidos' => $usuario[0]['apellidos'],
				'email' => $usuario[0]['email'],
				'rol' => $usuario[0]['rol'] == '1' ? 'administrador' : 'usuario estándar',
				'imagen_perfil' => $usuario[0]['imagen_perfil'],
				'posts' => $posts
			);
			//debug($datos);
			$verif = comprobar_login();
			if (!empty($verif)) {
				$vista = array(
					'vista' => 'web/usuario.php',
					'params' => $datos,
					'layout' => 'ly_session.php',
					'titulo' => 'Perfil de usuario'
				);
				$this->layouts->view($vista);
			} else {
				$vista = array(
					'vista' => 'web/usuario.php',
					'params' => $datos,
					'layout' => 'ly_home.php',
					'titulo' => 'Perfil de usuario'
				);
				$this->layouts->view($vista);
			}
		} else { //si no se localizan datos de ese usuario sería porque no existe y se devuelve error 
			header('Location: /error ');
		}
	}
	public function error_404()
	{
		$datos = array();
		//Cuando no se encuentre una ruta correcta redirigirá aquí:
		$vista = array(
			'vista' => 'web/error-404.php',
			'params' => $datos,
			'layout' => 'ly_admin_basico.php',
			'titulo' => 'Error 404'
		);
		$this->layouts->view($vista);
	}
	public function juegos()
	{
		if (!empty($this->input->post('buscar'))) { //si se realiza cualquier búsqueda, pasa primero por aquí

			$cadena = $this->input->post('buscar');
			$cadena = str_replace(' ', '', trim($cadena));
			//Leemos los datos recibidos en formato json, introduciendo la cadena pasada por post desde la barra de búsqueda
			$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=' . $cadena . '&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

			//Se "decodifican" del formato json y se almacenan en un array, los "items" que básicamente es el array que contiene los datos sobre los videojuegos
			$juegos = json_decode($json, true);

			if (!empty($juegos)) { //si se encuentran registros coincidentes, se devuelven
				$datos['etiqueta'] = $cadena;
				$datos['total'] = $juegos['total'];
				$datos['juegos'] = $juegos['items'];
			} else { //si se busca pero no se encuentra, lo comunica
				$datos['etiqueta'] = $cadena;
				$datos['total'] = 0;
				$datos['resultado'] = 'No se han encontrado resultados';
			}

		} else {
			$cadena = 'game';
			//Leemos los datos recibidos en formato json, introduciendo la cadena pasada por post desde la barra de búsqueda
			$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=' . $cadena . '&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

			//Se "decodifican" del formato json y se almacenan en un array, los "items" que básicamente es el array que contiene los datos sobre los videojuegos
			$juegos = json_decode($json, true);

			//Se almacenan los datos en el array para pasarselo a la vista que corresponda
			$datos['etiqueta'] = $cadena;
			$datos['juegos'] = $juegos['items'];
			$datos['total'] = $juegos['total'];
		}

		//Tras obtener los datos que se van a mostrar, se comprueba si hay una sesión abierta por parte del usuario
		$verif = comprobar_login();

		//debug($datos);

		if (!empty($verif)) {

			$datos['rol'] = $verif['rol'];

			$vista = array(
				'vista' => 'web/listado-videojuegos.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Videojuegos - logueado'
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
	public function post()
	{

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

			if ($this->uri->segment(3) == 'asc' || $this->uri->segment(3) == 'desc') {
				if ($this->uri->segment(3) == 'asc') { //si se ha solicitado que sea asc se le pasa una consulta a la tabla ordenando de forma ascendente
					$filtro = explode('-', $this->uri->segment(2))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
					$posts = $this->BackEndModel->Filtrar_post($filtro, 'asc');
				}
				if ($this->uri->segment(3) == 'desc') { //si se ha solicitado que sea desc se le pasa una consulta a la tabla ordenando de forma descendente
					$filtro = explode('-', $this->uri->segment(2))[1]; //el filtro será el campo a partir del cuál se ordenará y lo obtiene de la url
					$posts = $this->BackEndModel->Filtrar_post($filtro, 'desc');
				}
			} else { //por defecto muestre a partir de los id como 'asc'
				$posts = $this->BackEndModel->Listado_post_y_usuarios();
			}

			$datos['posts'] = $posts;
		}

		//Tras obtener los datos que se van a mostrar, se comprueba si hay una sesión abierta por parte del usuario
		$verif = comprobar_login();

		if (!empty($verif)) {

			$datos['rol'] = $verif['rol'];
			$datos['crear_post'] = '';

			$vista = array(
				'vista' => 'web/lista-post.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Post'
			);

			$this->layouts->view($vista);
		} else {

			$vista = array(
				'vista' => 'web/lista-post.php',
				'params' => $datos,
				'layout' => 'ly_home.php',
				'titulo' => 'Post'
			);

			$this->layouts->view($vista);
		}
	}
	public function ver_post()
	{
		//debug($this->uri);
		$where['id_post'] = $this->uri->segment(2);
		$post = $this->FrontEndModel->Listar_post($where['id_post']); //info del post si existe
		if (!empty($post)) { //si todo está bien, la variable post vuelve con información y actualizo las visitas a este en bbdd
			$this->FrontEndModel->actualizar_visitas_post($where['id_post']); //esta función actualiza las visitas de la tabla post con el id del post
			$autor = $this->FrontEndModel->Buscar('usuarios', 'id_usuario', $post['data'][0]['id_usuario']); //info autor post
			$comentarios = $this->FrontEndModel->Listar_comentarios($where['id_post']); //listado de comentarios de este post

			$datos = array(
				'post' => $post['data'],
				'autor' => $autor,
				'comentarios' => $comentarios['data']
			);

			//debug($datos);
			//Tras obtener los datos que se van a mostrar, se comprueba si hay una sesión abierta por parte del usuario
			$verif = comprobar_login();

			// Apartado de comentarios (solo aparecen errores o se envían datos si se interactua con ellos)
			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation'); //llamamos a las reglas de validación

			$config = array(
				array(
					'field' => 'comentario',
					'label' => 'comentario',
					'rules' => 'trim|required|max_length[500]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9:\'!¡?¿"%,.\s]+$/]',
					'errors' => array(
						'required' => 'El comentario debe contener algo',
						'max_length' => 'Los %s deben tener, como mucho, 500 caracteres de longitud',
						'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos y algunos símbolos puntuales.'
					),
				),
				array(
					'field' => 'email',
					'label' => 'correo',
					'rules' => 'trim|required|valid_email',
					'errors' => array(
						'required' => 'El correo es obligatorio',
						'valid_email' => 'El correo debe tener un formato válido'
					),
				)
			);

			$this->form_validation->set_rules($config);
			//debug($_POST);
			if ($this->form_validation->run() == TRUE) {

				$datos_nuevos = array();

				foreach ($_POST as $key => $value) {
					$datos_nuevos[$key] = $value;
					if ($datos_nuevos[$key] == null) {
						unset($datos_nuevos[$key]);
					}
				}

				$datos_usuario = $this->FrontEndModel->Buscar('usuarios', 'email', $datos_nuevos['email']);

				//Tras verificar que el usuario existe se inserta
				if (!empty($datos_usuario)) {
					//agregar_comentarios($datos_nuevos);//esta función añade el comentario
					$comentario['id_post'] = $datos['post']['0']['id_post'];
					$comentario['id_usuario'] = $datos_usuario[0]['id_usuario'];
					$comentario['texto'] = $datos_nuevos['comentario'];

					//debug($comentario);

					//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
					//unset($comentarios['id']);

					$this->FrontEndModel->insert('comentarios', $comentario);

					//header('Location: /post/' . $datos_nuevos['id_post']);
				} else {
					//No está registrado, hay que decírselo y darle la opción de hacerlo desde ahí con un enlace
					$datos['usuario_no_registrado'] = '<div class="error"><svg class="bi bi-exclamation-diamond-fill mr-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 00-.9.995l.35 3.507a.552.552 0 001.1 0l.35-3.507A.905.905 0 008 4zm.002 6a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
						</svg>No está registrado, puede hacerlo desde <a href="/registro">aquí</a></div>';
				}

				//Información que se muestra en la vista (en cualquier caso)
				if (!empty($verif)) {

					$datos['rol'] = $verif['rol'];

					$vista = array(
						'vista' => 'web/post.php',
						'params' => $datos,
						'layout' => 'ly_session.php',
						'titulo' => 'Post ' . $datos['post']['0']['id_post']
					);

					$this->layouts->view($vista);
				} else {

					$vista = array(
						'vista' => 'web/post.php',
						'params' => $datos,
						'layout' => 'ly_home.php',
						'titulo' => 'Post ' . $datos['post']['0']['id_post']
					);

					$this->layouts->view($vista);
				}
			} else {


				//Información que se muestra en la vista (en cualquier caso)
				if (!empty($verif)) {

					$datos['rol'] = $verif['rol'];

					$vista = array(
						'vista' => 'web/post.php',
						'params' => $datos,
						'layout' => 'ly_session.php',
						'titulo' => 'Post ' . $datos['post']['0']['id_post']
					);

					$this->layouts->view($vista);
				} else {

					$vista = array(
						'vista' => 'web/post.php',
						'params' => $datos,
						'layout' => 'ly_home.php',
						'titulo' => 'Post ' . $datos['post']['0']['id_post']
					);

					$this->layouts->view($vista);
				}
			}
		} else {
			header('Location: /error');
		}
	}
	public function autores_post()
	{

		$autores = $this->FrontEndModel->Autores_post();

		$datos = array(
			'autores' => $autores
		);
		//debug($datos);
		$verif = comprobar_login();
		if (!empty($verif)) {
			$datos['rol'] = $verif['rol'];
			$vista = array(
				'vista' => 'web/autores.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Autores'
			);
			$this->layouts->view($vista);
		} else {
			$vista = array(
				'vista' => 'web/autores.php',
				'params' => $datos,
				'layout' => 'ly_home.php',
				'titulo' => 'Autores'
			);
			$this->layouts->view($vista);
		}
	}
	public function aviso_legal()
	{

		$titulo = 'POLITICA DE COOKIES';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/aviso-legal.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Aviso legal'
		);

		$this->layouts->view($vista);
	}
	public function politica_cookies()
	{

		$titulo = 'POLITICA DE COOKIES';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/politica-cookies.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Política de cookies'
		);

		$this->layouts->view($vista);
	}
	public function politica_privacidad()
	{

		$titulo = 'POLITICA DE PRIVACIDAD';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/politica-privacidad.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Política de privacidad y RGPD'
		);

		$this->layouts->view($vista);
	}
	public function creador_blog()
	{

		$titulo = 'Portafolio del creador';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/creador-blog.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Creador del blog'
		);

		$this->layouts->view($vista);
	}
	public function agregar_comentarios($datos_nuevos)
	{
		//$comentario['id_post'] = $datos_nuevos['id_post'];
		$comentario['id_usuario'] = $datos_nuevos['id_usuario'];
		$comentario['texto'] = $datos_nuevos['texto'];

		//debug($comentario);

		//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
		//unset($comentarios['id']);

		$this->BackEndModel->insertar('comentarios', $comentario);

		header('Location: /post/' . $datos_nuevos['id_post']);
	}
	public function novedades()
	{
		$datos = array();

		$verif = comprobar_login();

		if (($this->uri->segment(3) !== null) && ($this->uri->segment(3) == '1' || $this->uri->segment(3) == '2' || $this->uri->segment(3) == '3')) {
			//Post al que debemos redirigir:
			$num_post = intval($this->uri->segment(3));

			//Titulos de los post:
			$titulos = ['PS5 vs XBOX series X', 'Silent Hill aparecerá en DbD', 'Novedades de Call of Duty'];

			if (!empty($verif)) {
				
				$datos['rol'] = $verif['rol'];
				
				$vista = array(
					'vista' => 'web/novedades-' . $num_post . '.php',
					'params' => $datos,
					'layout' => 'ly_session.php',
					'titulo' => $titulos[$num_post - 1]
				);
				$this->layouts->view($vista);
			} else {
				
				$vista = array(
					'vista' => 'web/novedades-' . $num_post . '.php',
					'params' => $datos,
					'layout' => 'ly_home.php',
					'titulo' => $titulos[$num_post - 1]
				);
				$this->layouts->view($vista);
			}
		} else {

			if (!empty($verif)) {

				$datos['rol'] = $verif['rol'];

				$vista = array(
					'vista' => 'web/post-novedades.php',
					'params' => $datos,
					'layout' => 'ly_session.php',
					'titulo' => 'Novedades'
				);

				$this->layouts->view($vista);

			} else {

				$vista = array(
					'vista' => 'web/post-novedades.php',
					'params' => $datos,
					'layout' => 'ly_home.php',
					'titulo' => 'Novedades'
				);

				$this->layouts->view($vista);
			}
		}
	}
}
