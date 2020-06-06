<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function debug( $var) 
  { 
    $debug = debug_backtrace();
    echo "<pre>";
    echo $debug[0]['file']." ".$debug[0]['line']."<br><br>";
    print_r($var); 
    echo "</pre>";
    echo "<br>";
  }

  function comprobar_login(){

    $datos = array();
    if (isset($_SESSION['logueado']) && $_SESSION['logueado'] === TRUE) {
      $datos['nombre'] = $_SESSION['nombre'];
      $datos['rol'] = $_SESSION['rol'] == 1 ? 'administrador' : 'usuario normal';
      $datos['id'] = $_SESSION['id'];
      $datos['password_hash'] = $_SESSION['password_hash'];
      $datos['imagen_perfil'] = $_SESSION['imagen_perfil'];
    }
    return $datos;
  }

  function redirect_back()
  {
      if(isset($_SERVER['HTTP_REFERER']))
      {
          header('Location: '.$_SERVER['HTTP_REFERER']);
      }
      else
      {
          header('Location: http://'.$_SERVER['SERVER_NAME']);
      }
      exit;
  }