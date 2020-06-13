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
       $cookie= array(

           'name'   => 'remember_me',
           'value'  => 'test',                            
           'expire' => '300',                                                                                   
           'secure' => TRUE

       );

       $this->input->set_cookie($cookie);

       echo "Congratulation Cookie Set";

   }



   function get()

   {
    //muestra el contenido de la cookie
       echo $this->input->cookie('remember_me',true);

   }

}