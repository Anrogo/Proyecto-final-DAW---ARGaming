<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailController extends CI_Controller
{
    function __construct()
	{
				parent::__construct();
    }
            
    public function enviar()
    {
        /* Configuración para mailtrap.io */
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '46ff8744270f6b',
            'smtp_pass' => 'b39367f2273361',
            'charset' => 'utf-8',
            'crlf' => "\r\n",
            'newline' => "\r\n"
          );
        
        $this->email->initialize($config);

        $datos_email = array();

        $url = urldecode($this->uri->segment(3));//se extrae la parte de la url con los datos

        $array_url = explode('&',$url);//se separan los datos a partir del separador insertado previamente y se dejan en forma de array

        debug($array_url);
        
        $long_array = count($array_url);//se guarda la longitud del array generado a partir de la url

        //si esta longitud vale 5 es porque contiene el teléfono y sino no lo tiene
        $long_array == 5 ? $campos_email = ['username','email','phone','asunto','mensaje'] : $campos_email = ['username','email','asunto','mensaje'];

        //Se asignan los diferentes segmentos de URL a cada valor del array, el primero, el número 3 será el nombre de usuario y le corresponde a 'username', por ejemplo.
        for($i = 0; $i < $long_array; $i++ ){
            if($campos_email[$i] != 'email'){
                strpos($array_url[$i], '-') !== null ? ($cad1 = str_replace('-',' ',$array_url[$i])) : ($cad1 = $array_url[$i]) ;
                strpos($array_url[$i], 'br') !== null ? ($cad2 = str_replace('br',PHP_EOL,$cad1)) : ($cad2 = $cad1) ;
                $datos_email [$campos_email[$i]] = $cad2;
            } else {//si se trata del email, se salta el filtro, porque no puede contener saltos de línea y sí guiones que no habría que sustituirlos por nada..
                $datos_email [$campos_email[$i]] = $array_url[$i];
            }
        }

        isset($datos_email['phone']) ? $datos_email['mensaje'] = $datos_email['mensaje'].PHP_EOL.PHP_EOL.'Teléfono de contacto: '.$datos_email['phone'] : ''; 
        debug($datos_email);
        //Se estructuran las partes de la clase email
        $this->email->from($datos_email['email'], $datos_email['username']);
        $this->email->to('info@argaming.com');
        $this->email->cc('antonirg96@gamil.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject($datos_email['asunto']);
        $this->email->message($datos_email['mensaje']);
        //Y se ejecuta, es decir se manda, con una respuesta positiva si se envía con éxito, o negativa si da error al enviarlo
        if($this->email->send()){
            $mensaje = '<p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>El correo ha sido enviado con éxito</p>';
        } else $mensaje = '<p class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>El correo no ha podido ser enviado</p>';

    //Se carga la página de contacto, con un "mínimo" de opciones, se pasa el mensaje de que el correo ha sido enviado o no y después se refresca para devolver a la ventana original
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    
    $datos = array(
        'mensaje' => $mensaje
    );

    $vista = array(
        'vista' => 'web/contacto.php',
        'params' => $datos,
        'layout' => 'ly_contacto.php',
        'titulo' => 'Contactar',
    );

    $this->layouts->view($vista);
    header("refresh:10;url=/contacto");
    }

    /* Función original */
    /*public function enviar()
    {
        // Configuración para mailtrap.io
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => '46ff8744270f6b',
            'smtp_pass' => 'b39367f2273361',
            'charset' => 'utf-8',
            'crlf' => "\r\n",
            'newline' => "\r\n"
          );
        
        /* Configuración para gmail.com
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'correo@gmail.com',
            'smtp_pass' => 'contraseña',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'validate' => TRUE
        );
        */
        /*
        $this->email->initialize($config);

        $datos_email = array();

        $url = urldecode($this->uri->segment(3));//se extrae la parte de la url con los datos

        $array_url = explode('&',$url);//se separan los datos a partir del separador insertado previamente y se dejan en forma de array

        debug($array_url);
        
        $long_array = count($array_url);//se guarda la longitud del array generado a partir de la url

        //si esta longitud vale 5 es porque contiene el teléfono y sino no lo tiene
        $long_array == 5 ? $campos_email = ['username','email','phone','asunto','mensaje'] : $campos_email = ['username','email','asunto','mensaje'];

        //Se asignan los diferentes segmentos de URL a cada valor del array, el primero, el número 3 será el nombre de usuario y le corresponde a 'username', por ejemplo.
        for($i = 0; $i < $long_array; $i++ ){
            if($campos_email[$i] != 'email'){
                strpos($array_url[$i], '-') !== null ? ($cad1 = str_replace('-',' ',$array_url[$i])) : ($cad1 = $array_url[$i]) ;
                strpos($array_url[$i], 'br') !== null ? ($cad2 = str_replace('br',PHP_EOL,$cad1)) : ($cad2 = $cad1) ;
                $datos_email [$campos_email[$i]] = $cad2;
            } else {//si se trata del email, se salta el filtro, porque no puede contener saltos de línea y sí guiones que no habría que sustituirlos por nada..
                $datos_email [$campos_email[$i]] = $array_url[$i];
            }
        }
        isset($datos_email['phone']) ? $datos_email['mensaje'] = $datos_email['mensaje'].PHP_EOL.PHP_EOL.'Teléfono de contacto: '.$datos_email['phone'] : ''; 
        debug($datos_email);
        /*    
        $datos_email['username'] = $this->uri->segment(3);
        $datos_email['email'] = $this->uri->segment(4);
        isset($datos_email['phone']) ? $datos_email['phone'] = $this->uri->segment(5) : '';
        $datos_email['asunto']= str_replace('-',' ',$this->uri->segment(6));
        $datos_email['mensaje'] = str_replace('-',' ',$this->uri->segment(7)).str_replace('br,PHP_EOL,$this->uri->segment(7));

        $this->email->subject('Email Test 3');
        $this->email->message('Este es un correo de prueba (3). Enviado por Antonio Rodríguez, administrador del blog ARGaming.com');
        */
        //Se estructuran las partes de la clase email
        /*
        $this->email->from($datos_email['email'], $datos_email['username']);
        $this->email->to('info@argaming.com');
        $this->email->cc('antonirg96@gamil.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject($datos_email['asunto']);
        $this->email->message($datos_email['mensaje']);
        //Y se ejecuta, es decir se manda, con una respuesta positiva si se envía con éxito, o negativa si da error al enviarlo
        if($this->email->send()){
            $mensaje = '<p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>El correo ha sido enviado con éxito</p>';
        } else $mensaje = '<p class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>El correo no ha podido ser enviado</p>';
        
        //debug($this->email);
        //redirect_back();
        /*
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();
    */
    //Se carga la página de contacto, con un "mínimo" de opciones, se pasa el mensaje de que el correo ha sido enviado o no y después se refresca para devolver a la ventana original
    /*
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    
    $datos = array(
        'mensaje' => $mensaje
    );

    $vista = array(
        'vista' => 'web/contacto.php',
        'params' => $datos,
        'layout' => 'ly_contacto.php',
        'titulo' => 'Contactar',
    );

    $this->layouts->view($vista);
    header("refresh:10;url=/contacto");
    }
    */
}
