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
                'rules' => 'trim|required|min_length[8]|regex_match[/^[0-9A-Za-z!@#$&*_-]\S{8,16}$/]',
                'errors' => array(
                    'required' => 'Es obligatorio añadir una %s válida',
                    'min_length' => 'La %s debe tener al menos 8 caracteres',
                    'regex_match' => 'La %s no cumple con las reglas de formato.'
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
            
            foreach ($_POST as $key => $value) {
                $datos[$key] = $value;
            }

            if ($datos['password'] == $datos['password_confirm']){
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
                'layout' => 'ly_home_basico.php',
                'titulo' => 'Usuario añadido',
            );
            
            $this->layouts->view($vista);

        } else {

            $datos = array();

		    $vista = array(
                'vista' => 'web/nuevo_usuario.php',
                'params' => $datos,
                'layout' => 'ly_home_basico.php',
                'titulo' => 'Añadir nuevo usuario',
            );
            
            $this->layouts->view($vista);

        }
    }

    public function mensajes_vista($tipo,$texto,$ruta)
    {

    }
}
