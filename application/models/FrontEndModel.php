<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
  public function ExecuteArrayResults($sql)
  {
    $query = $this->db->query($sql);
    $rows = $query->result_array();
    $query->free_result();

    return ($rows);
  }

  public function ExecuteResultsParamsArray($sql, $params)
  {

    $query = $this->db->query($sql, $params);
    $rows['data'] = $query->result_array();
    $query->free_result();

    return ($rows);
  }

  public function insert($tabla, $datos)
  {
    $this->db->insert($tabla, $datos);
  }

  /* Actualizar número de visitas */
  public function actualizar_visitas_post($id_post)
  {
    $this->db->set('visitas', 'visitas+1', FALSE);
    $this->db->WHERE('id_post', $id_post);
    $this->db->update('post');
  }

  /*Lista la tabla que se le solicite y clasifica la información a partir del parámetro indicado*/
  public function Lista($tabla, $clasif)
  {
    $sql = "SELECT * FROM " . $tabla . " order by " . $clasif . " desc";
    return ($this->ExecuteArrayResults($sql));
  }

  /*Devuelve el registro que coincida, de la tabla, y con el valor indicados*/
  public function Buscar($tabla, $campo_clave, $cadena)
  {

    $sql = "SELECT * FROM " . $tabla . " WHERE " . $campo_clave . " ='" . $cadena . "'";
    return ($this->ExecuteArrayResults($sql));
  }

  /*Buscar coincidencia de dos campos, el primero que no exista 
en ningún otro registro y el segundo que sí coincida para que se cumpla*/
  public function Buscar_campo_existente($tabla, $campo1, $valor1, $campo2, $valor2)
  {
    $sql = "SELECT * FROM " . $tabla . " WHERE " . $campo1 . " != '" . $valor1 . "' and " . $campo2 . " = '" . $valor2 . "'";
    return ($this->ExecuteArrayResults($sql));
  }

  # Método para mostrar un post cuando se seleccione, a través de su id
  public function Listar_post($post_id)
  {
    $sql = "SELECT * FROM post WHERE id_post = ?";
    $params = array($post_id);
    return ($this->ExecuteResultsParamsArray($sql, $params));
  }

  # Método para mostrar un comentario cuando se seleccione, a través de su id
  public function Listar_comentario($comentario_id)
  {
    $sql = "SELECT * FROM comentarios WHERE id_comentario = ?";
    $params = array($comentario_id);
    return ($this->ExecuteResultsParamsArray($sql, $params));
  }

  # Método para mostrar todos los comentarios que existen en un post, según su id
  public function Listar_comentarios($post_id)
  {
    $sql = "SELECT comentarios.id_comentario,comentarios.id_post,comentarios.id_usuario,
    comentarios.texto,comentarios.creado,usuarios.username,usuarios.email,usuarios.imagen_perfil 
    FROM comentarios,usuarios 
    WHERE comentarios.id_usuario = usuarios.id_usuario  and id_post = ?";
    $params = array($post_id);
    return ($this->ExecuteResultsParamsArray($sql, $params));
  }

  # Método para listar el número de post creados por cada usuario
  public function Autores_post()
  {
    $sql = "SELECT usuarios.username,usuarios.id_usuario,
    count(post.id_post) as numero_post
    FROM usuarios,post 
    WHERE post.id_usuario = usuarios.id_usuario 
    GROUP BY usuarios.username ";
    return ($this->ExecuteArrayResults($sql));
  }

  # Método para listar los datos de los post creados por un usuario concreto
  public function Datos_autor_post($id)
  {
    $sql = "SELECT post.id_post,post.id_usuario,post.titulo,post.imagen_post,
    post.contenido,post.slug,post.creado,post.modificado,post.visitas,post.estado,
      usuarios.username,usuarios.id_usuario
      FROM post,usuarios 
      WHERE post.id_usuario = usuarios.id_usuario AND usuarios.id_usuario = $id";
    return ($this->ExecuteArrayResults($sql));
  }
}
