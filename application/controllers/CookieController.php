<?php

if ( ! defined('BASEPATH')) exit('Stop Its demostrate how to set cookie');

class CookieController extends CI_Controller {

   function __construct()

   {

       parent::__construct();

      //$this->load->helper('cookie');
      $this->load->helper(array('cookie', 'url'));

   }



   function set()
   {
    //Valores que se le asignan a la cookie
    $nombre = 'cookies_aceptadas';
    $valor = '1';
    $expira = time() + 604800;      //ese tiempo es una semana                                                                             
    $seguro = TRUE;

    setcookie($nombre,$valor,$expira,$seguro);

    //echo "Congratulation Cookie Set";
    header('Location: /');
   }



   function get()
   {
    //muestra el contenido de la cookie
    //echo $this->input->cookie('cookies_aceptadas',true);
    debug($_COOKIE);
   }

   function delete()
   {
       delete_cookie('cookies_aceptadas');
   }

}