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

   require_once '../clases/Funciones.php';
  
  

  $fun = new Funciones();    
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Datos Personales</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    #main{
      background: url('../recursos/img/logo/bg.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center; 
      border-radius: 25px;
      padding-top: 5px;
    }
    @media (max-width: 1000px) {
    
        body{font-size: 3.7vw;}

}

  </style>

 
</head>

<body>


      <nav class="navbar navbar-expand-sm ">
              <img class="img-fluid" src="../recursos/img/logo/logo_fa.png" alt="Viracocha" width="150" height="30">
              <ul class="navbar-nav ml-auto" >
               <li class="nav-item">Bienvenido: <br><b><?php echo $_SESSION['nom_fac']; ?></b> </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');"><i style="font-size:24px" class="fa">&#xf08b;</i>Cerrar Sesión</a></li>
              </ul>
      </nav>

  
      
      <nav class="navbar navbar-expand-lg bg-info navbar-dark">
        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navb" >
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
                        <a class="dropdown-item" href="crear_co.php">Informes</a>
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

<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Mis Datos</h3>
    <hr>
  </div>
  </div>
                  <?php
                  $re = $fun->cargar_datos_usu($id,1);   
                  foreach($re as $row)      
                      {
                         
                      }    
                  ?>  
  <div class="row" >
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombres:</label>
            <input type="text" class="form-control" id="nom_usu" name="nom_usu"  value="<?php echo $row['nom'] ?>" readonly>
          </div>
          <div class="form-group">
              <label for="ape">Apellidos</label>
              <input type="text" class="form-control" name="ape_usu" id="ape_usu" value="<?php echo $row['ape'] ?>" readonly>
            </div>
          <div class="form-group">
             <label for="rut">Rut:</label>
             <input type="text"  class="form-control" id="rut_usu" name="rut_usu" value="<?php echo $row['rut'] ?>"  readonly>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="text" class="form-control" id="mail_usu" name="mail_usu" value="<?php echo $row['mail'] ?>"  readonly>
          </div>
           <div class="form-group">
             <label for="perfil">Perfil de Sistema:</label>
             <input type="text" class="form-control" id="perfil_usu" name="perfil_usu" value="<?php echo $row['perfil'] ?>"  readonly>
          </div>
  </div>
  <div class="col-6">
        <div class="form-group">
            <label for="fec">Fecha de Creación:</label>
            <input type="text" class="form-control" id="fec_usu" name="fec_usu"  value="<?php echo date('d-m-Y', strtotime($row['fec'])) ?>" readonly>
          </div>
          <div class="form-group">
              <label for="cargo">Cargo</label>
              <input type="text" class="form-control" name="cargo_usu" id="cargo_usu" value="<?php echo $row['cargo'] ?>" readonly>
            </div>
          <div class="form-group">
             <label for="vig">Vigencia:</label>
             <input type="text"  class="form-control" id="vig_usu" name="vig_usu" value="<?php echo $row['vig'] ?>"  readonly>
          </div>
          <div class="form-group">
             <label for="nick">Nickname:</label>
             <input type="text" class="form-control" id="nick_usu" name="nick_usu" value="<?php echo $row['nick'] ?>"  readonly>
          </div>
  </div>
  </div>



</div>
</body>
</html>