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

$(document).ajaxStart(function() {
  $("#formCrearCli").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formCrearCli").show();
  });  


$(document).ready(function() {
  $("#formCrearCli").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlCrearCli.php',
      data:$("#formCrearCli").serialize(),
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '1':
                    swal("Rut Duplicado", "El RUT ya se encuentra en el sistema, puede encontrarse sin vigencia", "warning");
                    break;
                case '2':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                case '3':
                    swal("Error Mail", "Favor ingrese un correo electronico para enviar las credenciales", "warning");
                    break;
                default:
                    swal("Usuario Creado", msg, "success");
            }
      },
      error: function(){
              alert('Verifique los datos')      
        }
    });
    return false;
  });
});

$(document).ready(function(){
    $("#rut_cli").keyup(function(){
        $("#btn-modal").css("display", "inline");
    });
});
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
    #btn-modal{
      display: none;
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
                <li class="nav-item"><a class="nav-link" href="#.php">Deudores</a></li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Documentos</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="ing_doc.php">Ingresar</a>
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
    <h3>Nuevo Cliente</h3>
    <hr>
  </div>
  </div>
  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
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
  <form id="formCrearCli" onsubmit="return false;">

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
                  <input type="text" class="form-control" id="gg_cli" name="gg_cli"  maxlength="50"  required>
                </div>
                <div class="col-6">
                  <label for="gf_cli">Gerente de Finanzas:</label>
                  <input type="text" class="form-control" id="gf_cli" name="gf_cli"  maxlength="50" required>
                </div>
             </div>
          </div>
          <div class="form-group">
             <label for="rut">Rut:</label>
             <input type="text"  class="form-control" id="rut_cli" name="rut_cli" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}"  required>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="email" class="form-control" id="mail_cli" name="mail_cli" maxlength="50" required>
          </div>    
  </div>
  <div class="col-6">   
  <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="tasa">Tasa de Interés:</label>
                    <input type="number" class="form-control" id="tasa_cli" name="tasa_cli" step="any" required>
                  </div>
                  <div class="col-6">
                    <label for="cobranza">Comisión Cobranza:</label>
                    <input type="number" class="form-control" id="comc_cli" name="comc_cli" step="any" required>   
                  </div>
              </div>
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="curse">Comisión Curse:</label>
                    <input type="number" class="form-control" id="comcu_cli" name="comcu_cli"  required>    
                  </div>
                  <div class="col-6">
                    <label for="apertura">Apertura:</label>
                    <input type="number" class="form-control" id="aper_cli" name="aper_cli" required>    
                  </div>
              </div>
              </div>
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="desc">Otros Descuentos:</label>
                    <input type="number" class="form-control" id="otros_desc_cli" name="otros_desc_cli" required>    
                  </div>
                  <div class="col-6">
                    <label for="apertura">Días:</label>
                    <input type="number" class="form-control" id="dias_cli" name="dias_cli" required>    
                  </div>
              </div>
              </div>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalGastos" id="btn-modal" name="btn-modal">Agregar Gastos Operacionales</button><br><br>
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Crear Cliente"> <h6>*Recuerde agregar los Gastos Operacionales</h6>
          

                <div class="modal fade " id="ModalGastos" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Gastos Operacionales</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="col-12">

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" >Notificación Deudor:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="not_deu" style="width: 60%;" name="not_deu" required>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" >Envio por correo:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="envio_correo"  style="width: 60%;" name="envio_correo" required>
                            </div>
                            <br>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" >Gastos Procesamiento:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="proc_gas" style="width: 60%;" name="proc_gas" required>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" >Fotocopia Factura:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="copia_fac"  style="width: 60%;" name="copia_fac" required>
                            </div>
                            <br>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label" >Certificado SII:</label>
                            <div class="col-sm-6">
                            <input type="number" class="form-control" id="sii_cert" style="width: 60%;" name="sii_cert" required>
                            </div>
                          </div>
                            <br>
                      </div>
                    
                  </div>
                </div>
              </div>

          </form>
  </div>
  </div>



</div>

</body>
</html>