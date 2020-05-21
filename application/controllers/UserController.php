<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		if(!empty($datos)){
			$datos['title'] = 'Información de usuario';
			$vista = array(
				'vista' =>  $datos['rol'] == 'administrador' ? 'admin/index.php' : 'web/index.php',
				'params' => $datos,
				'layout' => 'ly_session.php',
				'titulo' => 'Estás logueado',
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
				'vista' => 'web/index.php',
				'params' => $datos,
				'layout' => 'ly_home.php',
				'titulo' => 'Inicio - ARGaming',
			);

			$this->layouts->view($vista);
		}	
	}

	public function prueba_form(){

		$datos = array();

		$vista = array(
			'vista' => 'web/prueba_form.php',
			'params' => $datos,
			'layout' => 'ly_home_basico.php',
			'titulo' => 'Añadir nuevo usuario',
		);

		$this->layouts->view($vista);
	}

	public function registro_usuario()
	{

		$datos = array();

		$vista = array(
			'vista' => 'web/nuevo_usuario.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Añadir nuevo usuario',
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

	public function juegos(){
		
		//$titulo = 'LISTADO DE VIDEOJUEGOS';

		//Leemos los datos recibidos en formato json
		$json = file_get_contents('https://videojuegos.fandom.com/api/v1/Search/List?query=dead&limit=10&minArticleQuality=10&batch=1&namespaces=0%2C14');

		//Se "decodifican" del formato json y se almacenan en un array, los "items" que básicamente es el array que contiene los datos sobre los videojuegos
		$juegos = json_decode($json, true);

		//$long_array = count($juegos['items']);

		$datos = array(
			'juegos' => $juegos['items'],
		);
		
		//debug($datos);
		//echo "**".$datos['posts'][0]['display_name']."**";
		
		$vista = array(
			'vista' => 'web/listado-videojuegos.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Videojuegos',
		);

		$this->layouts->view($vista);
		
	}

	public function post(){

		$titulo = 'LISTADO DE POST';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/index.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Post',
		);

		$this->layouts->view($vista);
	}

	public function contacto(){

		$titulo = 'FORMULARIO DE CONTACTO';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/contacto.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Contacto',
		);

		$this->layouts->view($vista);
	}

	public function aviso_legal(){

		$titulo = 'POLITICA DE COOKIES';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/aviso-legal.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Aviso legal',
		);

		$this->layouts->view($vista);
	}

	public function politica_cookies(){

		$titulo = 'POLITICA DE COOKIES';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/politica-cookies.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Política de cookies',
		);

		$this->layouts->view($vista);
	}

	public function politica_privacidad(){

		$titulo = 'POLITICA DE PRIVACIDAD';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/politica-privacidad.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Política de privacidad y RGPD',
		);

		$this->layouts->view($vista);
	}

	public function creador_blog(){

		$titulo = 'Portafolio del creador';

		$datos = array(
			'title' => $titulo
		);

		$vista = array(
			'vista' => 'web/creador-blog.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Creador del blog',
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