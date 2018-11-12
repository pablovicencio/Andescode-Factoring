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
        $('#rut_cli').val(result[0].rut_cli);/////////////
        $('#nom_cli').val(result[0].nom_cli);/////////////
        $('#tasa_cli').val(result[0].tasa_inicial);/////////////
        $('#com_cob_cli').val(result[0].com_cob_inicial);/////////////
        $('#com_cur_cli').val(result[0].com_cur_inicial);/////////////
        $('#apertura_cli').val(result[0].apertura_inicial);/////////////
        $('#num_cta_cli').val(result[0].nro_cta_cli);/////////////
        $('#lin_cre_cli').val(result[0].linea_cred_cli);/////////////
        $('#fec_cre_cli').val(result[0].fec_cre_cli);/////////////
        $("#usu_cre_cli").val(result[0].usu_cre_cli);/////////////
        $("#mail_cli").val(result[0].mail_cli);/////////////
        $("#gg_cli").val(result[0].gg_cli);/////////////
        $("#gf_cli").val(result[0].gf_cli); /////////////
        $("#bco_cli").val(result[0].bco_cli);/////////////
        $("#fec_ven").val(result[0].venc_lin_cred_cli);/////////////
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

<!-- TABLA NUEVA PARA CREACION CLIENTE-->

<div class="container" id="main" bg="light">  
    <form id="formModCli" onsubmit="return false;">
        <!-- DIV PARA TITULO PRINCIPAL--> 
        <div class="row">
            <div class="col-12 text-center">
                <h3>Modificar Cliente&nbsp;&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i>
            </div>
        </div>
        <hr>
        <!-- CARGA DE GIF LOADING-->
        <div id="loading" style="display: none;">
            <center>
                <img src="../recursos/img/load.gif">
            </center>
        </div>
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
                </select>
        </div>
        <hr>
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
                        <label for="rut">Rut:</label>
                        <input type="text"  class="form-control" id="rut_cli" name="rut_cli" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}" readonly required>
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
                        <label for="mail">Mail:</label>
                        <input type="email" class="form-control" id="mail_cli" name="mail_cli" maxlength="50" required>
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
                  <label for="linea_credito">Línea de Crédito:</label>
                  <input type="number" class="form-control" id="lin_cre_cli" name="lin_cre_cli" required>
              </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="fec_ven">Vencimiento de Linea:</label>
                        <input type="date" class="form-control" id="fec_ven" name="fec_ven"required>    
                </div>
            </div>     
            <div class="col-4">
              <div class="form-group">
                    <label for="tasa">Tasa de Interés:</label>
                    <input type="number" class="form-control" id="tasa_cli" name="tasa_cli" step="any" required>
              </div>
            </div>

            
        </div>
        <!-- DIV COL4 COBRANZA-CURSE - APERTURA-->
        <div class="row">
          <div class="col-4">
            <div class="form-group">
                    <label for="comisionc">Comisión Cobranza:</label>
                    <input type="number" class="form-control" id="com_cob_cli" name="com_cob_cli" step="any" required>     
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
                    <label for="com_cur_cli">Comisión Curse:</label>
                    <input type="number" class="form-control" id="com_cur_cli" name="com_cur_cli" step="any" required>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
                    <label for="Apertura">Apertura:</label>
                    <input type="number" class="form-control" id="apertura_cli" name="apertura_cli" step="any" required>  
            </div>
          </div>
        </div>
        <div class="row">
                                          
            <div class="col-4">
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
            <div class="col-4">
              <div class="form-group">
                  <label for="numero_cuenta">Número de Cuenta:</label>
                  <input type="number" class="form-control" id="num_cta_cli" name="num_cta_cli" required>
              </div>
            </div>
        </div>
        <!-- DIV BOTON ENVIAR CONSULTA-->
        <hr>
        <div class="row">
            <div class="col-12 text-center">
            <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Modificar Cliente">
            </div>
        </div>

<!-- FIN TABLA NUEVA PARA CREACION CLIENTE-->   
  </form>
</div>
</body>
</html>