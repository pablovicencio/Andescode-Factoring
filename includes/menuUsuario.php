
<body>
    <nav class="navbar navbar-expand-md navbar-dark" style ="background-color:#0c2e8a ">
        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navb" >
              <ul class="navbar-nav" >
                <li class="nav-item "><a class="nav-link" href="datos_pers.php">Mis Datos</a></li> 
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_cli.php">Crear Cliente</a>
                        <a class="dropdown-item" href="mod_cli.php">Modificar Cliente</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="#.php">Deudores</a></li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Operaciones</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="ing_doc.php">Ingresar Operación</a>
                        <a class="dropdown-item" href="crear_ope.php">Modificar Operación</a>
                        <a class="dropdown-item" href="crear_ope.php">Revisar</a>
                        <a class="dropdown-item" href="crear_ope.php">Aprobar</a>
                        <a class="dropdown-item" href="crear_ope.php">Anular</a>

                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="#">Informes</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_usu.php">Crear Usuario</a>
                        <a class="dropdown-item" href="mod_usu.php">Modificar Usuario</a>
                      </div>
                    </li>
              </ul>
            </div>
      </nav> 
</body>
