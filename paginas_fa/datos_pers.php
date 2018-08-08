<?php 
session_start(); 
if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) ){
    //Si la sesión esta seteada no hace nada
    $id = $_SESSION['id_fac'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../index.html");
  }      
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Datos Personales</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 
</head>

<body>


      <nav class="navbar navbar-expand-sm ">
              <img class="img-fluid" src="../recursos/img/logo/logo_fa.png" alt="Viracocha" width="150" height="30">
              <ul class="navbar-nav ml-auto" >
               <li class="nav-item">Bienvenido: <?php echo $_SESSION['nom_fac']; ?></li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');">Cerrar Sesión</a></li>
              </ul>
      </nav>

  
  
      <nav class="navbar navbar-expand-sm bg-info navbar-dark">
              <ul class="navbar-nav" >
                <li class="nav-item"><a class="nav-link" href="datos_pers.php">Mis Datos</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_cli.php">Crear Cliente</a>
                        <a class="dropdown-item" href="mod_cli.php">Modificar Cliente</a>
                      </div>
                    </li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Deudores</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_co.php">Crear Deudor</a>
                        <a class="dropdown-item" href="mod_co.php">Modificar Deudor</a>
                      </div>
                    </li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Documentos</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_co.php">Ingresar</a>
                        <a class="dropdown-item" href="mod_co.php">Operaciones</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="#">Informes</a></li>
              </ul>
      </nav>
  <div class="container" >
  </div>
</body>
</html>