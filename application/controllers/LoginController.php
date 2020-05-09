<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('FrontEndModel', 'FrontEndModel');
        $this->load->model('BackEndModel', 'BackEndModel');
        $this->load->model('LoginModel', 'LoginModel');
    }

    public function login()
    {
        if ($this->uri->segment(2) == !null && $this->uri->segment(2) == 'error') {

            $datos = array(
                'error' => "Usuario o contraseña invalidos"
            );
        } else {
            $datos = array();
        }

        $vista = array(
            'vista' => 'user/login.php',
            'params' => $datos,
            'layout' => 'ly_home.php',
            'titulo' => 'Página de login',
        );

        $this->layouts->view($vista);
    }

    public function login2()
    {
        # Tratamos los datos para pasarselos al modelo
        $datos['username'] = $_POST['username'];
        # codificamos el password con MD5 porque así está 
        # codificado en la base de datos
        # Se puede utilizar cualquiera, como sha1 o mezcla
        $datos['password'] = md5($_POST['password']);

        //debug($_POST);
        /* 
		Enviamos los datos al modelo que hará la consulta a la base
		de datos y nos devolverá un Array con los datos del usuario 
		o un array vacío si no hay coincidencia con ningún usuario
		*/
        $usuario = $this->LoginModel->comprobar_usuario($datos);

        //Filtramos los posibles errores según lo que devuelva el modelo
        if (empty($usuario)) {

            header("Location: /login/error");
        } else {
            //header("Location: /");

            echo "<pre>";
            print_r($usuario);
            echo "</pre>";

            foreach ($usuario as $info) {
                $usuario_data = array(
                    'id' => $info['id_user'],
                    'nombre' => $info['nombre'],
                    'rol' => $info['rol'],
                    'logueado' => TRUE
                );
            }

            echo "<pre>";
            print_r($usuario_data);
            echo "</pre>";

            $this->session->set_userdata($usuario_data);
            header("Location: /inicio");
        }
    }

    public function inicio_logueado()
    {
        /* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
        $datos = comprobar_login();
        if(!empty($datos)){
            $datos['title'] = 'Información de usuario';
            $vista = array(
                'vista' =>  $datos['rol'] == 'administrador' ? 'admin/index.php' : 'web/index.php',
                'params' => $datos,
                'layout' => 'ly_session.php',
                'titulo' => 'Estás logueado',
            );
            $this->layouts->view($vista);
        } else {
            header("Location: /login");
        }
    }

    public function perfil_usuario()
    {
        if ($this->session->userdata('logueado')) {
            $datos = array();
            $datos['nombre'] = $this->session->userdata('nombre');
            $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario normal';
            $vista = array(
                'vista' => 'user/logueado.php',
                'params' => $datos,
                'layout' => 'ly_session.php',
                'titulo' => 'Usuario logueado',
            );
            $this->layouts->view($vista);
        } else {
            header("Location: /login");
        }
    }

    public function cerrar_sesion()
    {
        $usuario_data = array(
            'logueado' => FALSE
        );
        $this->session->set_userdata($usuario_data);
        header('Location:/');
    }

    public function pruebas()
    {

        $datos = array();

        if (isset($_POST['username']) && isset($_POST['password'])) {

            $datos = array(
                'username' => $_POST['username'],
                'password' => md5($_POST['password'])
            );
            $resp = $this->LoginModel->comprobar_usuario($datos);
            if (!empty($resp)) {
                $datos = array(
                    'error' => $resp
                );
                //header("Location: /");

            } else {
                $datos = array(
                    'error' => "Usuario o contraseña invalidos"
                );
            }
        }

        $vista = array(
            'vista' => 'user/login.php',
            'params' => $datos,
            'layout' => 'ly_home.php',
            'titulo' => 'Login de usuario',
        );

        $this->layouts->view($vista);
    }

    public function registro()
    {

        $titulo = 'FORMULARIO DE REGISTRO';

        $datos = array(
            'title' => $titulo
        );

        $vista = array(
            'vista' => 'web/index.php',
            'params' => $datos,
            'layout' => 'ly_home.php',
            'titulo' => 'Registro para nuevos usuarios',
        );

        $this->layouts->view($vista);
    }
}
