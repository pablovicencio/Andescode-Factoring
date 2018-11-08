<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Crear Cliente</title>

<?php
  include("../includes/recursosExternos.php");
?>

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
                    swal("Cliente Creado", msg, "success");
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

</head>

<body>


<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>


<!-- TABLA NUEVA PARA CREACION CLIENTE-->

<div class="container" id="main" bg="light">  
    <form id="formCrearCli" onsubmit="return false;">
        <!-- DIV PARA TITULO PRINCIPAL--> 
        <div class="row">
            <div class="col-12">
                <h3 "text-align">Nuevo Cliente&nbsp;&nbsp;<i class="fa fa-plus-square" aria-hidden="true"></i></h3>
            </div>
        </div>
        <hr>
        <!-- CARGA DE GIF LOADING-->
        <div id="loading" style="display: none;">
            <center>
                <img src="../recursos/img/load.gif">
            </center>
        </div>
        <!-- DIV TITULO 1-->
        <div class="row">
            <div class="col-12">
                <h5>Datos Corporativos</h5>
            </div>
        </div>  
        <!-- DIV RAZON SOCIAL Y GERENTE GENERAL-->  
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                  <label for="nom">Nombre o Razón Social:</label>
                  <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="gg_cli">Gerente General:</label>
                    <input type="text" class="form-control" id="gg_cli" name="gg_cli"  maxlength="50"  required>
                </div>
            </div>
        </div>
        <!-- DIV RUT GERENTE FINANZAS-->
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="rut_cli">Rut:</label>
                    <input type="text"  class="form-control" id="rut_cli" name="rut_cli" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}"  required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="gf_cli">Gerente de Finanzas:</label>
                    <input type="text" class="form-control" id="gf_cli" name="gf_cli"  maxlength="50" required>
                </div>
            </div>
        </div>
        <!-- DIV MAIL SOLO-->
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="mail_cli">Mail:</label>
                    <input type="email" class="form-control" id="mail_cli" name="mail_cli" maxlength="50" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="bco_cli">Banco Cliente:</label>
                    <select class="form-control" name="bco_cli" id="bco_cli" required>
                          <option value="" selected disabled>Seleccione el Banco</option>
                                       <?php 
                                        $re = $fun->cargar_bcos(1);   
                                        foreach($re as $row)      
                                            {
                                              ?>
                                               <option value="<?php echo $row['cod_item'] ?>"><?php echo $row['desc_item'] ?></option>
                                                  
                                              <?php
                                            }    
                                        ?>       
                        </select>
                </div>
            </div>
        </div>
        <!-- DIV TITULO 2-->
        <hr>
        <div class="row">
            <div class="col-12">
                <h5>Datos Financieros</h5>
            </div>
        </div>  
        <!-- DIV COL4 TASA - CUENTA - LINEACREDITO-->
        <div class="row">
            <div class="col-4">
              <div class="form-group">
                  <label for="tasa">Tasa de Interés Inicial:</label>
                  <input type="number" class="form-control" id="tasa_cli_ini" name="tasa_cli_ini" step="any" required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                  <label for="num_cta_cli">Número de Cuenta:</label>
                  <input type="number" class="form-control" id="num_cta_cli" name="num_cta_cli" required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                  <label for="lin_cre_cli">Línea de Crédito:</label>
                  <input type="number" class="form-control" id="lin_cre_cli" name="lin_cre_cli" required>
              </div>
            </div>
        </div>
        <!-- DIV COL4 COBRANZA-CURSE - APERTURA-->
        <div class="row">
          <div class="col-4">
            <div class="form-group">
                <label for="cobranza">Comisión Cobranza:</label>
                <input type="number" class="form-control" id="comc_cli_ini" name="comc_cli_ini" step="any" required>   
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
                <label for="curse">Comisión Curse:</label>
                <input type="number" class="form-control" id="comcu_cli_ini" name="comcu_cli_ini"  required>          
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
                <label for="apertura">Apertura:</label>
                <input type="number" class="form-control" id="aper_cli_ini" name="aper_cli_ini" required>    
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="fec_ven">Fecha de Vencimiento:</label>
                    <input type="date" class="form-control" id="fec_ven" name="fec_ven"required>    
            </div>
          </div>  
       </div>
        <!-- DIV BOTON ENVIAR CONSULTA-->
        <hr>
        <div class="row">
            <div class="col-12 text-center">
                <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Crear Cliente">
            </div>
        </div>

<!-- FIN TABLA NUEVA PARA CREACION CLIENTE-->   
  </form>
</div>


</body>
</html>