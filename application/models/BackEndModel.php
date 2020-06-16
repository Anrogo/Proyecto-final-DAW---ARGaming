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
    WHERE post.id_usuario = usuarios.id_usuario
    ORDER BY visitas";

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
    $sql = "SELECT post.id_post,post.id_usuario,post.titulo,post.imagen_post,
    post.contenido,post.slug,post.creado,post.modificado,post.visitas,post.estado,
    usuarios.username,usuarios.id_usuario
    FROM post,usuarios
    WHERE post.id_usuario = usuarios.id_usuario and 
    (usuarios.username REGEXP '^.*" . $campo . ".*?$' or 
    post.titulo REGEXP '^.*" . $campo . ".*?$' or
    post.contenido REGEXP '^.*" . $campo . ".*?$' or
    post.slug REGEXP '^.*" . $campo . ".*?$' or
    post.visitas REGEXP '^.*" . $campo . ".*?$')
    ORDER BY post.visitas desc";
    return ( $this->ExecuteArrayResults( $sql ));
  }

  //Función que permite buscar coincidencias en la tabla de comentarios (vinculada a la de usuarios y post) mediante las expresiones regulares
  public function busqueda_comentarios($campo)
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


  /* Paginación de usuarios */

  function pagination($tabla,$pag_size,$offset)
  {
    $this->db->select();
    $this->db->from($tabla);
    $this->db->limit($pag_size,$offset);
    $query = $this->db->get();
    $rows = $query->result_array();
    return $rows;
  }

  function count($tabla)
  {

    $number = $this->db->query("SELECT count(*) as number FROM $tabla")->row()->number;
    return intval($number);//devuelve en un valor entero el número de filas de la tabla que le pidamos
  }
}