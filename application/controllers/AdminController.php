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

		$datos = array();

		$vista = array(
			'vista' => 'admin/index.php',
			'params' => $datos,
			'layout' => 'ly_admin.php',
			'titulo' => 'Inicio',
		);

		$this->layouts->view($vista);
	}

	public function panel_control()
	{
		if ($this->session->userdata('logueado')) {
            $datos = array();
            $datos['nombre'] = $this->session->userdata('nombre');
            $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario normal';
            $vista = array(
                'vista' => 'admin/inicio.php',
                'params' => $datos,
                'layout' => 'ly_admin.php',
                'titulo' => 'Administración',
            );
			$this->layouts->view($vista);
		}
	}

	public function registro()
	{
		$datos = array();

		$vista = array(
			'vista' => 'admin/new_autor.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página de registro',
		);

		$this->layouts->view($vista);
		
	}

	public function add_autor()
	{
		/*Ponemos los datos que llegan en el post 
		 en formato array antes de pasarlo al modelo */
		foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}

		if (isset($datos['enabled'])) {
			$datos['enabled'] = 1;
		} else {
			$datos['enabled'] = 0;
		}
		//debug($datos);
		$datos['password'] = md5($datos['password']);
		$this->BackEndModel->insert('authors', $datos);

		//echo "INSERCIÓN DE NUEVO AUTOR COMPLETADA";
		header('Location: /autores');
	}

	public function list()
	{

		$posts = $this->BackEndModel->ListPosts();

		//debug($posts);

		$datos = array(
			'posts' => $posts
		);

		$vista = array(
			'vista' => 'admin/index.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página listado de post',
		);

		$this->layouts->view($vista);
	}

	public function new_post()
	{
		$authors = $this->BackEndModel->ListAuthors();
		$datos = array(
			'authors' => $authors
		);

		$vista = array(
			'vista' => 'admin/new_post.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página de Login',
		);

		$this->layouts->view($vista);
	}

	public function add()
	{
		/*Ponemos los datos que llegan en el post 
		 en formato array antes de pasarlo al modelo */
		foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}

		if (isset($datos['enabled'])) {
			$datos['enabled'] = 1;
		} else {
			$datos['enabled'] = 0;
		}
		//debug($datos);
		$this->BackEndModel->insert('posts', $datos);

		//echo "INSERCIÓN DE NUEVO POST COMPLETADA";
		header('Location: /list');
	}

	public function autores()
	{
		$authors = $this->BackEndModel->ListAuthors();
		$datos = array(
			'authors' => $authors
		);

		$vista = array(
			'vista' => 'admin/list_autores.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página de autores',
		);

		$this->layouts->view($vista);
	}

	public function edit()
	{
		//debug($this->uri);
		$post = $this->BackEndModel->ListOnePost($this->uri->segment(2));

		$authors = $this->BackEndModel->ListAuthors();
		
		$datos = array(
			'post' => $post['data'],
			'authors' => $authors
		);

		$vista = array(
			'vista' => 'admin/edit_post.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página para editar los post',
		);

		$this->layouts->view($vista);
	}

	public function update()
	{
		 foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}

		if (isset($datos['enabled'])) {
			$datos['enabled'] = 1;
		} else {
			$datos['enabled'] = 0;
		}

		$where['id'] = $datos['id'];
		//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
		unset( $datos['id']);
		
		$this->BackEndModel->update('posts', $datos, $where);
		
		header('Location: /list');
	}

	public function edit_autor()
	{
		//debug($this->uri);
		$author = $this->BackEndModel->ListOneAuthor($this->uri->segment(2));
	
		$datos = array(
			'autor' => $author['data']
		);

		$vista = array(
			'vista' => 'admin/edit_author.php',
			'params' => $datos,
			'layout' => 'ly_home.php',
			'titulo' => 'Página para editar los autores',
		);

		$this->layouts->view($vista);
	}

	public function update_autor()
	{
		 foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
		}

		if (isset($datos['enabled'])) {
			$datos['enabled'] = 1;
		} else {
			$datos['enabled'] = 0;
		}

		$where['id'] = $datos['id'];
		//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
		unset( $datos['id']);
		
		$this->BackEndModel->update('authors', $datos, $where);
		
		header('Location: /autores');
	}

	public function delete()
	{
		$where['id'] = $this->uri->segment(2);
		
		$this->BackEndModel->delete('posts', $where);

		header('Location: /list');
	}

	public function delete_autor()
	{
		$where['id'] = $this->uri->segment(2);
		
		$this->BackEndModel->delete('authors', $where);

		header('Location: /autores');
	}
}
