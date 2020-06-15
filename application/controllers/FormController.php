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
            ),
            array(
                'field' => 'check',
                'label' => 'políticas',
                'rules' => 'trim|required|in_list[1]',
                'errors' => array(
                    'required' => 'Es obligatorio aceptar nuestras %s',
                    'in_list' => 'Valor inválido para las %s'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {
            //Si la validación es correcta se mandan los datos para insertar el nuevo registro
            foreach ($_POST as $key => $value) {
                $datos[$key] = $value;
            }

            $registro_username = $this->FrontEndModel->Buscar('usuarios', 'username', $datos['username']);
            $registro_correo = $this->FrontEndModel->Buscar('usuarios', 'email', $datos['email']);

            if (!empty($registro_username) || !empty($registro_correo)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                if (!empty($registro_username)) {
                    $datos['error_username'] = 'Este nombre de usuario ya existe';
                }
                if (!empty($registro_correo)) {
                    $datos['error_correo'] = 'Este correo ya existe';
                }
                //debug($datos);
                //Se devuelve el error de que el correo ya existe, estaba registrado con anterioridad
                $vista = array(
                    'vista' => 'web/nuevo_usuario.php',
                    'params' => $datos,
                    'layout' => 'ly_registro.php',
                    'titulo' => 'Añadir nuevo usuario - ARGaming',
                );

                $this->layouts->view($vista);
            } else {
                //si los datos están bien, y las contraseñas coinciden al 100%, carga la nueva información del usuario en la tabala usuarios y devuelve un mensaje de confirmación
                if ($datos['password'] == $datos['password_confirm']) {
                    
                    $datos['password'] = md5($datos['password']);
                    
                    unset($datos['password_confirm']);
                    unset($datos['check']);

                    
                    $datos['rol'] = 0;//usuario estándar, por defecto
                    $datos['estado'] = 1;//activo, por defecto

                    $this->BackEndModel->insert('usuarios', $datos);

                    //A partir de aquí se carga la página de inicio con normalidad pero añadiendo un mensaje de confirmación del usuario creado
                    $posts = $this->FrontEndModel->Lista('post', 'visitas');
                    
                    //Se almacenan los datos en el array para pasarselo a la vista que corresponda
		            $datos['posts'] = $posts;

                    $datos['mensaje_confirmacion'] = '<p class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>El usuario ha sido registrado con éxito</p>';

                    //debug($datos);
                    //Se genera la vista una vez el registro se completa con éxito
                    $vista = array(
                        'vista' => 'web/index.php',
                        'params' => $datos,
                        'layout' => 'ly_home.php',
                        'titulo' => 'Usuario añadido - ARGaming',
                    );

                    $this->layouts->view($vista);
                    
                } else {
                    $datos['error_contraseñas'] = 'Las contraseñas no coinciden';

                    $vista = array(
                        'vista' => 'web/nuevo_usuario.php',
                        'params' => $datos,
                        'layout' => 'ly_registro.php',
                        'titulo' => 'Añadir nuevo usuario - ARGaming',
                    );

                    $this->layouts->view($vista);
                }

                
            }
        } else {
            //si la validación falla por cualquier otra circunstancia se queda en el formulario y se muestran los errores

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
        $verif = comprobar_login();

        if (!empty($verif) && $verif['id'] == $this->uri->segment(3)) {

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

                //Se busca que no haya coincidencia, de nombre de usuario o correo, en otros registros de usuarios con id diferente.
                $registro_username = $this->FrontEndModel->Buscar_campo_existente('usuarios', 'id_usuario', $datos_nuevos['id'], 'username', $datos_nuevos['username']);
                $registro_correo = $this->FrontEndModel->Buscar_campo_existente('usuarios', 'id_usuario', $datos_nuevos['id'], 'email', $datos_nuevos['email']);
                //debug($datos_nuevos);
                
                if (!empty($registro_correo) || !empty($registro_username)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_username)) {
                        $datos['error_username'] = 'Este nombre de usuario ya existe';
                    }

                    if (!empty($registro_correo)) {
                        $datos['error_correo'] = 'Este correo ya existe';
                    }
                    //debug($this->uri);
                    $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

                    $datos['usuarios'] = $info['data'];
                    $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario estándar';
                    //debug($datos);

                    $vista = array(
                        'vista' => 'user/editar-perfil.php',
                        'params' => $datos,
                        'layout' => 'ly_session.php',
                        'titulo' => 'Editar información del usuario' . $_SESSION['username'],
                    );

                    $this->layouts->view($vista);
                } else {

                    if ($datos_nuevos['rol'] == 'Usuario administrador' && (isset($_SESSION['rol']) &&  $_SESSION['rol'] == 1)) {
                        $datos_nuevos['rol'] = 1;
                    } else {
                        $datos_nuevos['rol'] = 0;
                    }

                    
                    //debug($datos_nuevos);
                    $datos_nuevos['modificado'] = date('Y-m-d H:i:s');
                    $where['id_usuario'] = $datos_nuevos['id'];
                    //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
                    unset($datos_nuevos['id']);

                    $this->BackEndModel->update('usuarios', $datos_nuevos, $where);

                    $datos = array();
                    $datos['nombre'] = $this->session->userdata('nombre');
                    $datos['apellidos'] = $this->session->userdata('apellidos');
                    $datos['username'] = $this->session->userdata('username');
                    $datos['email'] = $this->session->userdata('email');
                    $datos['password_hash'] = $this->session->userdata('password_hash');
                    $datos['rol'] = $this->session->userdata('rol') == 1 ? 'Administrador' : 'Usuario estándar';
                    $datos['id_usuario'] = $this->session->userdata('id');
                    $datos['imagen_perfil'] = $this->session->userdata('imagen_perfil');

                    $datos['mensaje_confirmacion'] = '<p class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>Sus datos de usuario han sido guardados con éxito</p>';

                    $vista = array(
                        'vista' => 'user/perfil-usuario.php',
                        'params' => $datos,
                        'layout' => 'ly_session.php',
                        'titulo' => 'Usuario logueado',
                    );

                    $this->layouts->view($vista);
                }
            } else {

                $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

                $datos['usuarios'] = $info['data']; //se carga como el "apartado" data para evitar problemas en el archivo desde donde se visualizan los datos

                $datos['rol'] = $this->session->userdata('rol') == 1 ? 'administrador' : 'usuario estándar';

                //debug($datos);

                $vista = array(
                    'vista' => 'user/editar-perfil.php',
                    'params' => $datos,
                    'layout' => 'ly_session.php',
                    'titulo' => 'Editar información de ' . $_SESSION['username'],
                );

                $this->layouts->view($vista);
            }
        } else {
            header('Location: /error');
        }
    }

    public function nuevo_post()
    {
        $verif = comprobar_login();
        //debug($verif);
        if (!empty($verif)) {

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
                    'field' => 'titulo',
                    'label' => 'título del post',
                    'rules' => 'trim|required|min_length[3]|max_length[100]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.;:"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                        'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                    ),
                ),
                array(
                    'field' => 'slug',
                    'label' => 'slug',
                    'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-z0-9\-]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatoria.',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 50 caracteres de longitud',
                        'regex_match' => 'El %s no puede contener espacios ni caracteres especiales solo guiones (-).'
                    ),
                ),
                array(
                    'field' => 'contenido',
                    'label' => 'contenido',
                    'rules' => 'trim|required|min_length[20]|max_length[5000]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.;:"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio, de lo contrario, ¿qué sentido tendría crear este post?.',
                        'min_length' => 'El %s debe tener al menos 20 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 5000 caracteres de longitud o causaría problemas en base de datos',
                        'regex_match' => 'El %s puede contener todo tipo de caracteres y símbolos excepto alguno que has añadido, revísalo por favor.'
                    ),
                ),
                array(
                    'field' => 'imagen_post',
                    'label' => 'imagen',
                    'rules' => 'trim',
                    'errors' => array(),
                ),
            );

            $this->form_validation->set_rules($config);

            $datos['username'] = $_SESSION['nombre_usuario'];
            $datos['rol'] = $verif['rol'];

            if ($this->form_validation->run() == TRUE) {

                foreach ($_POST as $key => $value) {
                    $datos_nuevos[$key] = $value;
                }
                debug($datos_nuevos);
                $registro_titulo = $this->FrontEndModel->Buscar('post', 'titulo', $datos_nuevos['titulo']);
                $registro_slug = $this->FrontEndModel->Buscar('post', 'slug', $datos_nuevos['slug']);

                if (!empty($registro_titulo) || !empty($registro_slug)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_titulo)) {
                        $datos['error_titulo'] = 'Este título coincide con otro';
                    }
                    if (!empty($registro_slug)) {
                        $datos['error_slug'] = 'Este slug está en uso';
                    }

                    $vista = array(
                        'vista' => 'web/nuevo_post.php',
                        'params' => $datos,
                        'layout' => 'ly_session.php',
                        'titulo' => 'Crear un nuevo post',
                    );
                    $this->layouts->view($vista);
                } else {
                    //debug($datos_nuevos);
                    //Hay campos que se devuelven vacíos o que simplemente se rellenan automáticamente:
                    $datos_nuevos['id_usuario'] = $_SESSION['id'];
                    unset($datos_nuevos['username']);
                    //$datos_nuevos['imagen_post'] == null ? '' : $datos_nuevos['imagen_post'];
                    $datos_nuevos['visitas'] = 1; 

                    debug($datos_nuevos);

                    $this->FrontEndModel->insert('post', $datos_nuevos);

                    //header('Location: /post/'.$datos_nuevos['id_post']);
                }
            } else {
                //debug($datos);
                if (!empty($verif)) {
                    $datos['rol'] = $verif['rol'];

                    //Se devuelve el error de que el correo ya existe, estaba registrado con anterioridad
                    $vista = array(
                        'vista' => 'web/nuevo_post.php',
                        'params' => $datos,
                        'layout' => 'ly_session.php',
                        'titulo' => 'Crear un nuevo post',
                    );

                    $this->layouts->view($vista);
                }
            }
        } else {
            header('Location: /login');
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
                'rules' => 'trim|required|min_length[2]|max_length[30]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio.',
                    'min_length' => 'El %s debe tener al menos 2 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfanumérico y únicamente con espacios.'
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
                'rules' => 'trim|required|max_length[40]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ(),.;"\'\-\/!¡¿?\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                ),
            ),
            array(
                'field' => 'mensaje',
                'label' => 'mensaje',
                'rules' => 'trim|required|min_length[4]|max_length[2500]|regex_match[/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ(),.;"\'\-\/!¡¿?\s]+$/]',
                'errors' => array(
                    'required' => 'El %s es obligatorio, al menos una línea, para explicar lo que desee plantearnos.',
                    'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                    'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                    'regex_match' => 'El %s puede contener diversos caracteres, pero alguno de los introducidos no es válido.'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == TRUE) {

            foreach ($_POST as $key => $value) {
                $value = str_replace(' ', '-', $value); //Se sustituye cualquier espacio en blanco por una '-'.
                $value = str_replace(PHP_EOL, 'br', $value); //PHP_EOL son los saltos de línea en php. Los traduzco para poder meterlo en la url
                $datos[$key] = $value;
            }
            debug($datos);
            //Se guarda una cadena en forma de url con los datos pasados desde formulario. Dependiendo de si se ha dado el teléfono o no, habrá dos posibles urls
            isset($datos['phone'])
                ? $url = urlencode($datos['username'] . '&' . $datos['email'] . '&' . $datos['phone'] . '&' . $datos['asunto'] . '&' . $datos['mensaje'])
                : $url = urlencode($datos['username'] . '&' . $datos['email'] . '&' . $datos['asunto'] . '&' . $datos['mensaje']);

            //Y la ruta coge de la url los datos y los pasa al controlador pertinente
            header('Location: contacto/enviar-email/' . $url);
            //redirect_back();
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
        if ((comprobar_login() && $_SESSION['rol'] == 1) || (comprobar_login() && $_SESSION['password_hash'] == $datos['usuarios'][0]['password'])) {

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

    /*----------------------Apartado para las funciones que abarca el administrador ---------------------------------------*/

    public function registro_admin()
    {
        $verif = comprobar_login();

        if (!empty($verif) && $verif['rol'] == 'administrador') {

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

                $registro_username = $this->FrontEndModel->Buscar('usuarios', 'username', $datos['username']);
                $registro_correo = $this->FrontEndModel->Buscar('usuarios', 'email', $datos['email']);

                if (!empty($registro_username) || !empty($registro_correo)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_username)) {
                        $datos['error_username'] = 'Este nombre de usuario ya existe';
                    }
                    if (!empty($registro_correo)) {
                        $datos['error_correo'] = 'Este correo ya existe';
                    }
                    debug($datos);
                    //Se devuelve el error de que el correo ya existe, estaba registrado con anterioridad
                    $vista = array(
                        'vista' => 'admin/editar_usuario.php',
                        'params' => $datos,
                        'layout' => 'ly_admin_basico.php',
                        'titulo' => 'Añadir nuevo usuario - ARGaming',
                    );

                    $this->layouts->view($vista);
                } else {

                    if ($datos['password'] == $datos['password_confirm']) {
                        $datos['password'] = md5($datos['password']);
                        unset($datos['password_confirm']);
                    }

                    $this->BackEndModel->insert('usuarios', $datos);

                    header('Location: /admin/panel-control/usuarios');
                }
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
        } else {
            header('Location: /error');
        }
    }

    public function editar_admin()
    {

        $verif = comprobar_login();

        if (!empty($verif) && $verif['rol'] == 'administrador') {

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation'); //llamamos a las reglas de validación

            $config = array(
                array(
                    'field' => 'imagen_post',
                    'label' => 'imagen',
                    'rules' => 'trim',
                    'errors' => array(),
                ),
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

                foreach ($_POST as $key => $value) {
                    $datos_nuevos[$key] = $value;
                    if ($datos_nuevos[$key] == null) {
                        unset($datos_nuevos[$key]);
                    }
                }
                //Se busca que no haya coincidencia, de nombre de usuario o correo, en otros registros de usuarios con id diferente.
                $registro_username = $this->FrontEndModel->Buscar_campo_existente('usuarios', 'id_usuario', $datos_nuevos['id'], 'username', $datos_nuevos['username']);
                $registro_correo = $this->FrontEndModel->Buscar_campo_existente('usuarios', 'id_usuario', $datos_nuevos['id'], 'email', $datos_nuevos['email']);

                if (!empty($registro_correo) || !empty($registro_username)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_username)) {
                        $datos['error_username'] = 'Este nombre de usuario ya existe';
                    }

                    if (!empty($registro_correo)) {
                        $datos['error_correo'] = 'Este correo ya existe';
                    }
                    //El id se obtiene a través del array de segment, dentro de la uri
                    $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

                    $datos['usuarios'] = $info['data'];

                    //debug($datos);

                    $vista = array(
                        'vista' => 'admin/editar_usuario.php',
                        'params' => $datos,
                        'layout' => 'ly_admin_basico.php',
                        'titulo' => 'Editar información del usuario',
                    );
                    $this->layouts->view($vista);
                } else {

                    if (!empty($datos_nuevos['password'])) {
                        $datos_nuevos['password'] = md5($datos_nuevos['password']);
                    }

                    //debug($datos_nuevos);
                    $datos_nuevos['modificado'] = date('Y-m-d H:i:s');
                    $where['id_usuario'] = $datos_nuevos['id'];
                    //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
                    unset($datos_nuevos['id']);

                    $this->BackEndModel->update('usuarios', $datos_nuevos, $where);

                    header('Location: /admin/panel-control/usuarios');
                }
            } else {
                //debug($this->uri);

                $info = $this->BackEndModel->ListarUsuario($this->uri->segment(3));

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
        } else {
            header('Location: /error');
        }
    }

    public function nuevo_post_admin()
    {
        $verif = comprobar_login();

        if (!empty($verif) && $verif['rol'] == 'administrador') {
            $datos['rol'] = $verif['rol'];

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation'); //llamamos a las reglas de validación

            $config = array(
                array(
                    'field' => 'id_usuario',
                    'label' => 'usuario',
                    'rules' => 'trim|required|regex_match[/^[1-9][0-9]*$/]',
                    'errors' => array(
                        'required' => 'Indicar el %s es indispesable para poder crear el post',
                        'regex_match' => 'La selección del %s no es válida'
                    ),
                ),
                array(
                    'field' => 'titulo',
                    'label' => 'título del post',
                    'rules' => 'trim|required|min_length[3]|max_length[100]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.;:"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                        'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                    ),
                ),
                array(
                    'field' => 'slug',
                    'label' => 'slug',
                    'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-z0-9\-]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatoria.',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 50 caracteres de longitud',
                        'regex_match' => 'El %s no puede contener espacios ni caracteres especiales solo guiones (-).'
                    ),
                ),
                array(
                    'field' => 'contenido',
                    'label' => 'contenido',
                    'rules' => 'trim|required|min_length[20]|max_length[5000]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.;:"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio, de lo contrario, ¿qué sentido tendría crear este post?.',
                        'min_length' => 'El %s debe tener al menos 20 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 5000 caracteres de longitud o causaría problemas en base de datos',
                        'regex_match' => 'El %s puede contener todo tipo de caracteres y símbolos excepto alguno que has añadido, revísalo por favor.'
                    ),
                ),
                array(
                    'field' => 'imagen_post',
                    'label' => 'imagen',
                    'rules' => 'trim',
                    'errors' => array(),
                ),
                array(
                    'field' => 'visitas',
                    'label' => 'visitas',
                    'rules' => 'regex_match[/^[0-9]+$/]',
                    'errors' => array(
                        'regex_match' => 'Las visitas solo pueden ser de tipo numérico'
                    ),
                )
            );

            $this->form_validation->set_rules($config);

            /* Se obtiene el listado de usuarios para seleccionarlos en la lista al crear el post*/
            $usuarios = $this->BackEndModel->Lista('usuarios', 'id_usuario');

            $datos['usuarios'] = $usuarios;

            if ($this->form_validation->run() == TRUE) {

                foreach ($_POST as $key => $value) {
                    $datos_nuevos[$key] = $value;
                }

                $registro_titulo = $this->FrontEndModel->Buscar('post', 'titulo', $datos_nuevos['titulo']);
                $registro_slug = $this->FrontEndModel->Buscar('post', 'slug', $datos_nuevos['slug']);

                if (!empty($registro_titulo) || !empty($registro_slug)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_titulo)) {
                        $datos['error_titulo'] = 'Este título coincide con otro';
                    }
                    if (!empty($registro_slug)) {
                        $datos['error_slug'] = 'Este slug está en uso';
                    }

                    $info = $this->BackEndModel->ListarUsuario($this->uri->segment(2));

                    $datos['usuarios'] = $info['data'];

                    //debug($datos);
                    //Se devuelve el error de que el correo ya existe, estaba registrado con anterioridad
                    $vista = array(
                        'vista' => 'admin/nuevo_post.php',
                        'params' => $datos,
                        'layout' => 'ly_admin_basico.php',
                        'titulo' => 'Crear un nuevo post',
                    );

                    $this->layouts->view($vista);
                } else {
                    //debug($datos_nuevos);
                    //Hay campos que se devuelven vacíos o que simplemente se rellenan automáticamente:
                    $datos_nuevos['imagen_post'] == null ? '' : $datos_nuevos['imagen_post'];
                    $datos_nuevos['visitas'] == 0 ? '1' : $datos_nuevos['visitas'];

                    debug($datos_nuevos);

                    $this->BackEndModel->insert('post', $datos_nuevos);

                    //header('Location: /admin/panel-control/post');
                }
            } else {
                //debug($datos);
                $vista = array(
                    'vista' => 'admin/nuevo_post.php',
                    'params' => $datos,
                    'layout' => 'ly_admin_basico.php',
                    'titulo' => 'Crear un nuevo post',
                );

                $this->layouts->view($vista);
            }
        } else {
            header('Location: /error');
        }
    }

    public function editar_post_admin()
    {
        $verif = comprobar_login();

        //debug($verif);

        if (!empty($verif) && $verif['rol'] == 'administrador') {
            $datos['rol'] = $verif['rol'];

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation'); //llamamos a las reglas de validación

            $config = array(
                array(
                    'field' => 'id_usuario',
                    'label' => 'usuario',
                    'rules' => 'trim|required|regex_match[/^[1-9][0-9]*$/]',
                    'errors' => array(
                        'required' => 'Indicar el %s es indispesable para poder crear el post',
                        'regex_match' => 'La selección del %s no es válida'
                    ),
                ),
                array(
                    'field' => 'titulo',
                    'label' => 'título del post',
                    'rules' => 'trim|required|min_length[3]|max_length[100]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.:;"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 30 caracteres de longitud',
                        'regex_match' => 'El %s no cumple con las reglas de formato. Debe ser alfabético y sin espacios.'
                    ),
                ),
                array(
                    'field' => 'slug',
                    'label' => 'slug',
                    'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[A-Za-z0-9\-]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatoria.',
                        'min_length' => 'El %s debe tener al menos 4 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 50 caracteres de longitud',
                        'regex_match' => 'El %s no puede contener espacios ni caracteres especiales solo guiones (-).'
                    ),
                ),
                array(
                    'field' => 'contenido',
                    'label' => 'contenido',
                    'rules' => 'trim|required|min_length[20]|max_length[5000]|regex_match[/^[A-Za-zÁÉÍÓÚñáéíóúÑ0-9(),.;:"\-\/\'!¡¿?\s]+$/]',
                    'errors' => array(
                        'required' => 'El %s es obligatorio, de lo contrario, ¿qué sentido tendría crear este post?.',
                        'min_length' => 'El %s debe tener al menos 20 caracteres de longitud',
                        'max_length' => 'El %s debe tener, como mucho, 5000 caracteres de longitud o causaría problemas en base de datos',
                        'regex_match' => 'El %s puede contener todo tipo de caracteres y símbolos excepto alguno que has añadido, revísalo por favor.'
                    ),
                ),
                array(
                    'field' => 'imagen_post',
                    'label' => 'imagen',
                    'rules' => 'trim|regex_match[%\.(gif|jpe?g|png)$%i]',
                    'errors' => array(
                        'regex_match' => 'La imagen no es válida, inténtelo con otra (que sea .jpg, .jpeg, .gif o .png) por favor'
                    ),
                ),
                array(
                    'field' => 'visitas',
                    'label' => 'visitas',
                    'rules' => 'regex_match[/^[0-9]+$/]',
                    'errors' => array(
                        'regex_match' => 'Las visitas solo pueden ser de tipo numérico'
                    ),
                )
            );


            $this->form_validation->set_rules($config);

            /* Se obtiene el listado de usuarios para seleccionarlos en la lista al crear el post*/
            $usuarios = $this->BackEndModel->Lista('usuarios', 'id_usuario');

            $datos['usuarios'] = $usuarios;

            $info = $this->BackEndModel->ListarPost($this->uri->segment(3));

            $datos['posts'] = $info['data'];

            //debug($datos);

            if ($this->form_validation->run() == TRUE) {

                foreach ($_POST as $key => $value) {
                    $datos_nuevos[$key] = $value;
                    if ($datos_nuevos[$key] == null) {
                        unset($datos_nuevos[$key]);
                    }
                }
                //Se busca que no haya coincidencia, de nombre de usuario o correo, en otros registros de usuarios con id diferente.
                $registro_titulo = $this->FrontEndModel->Buscar_campo_existente('post', 'id_post', $datos_nuevos['id_post'], 'titulo', $datos_nuevos['titulo']);
                $registro_slug = $this->FrontEndModel->Buscar_campo_existente('post', 'id_post', $datos_nuevos['id_post'], 'slug', $datos_nuevos['slug']);

                if (!empty($registro_titulo) || !empty($registro_slug)) { //si el correo o el nombre de usuario ya estuviesen registrados se, guarda y, muestra el error

                    if (!empty($registro_titulo)) {
                        $datos['error_titulo'] = 'Este título coincide con otro';
                    }
                    if (!empty($registro_slug)) {
                        $datos['error_slug'] = 'Este slug está en uso';
                    }

                    $info = $this->BackEndModel->ListarPost($this->uri->segment(3));

                    $datos['posts'] = $info['data'];

                    //debug($datos_nuevos);

                    $vista = array(
                        'vista' => 'admin/editar_post.php',
                        'params' => $datos,
                        'layout' => 'ly_admin_basico.php',
                        'titulo' => 'Editar post',
                    );
                    $this->layouts->view($vista);
                } else {
                    $datos_nuevos['modificado'] = date('Y-m-d H:i:s');
                    debug($datos_nuevos);
                    $where['id_post'] = $datos_nuevos['id_post'];
                    //se quita el id antes de actualizar porque es la clave primaria y no se puede modificar
                    unset($datos_nuevos['id_post']);

                    $this->BackEndModel->update('post', $datos_nuevos, $where);

                    header('Location: /admin/panel-control/post');
                }
            } else {

                $vista = array(
                    'vista' => 'admin/editar_post.php',
                    'params' => $datos,
                    'layout' => 'ly_admin_basico.php',
                    'titulo' => 'Editar post',
                );

                $this->layouts->view($vista);
            }
        } else {
            header('Location: /error');
        }
    }
}
