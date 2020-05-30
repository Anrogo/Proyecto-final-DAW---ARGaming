<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FrontEndModel extends CI_Model
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

  public function Lista($tabla,$clasif)
  {

    $sql = "select * from ".$tabla." order by ".$clasif." asc";
    return ( $this->ExecuteArrayResults( $sql ));

  }

  public function Buscar($tabla,$campo_clave,$cadena)
  {

    $sql = "select * from ".$tabla." where ".$campo_clave." ='".$cadena."'";
    return ( $this->ExecuteArrayResults( $sql ));

  }

    # Método para mostrar un post cuando se seleccione, a través de su id
    public function Listar_post($post_id)
    {
  
      $sql = "Select * From post Where id_post = " . $post_id;
  
      return ( $this->ExecuteArrayResults( $sql ));
  
    }

  # Método para mostrar un comentario cuando se seleccione, a través de su id
  public function Listar_comentario($comentario_id)
  {

    $sql = "Select * From comentarios Where id_comentario = " . $comentario_id;
    
    return ( $this->ExecuteArrayResults( $sql ));

  }

  # Método para mostrar todos los comentarios que existen en un post, según su id
  public function Listar_comentarios($post_id)
  {

    $sql = "Select comentarios.id_comentario,comentarios.id_post,comentarios.id_usuario,comentarios.texto,comentarios.creado,usuarios.username,usuarios.email,usuarios.imagen_perfil 
    From comentarios,usuarios 
    WHERE comentarios.id_usuario = usuarios.id_usuario  and id_post = ". $post_id;
    
    return ( $this->ExecuteArrayResults( $sql ));

  }

  # Método para mostrar los post en la página principal solo con parte de la información
  public function list_all_posts()
  {

    $sql = "Select p.*, a.display_name 
    From posts as p
    left join authors as a On p.author_id = a.id
    Where p.enabled = 1 order by p.created desc limit 10";

    return ( $this->ExecuteArrayResults( $sql ));

  }
  
  # Método para mostrar un post cuando se seleccione, a través de su id
  public function list_one_post($post_id)
  {

    $sql = "Select p.*, a.display_name 
    From posts as p
    left join authors as a On p.author_id = a.id
    Where p.id = " . $post_id;

    return ( $this->ExecuteArrayResults( $sql ));

  }

   # Método para mostrar los post del autor seleccionado
   public function list_all_posts_by_author($author_id)
   {
 
     $sql = "Select p.*, a.display_name 
     From posts as p
     left join authors as a On p.author_id = a.id
     Where p.enabled = 1 And p.author_id = ".$author_id." 
     order by p.created desc";
 
     return ( $this->ExecuteArrayResults( $sql ));
 
   }
}