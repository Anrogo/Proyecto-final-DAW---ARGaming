<h2>Contacto</h2>
<form action="contacto/enviar" method="post">
    Correo electronico: <br/>
    <input type="email" name="email" /><br/>
    Asunto: <br/>
    <input type="text" name="asunto" /><br/>
    Mensaje:<br/>
    <textarea name="mensaje"></textarea><br/>
    <input type="submit" name="submit" value="Enviar"/>
</form>
<?php
if($this->session->flashdata('envio')){
    echo $this->session->flashdata('envio');
}
?>