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

<title>Viracocha - Modificar Cliente</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

function mod(cli) {
    
     $.ajax({
      url: '../controles/controlCargarDatosCli.php', 
      type: 'POST',
      data: {"cli":cli},
      dataType:'json',
      success:function(result){
        console.log(result);
        $('#rut_cli').val(result[0].rut_cli);
        $('#nom_cli').val(result[0].nom_cli);
        $('#tasa_cli').val(result[0].tasa_cli);
        $('#com_cob_cli').val(result[0].com_cob_cli);
        $('#com_cur_cli').val(result[0].com_cur_cli);
        $('#apertura_cli').val(result[0].apertura_cli);
        $('#dia_cli').val(result[0].dia_cli);
        $('#fec_cre_cli').val(result[0].fec_cre_cli);
        $("#usu_cre_cli").val(result[0].usu_cre_cli);
        $("#mail_cli").val(result[0].mail_cli);
        $("#otros_desc_cli").val(result[0].otros_desc_cli);
        $("#gg_cli").val(result[0].gg_cli);
        $("#gf_cli").val(result[0].gf_cli);
        $("#ndeudor").val(result[0].not_deudor_gasto);
        $("#envio_correo_gasto").val(result[0].envio_correo_gasto);
        $("#proc_gasto").val(result[0].proc_gasto);
        $("#copia_fac_gasto").val(result[0].copia_fac_gasto);
        $("#sii_cert_gasto").val(result[0].sii_cert_gasto);


        if ((result[0].vig_cli)==1) {  
          $('#vig_cli').prop('checked', true);
              }else  {
                $('#vig_cli').prop('checked', false);
              }

  }
  })
    

}


$(document).ajaxStart(function() {
  $("#formModCli").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formModCli").show();
  });  


$(document).ready(function() {
  $("#formModCli").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlModCli.php',
      data:$("#formModCli").serialize(),
      success: function (result) { 
        var msg = result.trim();
        console.log(result);
        switch(msg) {
                case '0':
                    window.location.assign("../index.html")
                    break;
                case '1':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                default:
                    swal("Cliente Modificado", msg, "success");
                    //location.reload(true);
            }
      },
      error: function(){
              alert('Verifique los datos')      
        }
    });
    return false;
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
                <li class="nav-item"><a class="nav-link" href="#.php">Deudores</a></li>
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
    <h3>Modificar Cliente</h3>
    <hr>
  </div>
  </div>

  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>
    <form id="formModCli" onsubmit="return false;"  >
    <div class="col-12">
      <select class="form-control" id="cli" name="cli" style="width: 500px" onchange="mod(this.value)">
          <option value="" selected disabled>Seleccione Cliente</option>
                     <?php 
                      $re = $fun->cargar_clientes(1);   
                      foreach($re as $row)      
                          {
                            ?>      
                             <option value="<?php echo $row['id_cli'] ?> ">
                             <?php echo $row['nom_cli'] ?>
                             </option>
                                
                            <?php
                          }    
                      ?>  
      </select><hr>
    </div>



  <div class="row" >
    <div class="col-6">
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                <label for="nom">Nombre o Razón Social:</label>
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required>
                </div>
            </div>
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
            <input type="text"  class="form-control" id="rut_cli" name="rut_cli" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}" readonly required>
        </div>
        <div class="form-group">
            <label for="mail">Mail:</label>
            <input type="email" class="form-control" id="mail_cli" name="mail_cli" maxlength="50" required>
        </div> 
        <div class="form-group">
            <label for="fec">Fecha de Creación:</label>
            <input type="text" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
        </div> 
        <div class="form-group">
                    <label for="dia">Días:</label>
                    <input type="number" class="form-control" id="dia_cli" name="dia_cli" required> 
        </div>      
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="tasa">Tasa de Interés:</label>
                    <input type="number" class="form-control" id="tasa_cli" name="tasa_cli" step="any" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="comisionc">Comisión Cobranza:</label>
                    <input type="number" class="form-control" id="com_cob_cli" name="com_cob_cli" step="any" required>  
                </div> 
            </div>
        </div> 
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="com_cur_cli">Comisión Curse:</label>
                    <input type="number" class="form-control" id="com_cur_cli" name="com_cur_cli" step="any" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="Apertura">Apertura:</label>
                    <input type="number" class="form-control" id="apertura_cli" name="apertura_cli" step="any" required>  
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="desc">Otros Descuentos:</label>
                    <input type="number" class="form-control" id="otros_desc_cli" name="otros_desc_cli" required>    
                </div>  
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="notificacion">Notificación Deudor:</label>
                    <input type="number" class="form-control" id="ndeudor" name="ndeudor" required>    
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="envio">Envió por Correo:</label>
                    <input type="number" class="form-control" id="envio_correo_gasto" name="envio_correo_gasto" required> 
                </div>
            </div>
           <div class="col-6">
                <div class="form-group">
                    <label for="PROC_GASTO">Gastos Procesamiento:</label>
                    <input type="number" class="form-control" id="proc_gasto" name="proc_gasto" required>    
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="facfot">Fotocopia Factura:</label>
                    <input type="number" class="form-control" id="copia_fac_gasto" name="copia_fac_gasto" required> 
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="PROC_GASTO">Certificado SII:</label>
                    <input type="number" class="form-control" id="sii_cert_gasto" name="sii_cert_gasto" required>    
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="vig_cli" id="vig_cli"> Vigencia</label>
                </div>
            </div>   
        </div>
        
        <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Modificar Cliente" >

        <!--
        <div class="row">
            <div class="col-6">
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="vig_cli" id="vig_cli"> Vigencia</label>
                </div>
            </div>   
        </div> 










<!--
        <div class="col-6">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalGastos" id="btn-modal" name="btn-modal">Agregar Gastos Operacionales</button><br><br>
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
            </div>-->
        </div>   
    </div>
</div>
</form>
</div>
</div>



</div>

<!-- DIV DE PRUEBA! -->




</body>
</html>