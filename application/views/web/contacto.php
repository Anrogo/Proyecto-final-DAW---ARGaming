
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <span class="font-italic">Contáctenos</span>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="nombre" class="sr-only">Nombre</label>
                                    <input id="name" name="name" type="text" placeholder="Su nombre de usuario" class="form-control input" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="email" class="sr-only">Correo</label>
                                    <input id="email" name="email" type="text" placeholder="Dirección de correo electrónico para poder responderle" class="form-control input">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="phone" class="sr-only">Teléfono</label>
                                    <input id="phone" name="phone" type="text" placeholder="Su número de teléfono (opcional)" class="form-control input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="asunto" class="sr-only">Asunto</label>
                                    <input id="asunto" name="asunto" type="text" placeholder="Asunto del mensaje" class="form-control input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                <label for="mensaje" class="sr-only">Mensaje</label>
                                    <textarea class="form-control input" id="mensaje" name="mensaje" placeholder="Introduzca aquí el mensaje que quiera transmitirnos. Tendrá nuestra respuesta lo antes posible! Gracias" rows="7"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="text-center cancelar">
                        <a href="/" class="text-black">Cancelar y volver a la página de inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container -->