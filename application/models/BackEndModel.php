<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BackEndModel extends CI_Model
{
  # Variable donde se guarda la conexión a la base de datos
  private $db = null;

  function __construct()
  {

    parent::__construct();

    # Cargamos la conexión a la base de datos
    $this->db = $this->load->database('default', true);

  }

   # Ejecuta consultas y devuelte los resultados en un array
  public function ExecuteArrayResults( $sql)
  {
    $query = $this->db->query( $sql);
    $rows = $query->result_array();
    $query->free_result();

    return ( $rows);
  }

  public function ExecuteResultsParamsArray( $sql, $params)
  {

    $query = $this->db->query( $sql, $params);
    $rows['data'] = $query->result_array();
    $query->free_result();

    return ( $rows);
  }

  # Ejecuta querys sin devolver resultados deletes, inserts o updates
  public function Execute( $sql)
  {
    $this->db->query( $sql);
  }

  public function insert( $tabla, $datos)
  {
    $this->db->insert( $tabla, $datos);
  }

  public function update( $tabla, $datos, $WHERE)
  {
    $this->db->update( $tabla, $datos, $WHERE); 
  }

  public function delete( $tabla, $WHERE)
  {
    $this->db->delete( $tabla, $WHERE);
  }

  # Método para validar el email y contraseña que nos han pasado desde el formulario
  public function login( $datos)
  {
/*
    $sql = "SELECT * FROM usuarios WHERE username = '".$datos['username']."' And password = '".$datos['password']."'";
    return ( $this->ExecuteArrayResults( $sql ));
*/
    $sql = "SELECT * FROM usuarios WHERE username =  ?  And password =  ? ";
    $params = array( $datos['username'],$datos['password']);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  public function Lista($tabla,$filtro,$orden = null)
  {

    $sql = "SELECT * FROM $tabla order by $filtro $orden";
    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function ListarPost( $post_id)
  {
    $sql = "SELECT * FROM post WHERE id_post = ?";
    $params = array( $post_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  public function Listado_post_y_usuarios()
  {
    $sql = "SELECT post.id_post,post.id_usuario,post.titulo,post.imagen_post,post.contenido,post.slug,post.creado,post.modificado,post.visitas,post.estado,
    usuarios.username
    FROM post,usuarios
    WHERE post.id_usuario = usuarios.id_usuario";

    return ( $this->ExecuteArrayResults( $sql ));
  }

  public function Filtrar_post($filtro,$orden = null)
  {

    $sql = "SELECT post.id_post,post.id_usuario,post.titulo,post.imagen_post,post.contenido,post.slug,post.creado,post.modificado,post.visitas,post.estado,
    usuarios.username
    FROM post,usuarios
    WHERE post.id_usuario = usuarios.id_usuario
    ORDER BY $filtro $orden ";
    return ( $this->ExecuteArrayResults( $sql ));
  }

   # Método para mostrar todos los comentarios que existen en un post, buscando la coincidencia con usuarios
   public function Listado_comentarios_post_y_usuarios($filtro = null, $orden = null)
   {
 
     $sql = "SELECT comentarios.id_comentario,comentarios.id_post,comentarios.id_usuario,comentarios.texto,comentarios.creado,
     usuarios.id_usuario,usuarios.username,
     post.id_post,post.titulo,post.slug
     FROM comentarios,usuarios,post
     WHERE comentarios.id_usuario = usuarios.id_usuario  and comentarios.id_post = post.id_post 
     ORDER BY $filtro $orden ";
     
     return ( $this->ExecuteArrayResults( $sql ));
   }

  public function ListarUsuario($usuario_id)
  {

    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $params = array( $usuario_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  //Función que permite buscar coincidencias en la tabla de usuarios mediante las expresiones regulares
  public function busqueda_usuarios($campo)
  {
    $sql = "SELECT * FROM usuarios 
    WHERE username REGEXP '^.*" . $campo . ".*?$' or 
    nombre REGEXP '^.*" . $campo . ".*?$' or
    apellidos REGEXP '^.*" . $campo . ".*?$' or
    email REGEXP '^.*" . $campo . ".*?$'";
    /*$sql = "SELECT * FROM usuarios WHERE nombre ='" . $campo . "' or username = '" . $campo . "'";*/
    return ( $this->ExecuteArrayResults( $sql ));
  }

  //Función que permite buscar coincidencias en la tabla de post (vinculada a la de usuarios) mediante las expresiones regulares
  public function busqueda_post($campo)
  {
    $sql = "SELECT post.id_post,post.id_usuario,post.titulo,post.imagen_post,post.contenido,post.slug,post.creado,post.modificado,post.visitas,post.estado,
    usuarios.username,usuarios.id_usuario
    FROM post,usuarios
    WHERE post.id_usuario = usuarios.id_usuario and 
    (usuarios.username REGEXP '^.*" . $campo . ".*?$' or 
    post.titulo REGEXP '^.*" . $campo . ".*?$' or
    post.contenido REGEXP '^.*" . $campo . ".*?$' or
    post.slug REGEXP '^.*" . $campo . ".*?$' or
    post.visitas REGEXP '^.*" . $campo . ".*?$')";
    return ( $this->ExecuteArrayResults( $sql ));
  }

  //Función que permite buscar coincidencias en la tabla de comentarios (vinculada a la de usuarios y post) mediante las expresiones regulares
  public function busqueda_comentario($campo)
  {
    $sql = "SELECT comentarios.id_comentario,comentarios.id_post,comentarios.id_usuario,comentarios.texto,comentarios.creado,
    usuarios.id_usuario,usuarios.username,
    post.id_post,post.titulo,post.slug
    FROM comentarios,usuarios,post
    WHERE comentarios.id_usuario = usuarios.id_usuario and comentarios.id_post = post.id_post and 
    (comentarios.texto REGEXP '^.*" . $campo . ".*?$' or
    post.titulo REGEXP '^.*" . $campo . ".*?$' or
    post.slug REGEXP '^.*" . $campo . ".*?$' or
    usuarios.username REGEXP '^.*" . $campo . ".*?$')";
    /*$sql = "SELECT * FROM usuarios WHERE nombre ='" . $campo . "' or username = '" . $campo . "'";*/
    return ( $this->ExecuteArrayResults( $sql ));
  }

  /*---------- FUNCIONES ANTIGUAS --------------------*/

  public function ListPosts()
  {

    $sql = "SELECT * FROM posts order by id desc";
    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function ListAuthors()
  {
    $sql = "SELECT * FROM authors order by display_name asc";
    return ( $this->ExecuteArrayResults( $sql ));
  }

  public function ListOnePost( $post_id)
  {
    //$sql = "SELECT * FROM posts WHERE id = " . $post_id;
    $sql = "SELECT * FROM posts WHERE id = ?";
    $params = array( $post_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  public function ListOneAuthor( $author_id)
  {
    //$sql = "SELECT * FROM posts WHERE id = " . $post_id;
    $sql = "SELECT * FROM authors WHERE id = ?";
    $params = array( $author_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  

}