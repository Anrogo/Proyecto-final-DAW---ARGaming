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
        */
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Nombre de usuario',
                'rules' => 'required|min_length[5]|max_length[30]',
                'errors' => array(
                    'required' => 'El %s no debe contener espacios, solo puede llevar \'_\'.',
                    'min_length' => 'El %s debe tener al menos 5 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Debes añadir una %s válida.',
                ),
            ),
            array(
                'field' => 'passconf',
                'label' => 'Confirmación de contraseña',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'required' => 'La %s es obligatoria',
                    'matches' => 'La %s no coindide con el password'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email',
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
