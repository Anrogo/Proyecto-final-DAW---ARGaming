<div class="header">

    <div class="container-fluid mt-4">
        <div class="row padre">
            <div class="col gray">
                <div class="row h-100 d-flex align-items-center">
                    <div class="col-6 col-sm-3 text-center hijo">
                        <a href="/perfil-usuario" class="btn btn-lg btn-outline-primary botones"><svg class="bi bi-person-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>Mi perfil</a>
                    </div>
                    <div class="col-sm-6 hijo">
                        <a href="/"><img src="/images/logotipo.png" class="img-fluid logotipo" alt="Logotipo"></a>
                    </div>
                    <div class="col-6 col-sm-3 text-center hijo">
                        <a href="/usuario/cerrar-sesion" class="btn btn-lg btn-outline-primary botones"><svg class="bi bi-box-arrow-in-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8.146 11.354a.5.5 0 010-.708L10.793 8 8.146 5.354a.5.5 0 11.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 011 8z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M13.5 14.5A1.5 1.5 0 0015 13V3a1.5 1.5 0 00-1.5-1.5h-8A1.5 1.5 0 004 3v1.5a.5.5 0 001 0V3a.5.5 0 01.5-.5h8a.5.5 0 01.5.5v10a.5.5 0 01-.5.5h-8A.5.5 0 015 13v-1.5a.5.5 0 00-1 0V13a1.5 1.5 0 001.5 1.5h8z" clip-rule="evenodd" />
                            </svg> Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto nav-justified w-75">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Videojuegos</a>
                        <div class="dropdown-menu">
                            <a href="/lista-juegos" class="dropdown-item">Listado de juegos</a>
                            <div class="dropdown-divider"></div>
                            <a href="/" class="dropdown-item">Post</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Foro</a>
                        <div class="dropdown-menu">
                            <a href="/lista-post" class="dropdown-item">Post</a>
                            <div class="dropdown-divider"></div>
                            <a href="/" class="dropdown-item">Autores</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacto">Contacto</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar...">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Busqueda</button>
                </form>
            </div>
        </nav>

        <!-- /.container -->
        <!--  </div>
/. si no se cierra container lo cogen las demás páginas-->