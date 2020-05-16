var expr_username = new RegExp(/^[0-9A-Za-zÁÉÍÓÚñáéíóúÑ_]+$/);
var expr_text = new RegExp(/^[A-Za-zÁÉÍÓÚñáéíóúÑ_\s]+$/);
var expr_email = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
var expr_pass = new RegExp(/^[0-9A-Za-z!@#$&*_-]\S{8,16}$/);
var expr_bool = new RegExp(/[0-1]/);

$(document).ready(function(){
    
    $('#submit').on('click',function(){
        $('.error').html('');//borra los error que pudiera haber de antes
        var username = $('#username').val();
        var nombre = $('#nombre').val();
        var apellidos = $('#apellidos').val();
        var email = $('#email').val();
        var pass = $('#password').val();
        var pass_confirm = $('#password_confirm').val();
        var rol = $('#rol').val();
        var comparar = pass === pass_confirm;
        //alert(username + "->" + expr_username.test(username));
        //alert(nombre + "->" + expr_text.test(nombre));
        //alert(apellidos + "->" + expr_text.test(apellidos));
        //alert(email + "->" + expr_email.test(email));
        //alert(pass + "->" + expr_pass.test(pass));
        //alert(pass_confirm + "->" + expr_pass.test(pass_confirm));
        //alert(rol + "->" + expr_bool.test(rol));
        //alert("Las contraseñas coinciden: " + comparar);

        //Se crea un array donde todo debe ser TRUE, si no se buscará el fallo y se le devuelve al formulario
        var array_campos = [expr_username.test(username),expr_text.test(nombre),expr_text.test(apellidos),expr_email.test(email),expr_pass.test(pass),comparar,expr_bool.test(rol)];
        var array_errores = new Array();

        array_errores[0] = 'El nombre de usuario es incorrecto. No se permiten espacios ni caracteres especiales (excepto \'_\')';//username
        array_errores[1] = 'El nombre es incorrecto, solo se permiten caracteres alfabéticos (a-z)';//El nombre solo puede contener letras y espacios en blanco
        array_errores[2] = 'Los apellidos son incorrectos, solo se permiten caracteres alfabéticos (a-z)';//Igual que el nombre
        array_errores[3] = 'El formato de su correo no es válido (ej.:nombre_usuario_2@servidor_email.es)';//El correo debe cumplir con el formato estándar con @ + dominio del servidor
        array_errores[4] = 'La contraseña no es correcto. Para ser válida debe contener números, letras y más de 8 caracteres.';//Si la contraseña no cumple los mínimos de seguridad dará error
        array_errores[5] = 'Las contraseñas no coinciden';//Si la segunda contraseña no es exactamente igual que la primera dará error
        array_errores[6] = 'El rol elegido no existe';//rol. No debe dar error puesto que se elige con un select

        var cont_error = 0;

        for(let i=0; i<array_campos.length; i++){

            if(!array_campos[i]){
                $('#campo'+(i+1)).html(array_errores[i]);
                cont_error++;
            }
        }
        if(cont_error > 0){
            $('#cont_error').html('Tiene '+cont_error+' error/es. Revise el formulario antes de enviarlo');
        }
        
        //Para mostrar un mensaje bajo el campo: 
        //$('#campo1').html(array_campos[0]);

        if(verificar_true(array_campos) == true){
           //location.href = "/admin/registrar-usuario";// Debe ponerse la ruta de inserción del nuevo registro
           realizaProceso(username,nombre,apellidos,email,pass,comparar,rol);
        }

    });
});

/**
 * Función que verifica que todos los valores del array (los campos cumplen con la expresión regular impuesta) son true
 * 
 * @param {array} array 
 */
function verificar_true(array){
    var cont_error = 0;
    var array_errores = new Array();
    for(let i=0; i<array.length; i++){
        //alert(array[i]);
        if(!array[i]){
            array_errores[i] = 0;
            cont_error++;
        }
    }
    //si no hay ningún false, el array se quedará vacío y no se devuelven error al formulario
    //alert(array);
    //alert(array_error);
    if(cont_error == 0){
        return true;
    } else {
        return false
    }

}

/**
 * Función que realiza la petición AJAX al archivo de php. Cada valor se corresponde con un campo del formulario
 * 
 * @param {string} valor1
 * @param {string} valor2
 * ... 
 */
function realizaProceso(valor1, valor2, valor3, valor4, valor5, valor6, valor7) {
    var parametros = {
        "username": valor1,
        "nombre": valor2,
        "apellidos": valor3,
        "email": valor4,
        "password": valor5,
        "comparar": valor6,
        "rol": valor7,
    };
    $.ajax({
        data: parametros, //datos que se envian a traves de ajax
        url: '/admin/registrar-usuario', //ruta que recibe la peticion y la información del post
        type: 'post', //método de envio
        /*
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            $("#resultado").html(response);
        }
        */
    });
}

