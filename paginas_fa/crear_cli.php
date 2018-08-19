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

</head>

<body>


<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>


<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Nuevo Cliente&nbsp;&nbsp;<i class="fa fa-plus-square" aria-hidden="true"></i>
</h3>
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