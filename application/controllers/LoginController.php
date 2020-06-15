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

            if ($this->uri->segment(2) == !null && $this->uri->segment(2) == 'no-registrado') {

                $datos = array(
                    'no-registrado' => "Usuario no registrado"
                );

            }

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

            header('Location: / ');

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
            //debug($usuario);
            //Filtramos los posibles errores según lo que devuelva el modelo
            if (empty($usuario['data'])) {

                header("Location: /login/error");

            } else {

                //debug($usuario);
                //Se guarda en variables de sesión los parámetros más importantes para poder utilizarlos mientras no se cierre sesión
                foreach ($usuario['data'] as $info) {
                //foreach ($usuario as $info) {
                    $usuario_data = array(
                        'id' => $info['id_usuario'],
                        'username' => $info['username'],
                        'nombre' => $info['nombre'],
                        'apellidos' => $info['apellidos'],
                        'email' => $info['email'],
                        'password_hash' => $info['password'],
                        'activo' => $info['estado'],
                        'rol' => $info['rol'],
                        'imagen_perfil' => ($info['imagen_perfil'] == null ? 'perfil-predeter.jpg' : $info['imagen_perfil']),
                        'logueado' => TRUE
                    );
                }

                //debug($usuario_data);

                $this->session->set_userdata($usuario_data);
                redirect_back();
            }
        }
    }
    public function inicio_logueado()
    {
        /* El inicio de sesión se comprueba en la funcion comprobar_login(), ubicada en utiles_helper */
        $datos = comprobar_login();
        //debug($datos);
        if(!empty($datos)){
            $datos['title'] = 'No hay post disponibles en este momento, disculpe las molestias.';
            $vista = array(
                'vista' =>  $datos['rol'] == 'administrador' ? 'web/index.php' : 'web/index.php',
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
            $datos['apellidos'] = $this->session->userdata('apellidos');
            $datos['username'] = $this->session->userdata('username');
            $datos['email'] = $this->session->userdata('email');
            $datos['password_hash'] = $this->session->userdata('password_hash');
            $datos['rol'] = $this->session->userdata('rol') == 1 ? 'Administrador' : 'Usuario estándar';
            $datos['id_usuario'] = $this->session->userdata('id');
            $datos['imagen_perfil'] = $this->session->userdata('imagen_perfil');
            //debug($_SESSION);
            //debug($datos);
            
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

		header('Location: /');
    }
    
    public function eliminar_perfil()
    {
        $id = $this->uri->segment(3);//id del usuario que hay que eliminar
        if($id == $_SESSION['id']){
            header('Location: /correo/eliminar-perfil/' . $id);
        } else {
            
        }
    }

    public function cerrar_sesion()
    {
        $usuario_data = array(
            'logueado' => FALSE
        );
        $this->session->set_userdata($usuario_data);
        $_SESSION = array();
        redirect_back();
    }
}
