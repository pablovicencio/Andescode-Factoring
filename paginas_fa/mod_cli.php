<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Modificar Cliente</title>
<?php
  include("../includes/recursosExternos.php");
?>

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


 
</head>

<body>


<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>



<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Modificar Cliente&nbsp;&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i>
</h3>
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

      </div>   
    </div>
</div>
</form>
</div>
</div>



</div>


</body>
</html>