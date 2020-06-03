         <?php
		defined('BASEPATH') or exit('No direct script access allowed');

		class UserController extends CI_Controller
		{

			function __construct()
			{
				parent::__construct();

				$this->load->model('FrontEndModel', 'FrontEndModel');
			}

			public function index()
			{
				/* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
				$datos = comprobar_login();
				if (!empty($datos)) {
					$datos['title'] = 'No hay post disponibles en este momento, disculpe las molestias';
					$vista = array(
						'vista' =>  $datos['rol'] == 'administrador' ? 'admin/index.php' : 'web/index.php',
						'params' => $datos,
						'layout' => 'ly_session.php',
						'titulo' => 'Inicio - logueado'
					);
					$this->layouts->view($vista);
				} else { // si no estuviera logueado muestra la página de inicio con normalidad, quitando ciertas opciones de la cabecera
					// $posts = $this->FrontEndModel->list_all_posts();

					$datos = array(
						//'posts' => $posts,
						'title' => 'No hay post disponibles en este momento, disculpe las molestias.'
					);

					//debug($datos);
					//echo "**".$datos['posts'][0]['display_name']."**";

					$vista = array(
						'vista' => 'web/index.php',
						'params' => $datos,
						'layout' => 'ly_home.php',
						'titulo' => 'Inicio - ARGaming'
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
			/*
	public function cargar_pagina($pag,$datos,$titulo){
		$verif = comprobar_login();
		$paginas = array(
			'inicio' => $verif['rol'] == 'administrador' ? 'admin/index.php' : 'web/index.php',
			'login' => 'user/login.php',
			'perfil-usuario' => 'web/logueado.php',
			'creador' => 'web/creador-blog.php',
			'juegos' => 'web/listado-videojuegos.php',
			'post' => 'web/index.php',
			'aviso-legal' => 'web/aviso-legal.php',
			'politica-cookies' => 'web/politica-cookies.php',
			'politica-privacidad' => 'web/politica-privacidad.php'
		);

		$layout = array(
			'inicio' => '',
			'login' => 'ly_login.php',
			'perfil-usuario' => '',
			'creador' => '',
			'juegos' => '',
			'post' => '',
			'aviso-legal' => '',
			'politica-cookies' => '',
			'politica-privacidad' => ''
		);

		$pag = 'inicio';
		/* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper 
		$verif = comprobar_login();
		if(!empty($verif)){
			$datos['vacio'] = 'No hay post disponibles en este momento, disculpe las molestias';
			$vista = array(
				'vista' =>  $paginas[$pag],
				'params' => $datos,
				'layout' => $layout[$pag] == '' ? 'ly_session.php' : $layout[$pag],
				'titulo' => $titulo
			);
			$this->layouts->view($vista);
		} else {// si no estuviera logueado muestra la página de inicio con normalidad, quitando ciertas opciones de la cabecera
			// $posts = $this->FrontEndModel->list_all_posts();

			$datos = array(
				//'posts' => $posts,
				'title' => 'No hay post disponibles en este momento, disculpe las molestias.'
			);
			
			//debug($datos);
			//echo "**".$datos['posts'][0]['display_name']."**";
			
			$vista = array(
				'vista' => $paginas[$pag],
				'params' => $datos,
				'layout' => $layout[$pag] == '' ? 'ly_home.php' : $layout[$pag],
				'titulo' => $titulo
			);

			$this->layouts->view($vista);
		}	
	} */

			/*
	public function registro_usuario()
	{

		$datos = array();

		$vista = array(
			'vista' => 'web/nuevo_usuario.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Añadir nuevo usuario'
		);

		$this->layouts->view($vista);
	}

	public function registrar_nuevo_usuario()
	{
		foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}
		//debug($datos);

		if ($datos['password'] == $datos['password_confirm']){
			//Es necesario pasar la contraseña cifrada previamente, así que utilizamos la función md5 para cifrarla
			$datos['password'] = md5($datos['password']);
			unset($datos['password_confirm']);
		}
		
		//$datos['password'] = md5($datos['password']);
		
		//debug($datos);
		
		$this->BackEndModel->insert('usuarios', $datos);

		header('Location: /inicio');
	}
	*/

			public function juegos()
			{
				//Leemos los datos recibidos en formato json
				$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=dead&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

				//Se "decodifican" del formato json y se almacenan en un array, los "items" que básicamente es el array que contiene los datos sobre los videojuegos
				$juegos = json_decode($json, true);

				//Se almacenan los datos en el array para pasarselo a la vista que corresponda
				$datos = array(
					'juegos' => $juegos['items'],
				);

				//Tras obtener los datos que se van a mostrar, se comprueba si hay una sesión abierta por parte del usuario
				$verif = comprobar_login();

				//debug($verif);

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
				$posts = $this->FrontEndModel->Lista('post', 'id_post');

				//Se almacenan los datos en el array para pasarselo a la vista que corresponda
				$datos = array(
					'posts' => $posts,
				);
				//debug($datos);
				//Tras obtener los datos que se van a mostrar, se comprueba si hay una sesión abierta por parte del usuario
				$verif = comprobar_login();

				if (!empty($verif)) {

					$datos['rol'] = $verif['rol'];

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
				$post = $this->FrontEndModel->Listar_post($where['id_post']);//info del post
				$autor = $this->FrontEndModel->Buscar('usuarios', 'id_usuario', $post[0]['id_usuario']);//info autor post
				$comentarios = $this->FrontEndModel->Listar_comentarios($where['id_post']);//listado de comentarios de este post

				$datos = array(
					'post' => $post,
					'autor' => $autor,
					'comentarios' => $comentarios,
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
							'titulo' => 'Post '.$datos['post']['0']['id_post']
						);

						$this->layouts->view($vista);
					} else {

						$vista = array(
							'vista' => 'web/post.php',
							'params' => $datos,
							'layout' => 'ly_home.php',
							'titulo' => 'Post '.$datos['post']['0']['id_post']
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
							'titulo' => 'Post '.$datos['post']['0']['id_post']
						);

						$this->layouts->view($vista);
					} else {

						$vista = array(
							'vista' => 'web/post.php',
							'params' => $datos,
							'layout' => 'ly_home.php',
							'titulo' => 'Post '.$datos['post']['0']['id_post']
						);

						$this->layouts->view($vista);
					}
				}
			}

			public function agregar_comentarios($datos_nuevos)
			{
				//$comentario['id_post'] = $datos_nuevos['id_post'];
				$comentario['id_usuario'] = $datos_nuevos['id_usuario'];
				$comentario['texto'] = $datos_nuevos['texto'];

				debug($comentario);

				//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
				//unset($comentarios['id']);

				$this->BackEndModel->insertar('comentarios', $comentario);

				header('Location: /post/' . $datos_nuevos['id_post']);
			}
			/*
	public function contactar(){

		$titulo = 'FORMULARIO DE CONTACTO';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/contacto.php',
			'params' => $datos,
			'layout' => 'ly_contacto.php',
			'titulo' => 'Contacto'
		);

		$this->layouts->view($vista);
	}
	*/

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




			/*
    public function post()
    {
        $post_id = $this->uri->segment(2);
        $post = $this->FrontEndModel->list_one_post($post_id);

        $datos = array(
            'post' => $post
        );

		//Si no tiene autor lo muestra como anónimo
		if($datos['post'][0]['display_name'] == ''){
			$datos['post'][0]['display_name'] = 'Anónimo';
		}
		//debug($datos);
		//echo "**".$datos['post'][0]['display_name']."**";
		
		$vista = array(
			'vista' => 'web/post.php',
			'params' => $datos,
			'layout' => 'ly_blog.php',
			'titulo' => 'Página de post',
		);

		$this->layouts->view($vista);
    }

    public function autor()
    {
        $author_id = $this->uri->segment(2);
        $post = $this->FrontEndModel->list_all_posts_by_author($author_id);

        $datos = array(
            'posts' => $post
        );

		$vista = array(
			'vista' => 'web/author.php',
			'params' => $datos,
			'layout' => 'ly_blog.php',
			'titulo' => 'Página de autor',
		);

		$this->layouts->view($vista);

	}
	*/
		}
