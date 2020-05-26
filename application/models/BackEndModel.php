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

  public function update( $tabla, $datos, $where)
  {
    $this->db->update( $tabla, $datos, $where); 
  }

  public function delete( $tabla, $where)
  {
    $this->db->delete( $tabla, $where);
  }

  # Método para validar el email y contraseña que nos han pasado desde el formulario
  public function login( $datos)
  {

    $sql = "Select * From usuarios Where username = '".$datos['username']."' And password = '".$datos['password']."'";

    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function Lista($tabla,$filtro)
  {

    $sql = "select * from $tabla order by $filtro asc";
    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function ListarUsuario($usuario_id)
  {

    $sql = "select * from usuarios where id_usuario = ?";
    $params = array( $usuario_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  /*---------- FUNCIONES ANTIGUAS --------------------*/

  public function ListPosts()
  {

    $sql = "select * from posts order by id desc";
    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function ListAuthors()
  {
    $sql = "select * from authors order by display_name asc";
    return ( $this->ExecuteArrayResults( $sql ));
  }

  public function ListOnePost( $post_id)
  {
    //$sql = "select * from posts where id = " . $post_id;
    $sql = "select * from posts where id = ?";
    $params = array( $post_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  public function ListOneAuthor( $author_id)
  {
    //$sql = "select * from posts where id = " . $post_id;
    $sql = "select * from authors where id = ?";
    $params = array( $author_id);
    return ( $this->ExecuteResultsParamsArray( $sql, $params ));
  }

  

}