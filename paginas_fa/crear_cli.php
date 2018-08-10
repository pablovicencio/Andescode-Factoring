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

<title>Viracocha - Crear Cliente</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

function validar(formCrearUsu){
formCrearUsu.btnAc.value="Creando Usuario";
formCrearUsu.btnAc.disabled=true;
return true}


</script>




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
              <div class="navbar-collapse collapse" id="navb" style="">
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
            </div>
      </nav>

<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Nuevo Cliente</h3>
    <hr>
  </div>
  </div>
  <div class="form-group">
      <div class="row">   
             <div class="col-6">
                 <h5>Datos Personales</h5>
             </div>
            <div class="col-6">
                <h5>Datos Financieros</h5>
            </div>
      </div>

  </div>
  <form id="formCrearCli" method="POST" action="../controles/controlCrearCli.php">

  <div class="row" >
  <div class="col-6">
          <div class="form-group">
            <label for="nom">Nombre o Razón Social:</label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required>
          </div>
          <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="gg_cli">Gerente General:</label>
                  <input type="text" class="form-control" id="gg_cli" name="gg_cli"  maxlength="50" placeholder="Gerente General" required>
                </div>
                <div class="col-6">
                  <label for="gf_cli">Gerente de Finanzas:</label>
                  <input type="text" class="form-control" id="gf_cli" name="gf_cli"  maxlength="50" placeholder="Gerente de Finanzas" required>
                </div>
             </div>
          </div>
          <div class="form-group">
             <label for="rut">Rut:</label>
             <input type="text"  class="form-control" id="rut_cli" name="rut_cli" maxlength="10" placeholder="xxxxxxxx-x"  required>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="email" class="form-control" id="mail_cli" name="mail_cli" maxlength="50"  placeholder="Mail" required>
          </div>    
  </div>
  <div class="col-6">   
  <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="tasa">Tasa de Interés:</label>
                    <input type="text" class="form-control" id="tasa_cli" name="tasa_cli" maxlength="50"  placeholder="Tasa de interés" required>    
                  </div>
                  <div class="col-6">
                    <label for="cobranza">Comisión Cobranza:</label>
                    <input type="text" class="form-control" id="comc_cli" name="comc_cli" maxlength="50"  placeholder="Comisión Cobranza" required>    
                  </div>
              </div>
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="curse">Comisión Curse:</label>
                    <input type="text" class="form-control" id="comcu_cli" name="comcu_cli" maxlength="50" placeholder="Comisión Curse" required>    
                  </div>
              </div>
              </div>
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Crear Cliente" onclick="validar(this)">
          </form>
  </div>
  </div>



</div>
</body>
</html>