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
        /* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
        $datos = comprobar_login();

        if(!empty($datos)){

            header('Location: /inicio ');

        } else {

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
                'layout' => 'ly_login.php',
                'titulo' => 'Página de login',
            );
    
            $this->layouts->view($vista);
        }

        
    }

    public function login2()
    {
        /* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
        $datos = comprobar_login();

        if(!empty($datos)){//si ya estuviese la sesión iniciada nos manda a inicio

            header('Location: /inicio ');

        } else {//de lo contrario, se comprueban los datos:

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

                //debug($usuario);
                //Se guarda en variables de sesión los parámetros más importantes para poder utilizarlos mientras no se cierre sesión
                foreach ($usuario as $info) {
                    $usuario_data = array(
                        'id' => $info['id_usuario'],
                        'nombre_usuario' => $info['username'],
                        'nombre' => $info['nombre'],
                        'apellidos' => $info['apellidos'],
                        'email' => $info['email'],
                        'activo' => $info['estado'],
                        'rol' => $info['rol'],
                        'logueado' => TRUE
                    );
                }

                //debug($usuario_data);

                $this->session->set_userdata($usuario_data);
                header("Location: /inicio");
            }
        }
    }

    public function inicio_logueado()
    {
        /* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
        $datos = comprobar_login();
        if(!empty($datos)){
            $datos['title'] = 'No hay post disponibles en este momento, disculpe las molestias.';
            $vista = array(
                'vista' =>  $datos['rol'] == 'administrador' ? 'admin/index.php' : 'web/index.php',
                'params' => $datos,
                'layout' => 'ly_session.php',
                'titulo' => 'Inicio - logueado',
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
            $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario estándar';
            $datos['id'] = $this->session->userdata('id');
            //debug($_SESSION);
            
            $vista = array(
                'vista' => 'user/perfil-usuario.php',
                'params' => $datos,
                'layout' => 'ly_session.php',
                'titulo' => 'Usuario logueado',
            );
            $this->layouts->view($vista);
            
        } else {
            header("Location: /login");
        }
    }

    public function actualizar_usuario()
	{
		foreach ($_POST as $key => $value) {
			$datos[$key] = $value;
			//el campo que esté vacío no se incluye en la actualización:
			if($datos[$key] == null){
				unset($datos[$key]);
			}
		}
		if(isset($datos['password']) && !empty($datos['password'])){
			$datos['password'] = md5($datos['password']);
		} else {
			unset($datos['password']);
		}

		$where['id_usuario'] = $datos['id'];
		//se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
		unset($datos['id']);

		//debug($datos);

		$this->BackEndModel->update('usuarios', $datos, $where);

		header('Location: /inicio');
	}

    public function cerrar_sesion()
    {
        $usuario_data = array(
            'logueado' => FALSE
        );
        $this->session->set_userdata($usuario_data);
        header('Location:/');
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
