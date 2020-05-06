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


	public function juegos(){
		
		$titulo = 'LISTADO DE VIDEOJUEGOS';

		$datos = array(
			'title' => $titulo
		);
		
		//debug($datos);
		//echo "**".$datos['posts'][0]['display_name']."**";
		
		$vista = array(
			'vista' => 'web/index.php',
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
			'vista' => 'web/index.php',
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