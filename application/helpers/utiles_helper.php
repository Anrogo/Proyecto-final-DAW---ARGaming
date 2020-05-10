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
    if (isset($_SESSION['logueado'])) {
      $datos['nombre'] = $_SESSION['nombre'];
      $datos['rol'] = $_SESSION['rol'] == 1 ? 'administrador' : 'usuario normal';
    }
    return $datos;
  }