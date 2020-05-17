<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{

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
        */
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
}
