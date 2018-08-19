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


function mod(cli) {
    
     $.ajax({
      url: '../controles/controlCargarDiaCli.php',
      type: 'POST',
      data: {"cli":cli},
      dataType:'html',
      success:function(result){
        $('#dia_cli').val(result);
        plazo();

  }
  })
    
}

function calculo() {
    var monto = document.getElementById("monto_doc").value;
    var porc = document.getElementById("ant_doc").value;
    document.getElementById("finan_doc").value=Math.floor(monto*porc)/100;
}

function plazo(){

      var fechaope = new Date(document.getElementById("fec_ope_doc").value).getTime();
      var fechaven    = new Date(document.getElementById("fec_ven_doc").value).getTime();
      var dia_cli    = (document.getElementById("dia_cli").value);

      if (isNaN(fechaope) == false && isNaN(fechaven) == false && dia_cli != '') {
        var diff = fechaven - fechaope;  
        diff = (diff/(1000*60*60*24));
          var dia = new Date(document.getElementById("fec_ven_doc").value).getUTCDay();
          switch (dia) {
            case 0:
                dia = 4;
                break;
            case 1:
                dia = 2;
                break;
            case 2:
                dia = 2;
                break;
            case 3:
                dia = 2;
                break;
            case 4:
                dia = 4;
                break;
            case 5:
                dia = 4;
                break;
            case  6:
                dia = 5;
          }
        document.getElementById("plazo_doc").value = (Number(diff)+Number(dia_cli)+Number(dia));
      }
}


$(document).ajaxStart(function() {
  $("#formIngDoc").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formIngDoc").show();
  });  


$(document).ready(function() {
  $("#formIngDoc").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlIngDoc.php',
      data:$("#formIngDoc").serialize(),
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '2':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                default:
                    swal("Documento Ingresado", msg, "success");
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
    <h3>Ingreso de Documento&nbsp;&nbsp;<i class="fa fa-file-text" aria-hidden="true"></i>
</h3>
    <hr>
  </div>
  </div>
  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>
  
  <form id="formIngDoc" onsubmit="return false;">
    <div class="col-12">
      <select class="form-control" id="cli" name="cli" style="width: 500px" onchange="mod(this.value)">
          <option value="" selected disabled>Seleccione Cliente</option>
                     <?php 
                      $re = $fun->cargar_clientes(1);   
                      foreach($re as $row)      
                          {
                            ?>
                            
                             <option value="<?php echo $row['id_cli'] ?>"><?php echo $row['nom_cli'] ?></option>
                                
                            <?php
                          }    
                      ?>  
      </select><hr>
    </div>

  <div class="row" >
  <div class="col-6">
          <div class="form-group">
             <label for="rut">Rut Deudor:</label>
             <input type="text"  class="form-control" id="rut_deu" name="rut_deu" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}"  required>
          </div>
          <div class="form-group">
            <label for="nom">Nombre Deudor:</label>
            <input type="text" class="form-control" id="nom_deu" name="nom_deu"  maxlength="100" required>
          </div>
          <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="tip_doc">Tipo de Documento:</label>
                   <select class="form-control" id="tip_doc" name="tip_doc" >
                        <option value="" selected disabled>Seleccione Tipo Doc</option>
                                   <?php 
                                    $re = $fun->cargar_tipo_doc(1);   
                                    foreach($re as $row)      
                                        {
                                          ?>
                                          
                                           <option value="<?php echo $row['cod_item'] ?>"><?php echo $row['desc_item'] ?></option>
                                              
                                          <?php
                                        }    
                                    ?>  
                    </select>
                </div>
                <div class="col-6">
                  <label for="num_doc">Número de Documento:</label>
                  <input type="number" class="form-control" id="num_doc" name="num_doc"  required>
                </div>
             </div>
          </div>

          <div class="row">
                  <div class="col-6">
                    <label for="fec_ope">Fecha de Operación:</label>
                    <input type="date" class="form-control" id="fec_ope_doc" name="fec_ope_doc" onchange="plazo()" required>
                  </div>
                  <div class="col-6">
                    <label for="fec_ven">Fecha de Vencimiento:</label>
                    <input type="date" class="form-control" id="fec_ven_doc" name="fec_ven_doc" onchange="plazo()" required>   
                  </div>
              </div><br>
          
             
  </div>
  <div class="col-6">   
  <div class="form-group">
              
                    <label for="monto">Monto ($):</label>
                    <input type="number" class="form-control" id="monto_doc" name="monto_doc" min="1" onkeyup="calculo()"  required>
              
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="anticipo">Anticipo (%):</label>
                    <input type="number" class="form-control" id="ant_doc" name="ant_doc" min="1" max="100" onkeyup="calculo()" required>   
                  </div>
                  <div class="col-6">
                    <label for="financiado">Financiado ($):</label>
                    <input type="number" class="form-control" id="finan_doc" name="finan_doc" readonly>    
                  </div>
              </div>
              </div>
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="dia">Dia +/-:</label>
                    <input type="number" class="form-control" id="dia_cli" name="dia_cli" readonly>    
                  </div>
                  <div class="col-6">
                    <label for="plazo">Plazo:</label>
                    <input type="text" class="form-control" id="plazo_doc" name="plazo_doc" required>    
                  </div>
              </div>
              </div>
          
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Ingresar Documento">
          

                

          </form>
  </div>
  </div>



</div>

</body>
</html>