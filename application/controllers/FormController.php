<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('FrontEndModel', 'FrontEndModel');
        $this->load->model('BackEndModel', 'BackEndModel');
    }

    /*
    public function index()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación
        /*
        $this->form_validation->set_rules('username', 'Username', 'required');//validación del username
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required',
            array('required' => 'You must provide a %s.')
        );//validación del password
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');//validación del password confirm
        $this->form_validation->set_rules('email', 'Email', 'required');//validación del correo
        
        Validar si el nombre de usuario existe en la base de datos
        array(
                'field' => 'username',
                'label' => 'Nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]|is_unique[users.username]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El nombre de usuario no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
        
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El nombre de usuario no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Contraseña',
                'rules' => 'trim|required|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{8,16}$/]',
                'errors' => array(
                    'required' => 'Debes añadir una %s válida.',
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato.'
                ),
            ),
            array(
                'field' => 'passconf',
                'label' => 'Confirmación de contraseña',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => 'La %s es obligatoria',
                    'matches' => 'La %s no coindide con el password'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El correo es obligatorio',
                    'valid_email' => 'El correo debe tener un formato válido'
                ),
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('web/myform');
        } else {
            $this->load->view('web/formsuccess');
        }
    }
    */
    public function registro()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación

        $config = array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'apellidos',
                'label' => 'apellidos',
                'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'Los %s son obligatorios, al menos el primero.',
                    'min_length' => 'Los %s deben tener al menos 2 caracteres de longitud',
                    'max_length' => 'Los %s deben tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos.'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'trim|required|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{7,16}$/]',
                'errors' => array(
                    'required' => 'Es obligatorio añadir una %s válida',
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato. Debe tener entre 8 y 16 caracteres.'
                ),
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'confirmación de contraseña',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => 'Debe añadir una contraseña para poder realizar la %s',
                    'matches' => 'La %s no coindide con el password'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Correo',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El correo es obligatorio',
                    'valid_email' => 'El correo debe tener un formato válido'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            //Si la validación es correcta se mandan los datos para insertar el nuevo registro
            foreach ($_POST as $key => $value) {
                $datos[$key] = $value;
            }
/*
            $registro_correo = $this->FrontEndModel->Buscar('usuarios','email',$datos['email']);

			debug($registro_correo);

			if(!empty($registro_correo)){
				$datos = array(
					'error' => 'El correo ya existe'
				);
			}
*/
            if ($datos['password'] == $datos['password_confirm']) {
                $datos['password'] = md5($datos['password']);
                unset($datos['password_confirm']);
            }

            $this->BackEndModel->insert('usuarios', $datos);

            $datos = array(
                'title' => 'Bienvenido',
                'mensaje_confirmacion' => 'El usuario ha sido registrado con éxito'
            );

            $vista = array(
                'vista' => 'web/index.php',
                'params' => $datos,
                'layout' => 'ly_home.php',
                'titulo' => 'Usuario añadido',
            );

            $this->layouts->view($vista);
        } else {
            //si la validación falla por cualquier circunstancia se queda en el formulario y se muestran los errores

            $datos = array();

            $vista = array(
                'vista' => 'web/nuevo_usuario.php',
                'params' => $datos,
                'layout' => 'ly_registro.php',
                'titulo' => 'Añadir nuevo usuario',
            );

            $this->layouts->view($vista);
        }
    }

    public function editar_perfil()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación

        $config = array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'apellidos',
                'label' => 'apellidos',
                'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'Los %s son obligatorios, al menos el primero.',
                    'min_length' => 'Los %s deben tener al menos 2 caracteres de longitud',
                    'max_length' => 'Los %s deben tener, como mucho, 50 caracteres de longitud',
                    'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos.'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'correo',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El correo es obligatorio',
                    'valid_email' => 'El correo debe tener un formato válido'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'trim|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{7,16}$/]',
                'errors' => array(
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato. Debe tener entre 8 y 16 caracteres'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {

            $datos_nuevos = array();

            foreach ($_POST as $key => $value) {
                $datos_nuevos[$key] = $value;
                if ($datos_nuevos[$key] == null) {
                    unset($datos_nuevos[$key]);
                }
            }

            //debug($datos_nuevos);
            $where['id_usuario'] = $datos_nuevos['id'];
            //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
            unset($datos_nuevos['id']);

            $this->BackEndModel->update('usuarios', $datos_nuevos, $where);

            header('Location: /perfil-usuario');
        } else {

            $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

            $datos = array(
                //se carga como el "apartado" data para evitar problemas en el archivo desde donde se visualizan los datos
                'usuarios' => $info['data']
            );
            $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario estándar';

            //debug($datos);

            $vista = array(
                'vista' => 'user/editar-perfil.php',
                'params' => $datos,
                'layout' => 'ly_session.php',
                'titulo' => 'Editar información de ' . $_SESSION['nombre_usuario'],
            );

            $this->layouts->view($vista);
        }
    }

    public function contactar()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación

        $config = array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'correo',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'valid_email' => 'El %s debe tener un formato válido'
                ),
            ),
            array(
                'field' => 'phone',
                'label' => 'teléfono',
                'rules' => 'trim|max_length[16]|regex_match[/^[0-9+]+$/]',
                'errors' => array(
                    'max_length' => 'El %s debe tener, como mucho, 16 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser numérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'asunto',
                'label' => 'asunto',
                'rules' => 'trim|required|max_length[40]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'mensaje',
                'label' => 'mensaje',
                'rules' => 'trim|required|min_length[4]|max_length[2500]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'Los %s son obligatorios, al menos el primero.',
                    'min_length' => 'Los %s deben tener al menos 2 caracteres de longitud',
                    'max_length' => 'Los %s deben tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos.'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {

            foreach ($_POST as $key => $value) {
                $datos[$key] = $value;
            }
            //debug($datos);
            $datos = array(
                'title' => '--Contacto completado--',
                'mensaje' => 'Mensaje enviado con éxito'
            );

            $vista = array(
                'vista' => 'web/index.php',
                'params' => $datos,
                'layout' => 'ly_home.php',
                'titulo' => 'Contactado',
            );

            $this->layouts->view($vista);
        } else {

            $datos = array();

            $vista = array(
                'vista' => 'web/contacto.php',
                'params' => $datos,
                'layout' => 'ly_contacto.php',
                'titulo' => 'Contactar',
            );

            $this->layouts->view($vista);
        }
    }

    public function cambiar_contraseña()
    {

        $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

        $datos = array(
            //se carga como el "apartado" data para evitar problemas en el archivo desde donde se visualizan los datos
            'usuarios' => $info['data']
        );
        $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario estándar';

        //debug($datos['usuarios'][0]['password']);

        //debug($_SESSION['password_hash']);

        //Siempre que el usuario identificado sea administrador o el cambio de contraseña se realice sobre el mismo usuario que se ha logueado
        if((comprobar_login() && $_SESSION['rol'] == 1) || (comprobar_login() && $_SESSION['password_hash'] == $datos['usuarios'][0]['password'])){

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation'); //llamamos a las reglas de validación

            $config = array(
                array(
                    'field' => 'password',
                    'label' => 'contraseña',
                    'rules' => 'trim|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{7,16}$/]',
                    'errors' => array(
                        'min_length' => 'La %s debe tener al menos 8 caracteres',
                        'regex_match' => 'La %s no cumple con las reglas de formato. Debe tener entre 8 y 16 caracteres'
                    ),
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'confirmar contraseña',
                    'rules' => 'trim|matches[password]',
                    'errors' => array(
                        'matches' => 'Las contraseñas no coinciden, corrígelas por favor.'
                    ),
                ),
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {

                $datos_nuevos = array();

                foreach ($_POST as $key => $value) {
                    $datos_nuevos[$key] = $value;
                    if ($datos_nuevos[$key] == null) {
                        unset($datos_nuevos[$key]);
                    }
                }
                $datos_nuevos['password'] = md5($datos_nuevos['password']);
                $datos_nuevos['password_confirm'] = md5($datos_nuevos['password_confirm']);
                //debug($datos_nuevos);

                if (!empty($datos_nuevos['password']) && ($datos_nuevos['password'] == $datos_nuevos['password_confirm'])) {
                    unset($datos_nuevos['password_confirm']);
                }
    
                $where['id_usuario'] = $datos_nuevos['id'];
                //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
                unset($datos_nuevos['id']);
                //debug($datos_nuevos);

                $this->BackEndModel->update('usuarios', $datos_nuevos, $where);

                header('Location: /');
            } else {

                $vista = array(
                    'vista' => 'user/cambiar-contraseña.php',
                    'params' => $datos,
                    'layout' => 'ly_session.php',
                    'titulo' => 'Actualizar contraseña de ' . $datos['usuarios'][0]['username'],
                );

                $this->layouts->view($vista);
            }

        } else {
            header('Location: /');
        }
    }

    public function mensajes_vista($tipo, $texto, $ruta)
    {
    }

    /*Apartado para las funciones que abarca el adminisrador */
    public function registro_admin()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación

        $config = array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'apellidos',
                'label' => 'apellidos',
                'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'Los %s son obligatorios, al menos el primero.',
                    'min_length' => 'Los %s deben tener al menos 2 caracteres de longitud',
                    'max_length' => 'Los %s deben tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos.'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'correo',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El correo es obligatorio',
                    'valid_email' => 'El correo debe tener un formato válido'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'trim|required|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{7,16}$/]',
                'errors' => array(
                    'required' => 'Es obligatorio añadir una %s válida',
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato. Debe tener entre 8 y 16 caracteres'
                ),
            ),
            array(
                'field' => 'password_confirm',
                'label' => 'confirmación de contraseña',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => 'Debe añadir una contraseña para poder realizar la %s',
                    'matches' => 'La %s no coindide con el password'
                ),
            ),
            array(
                'field' => 'rol',
                'label' => 'rol de usuario',
                'rules' => 'required|in_list[0,1]',
                'errors' => array(
                    'required' => 'El rol es obligatorio',
                    'in_list' => 'El rol debe ser únicamente 0: "usuario estándar" o 1: "administrador"'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {

            foreach ($_POST as $key => $value) {
                $datos[$key] = $value;
            }

            if ($datos['password'] == $datos['password_confirm']) {
                $datos['password'] = md5($datos['password']);
                unset($datos['password_confirm']);
            }

            $this->BackEndModel->insert('usuarios', $datos);

            header('Location: /admin/panel-control/usuarios');
        } else {

            $datos = array();

            $vista = array(
                'vista' => 'admin/nuevo_usuario.php',
                'params' => $datos,
                'layout' => 'ly_admin_basico.php',
                'titulo' => 'Añadir nuevo usuario',
            );

            $this->layouts->view($vista);
        }
    }

    public function editar_admin()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation'); //llamamos a las reglas de validación

        $config = array(
            array(
                'field' => 'username',
                'label' => 'nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y sin espacios.'
                ),
            ),
            array(
                'field' => 'nombre',
                'label' => 'nombre',
                'rules' => 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'apellidos',
                'label' => 'apellidos',
                'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ\s]+$/]',
                'errors' => array(
                    'required' => 'Los %s son obligatorios, al menos el primero.',
                    'min_length' => 'Los %s deben tener al menos 2 caracteres de longitud',
                    'max_length' => 'Los %s deben tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'Los %s solo deben contener espacios entre media de caracteres alfabéticos.'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'correo',
                'rules' => 'trim|required|valid_email',
                'errors' => array(
                    'required' => 'El correo es obligatorio',
                    'valid_email' => 'El correo debe tener un formato válido'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'trim|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{7,16}$/]',
                'errors' => array(
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato. Debe tener entre 8 y 16 caracteres'
                ),
            ),
            array(
                'field' => 'rol',
                'label' => 'rol de usuario',
                'rules' => 'required|in_list[0,1]',
                'errors' => array(
                    'required' => 'El rol es obligatorio',
                    'in_list' => 'El rol debe ser únicamente 0: "usuario estándar" o 1: "administrador"'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {

            $datos_nuevos = array();

            foreach ($_POST as $key => $value) {
                $datos_nuevos[$key] = $value;
                if ($datos_nuevos[$key] == null) {
                    unset($datos_nuevos[$key]);
                }
            }

            if (!empty($datos_nuevos['password'])) {
                $datos_nuevos['password'] = md5($datos_nuevos['password']);
            }

            //debug($datos_nuevos);
            $where['id_usuario'] = $datos_nuevos['id'];
            //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
            unset($datos_nuevos['id']);

            $this->BackEndModel->update('usuarios', $datos_nuevos, $where);

            header('Location: /admin/panel-control/usuarios');
        } else {

            $info = $this->BackEndModel->ListarUsuario($this->uri->segment(2));

            $datos = array(
                //se carga como el "apartado" data para evitar problemas en el archivo desde donde se visualizan los datos
                'usuarios' => $info['data']
            );
            //debug($datos);
            $vista = array(
                'vista' => 'admin/editar_usuario.php',
                'params' => $datos,
                'layout' => 'ly_admin_basico.php',
                'titulo' => 'Editar información del usuario',
            );

            $this->layouts->view($vista);
        }
    }
}
