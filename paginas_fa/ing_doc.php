<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Ingreso de Operación</title>
<?php
  include("../includes/recursosExternos.php");
?>

<script type="text/javascript">


function agregar() {

  console.log(document.forms['formIngDoc'].tasa_ope.value);

  var dif_precio = document.forms['formIngDoc'].finan_doc.value * 
                  (((document.forms['formIngDoc'].tasa_ope.value / 100) / 30)
                    * document.forms['formIngDoc'].plazo_doc.value);

  console.log(dif_precio);

  var com_cob_doc = document.forms['formIngDoc'].monto_doc.value *
                    (((document.forms['formIngDoc'].com_cob.value / 100) / 30) 
                      * document.forms['formIngDoc'].plazo_doc.value);

  console.log(com_cob_doc);

  var monto_ant = document.forms['formIngDoc'].finan_doc.value -
                  dif_precio - com_cob_doc;

  console.log(monto_ant);

  var exc_doc = document.forms['formIngDoc'].monto_doc.value - document.forms['formIngDoc'].finan_doc.value;

  console.log('exc_doc '+exc_doc);

  tabla = document.getElementById('docs');
  tr = tabla.insertRow(tabla.rows.length);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].nom_deu.value;
  td.style.display= "none";
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].tip_doc.value;
  td.style.display= "none";
  



  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].rut_deu.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].nro_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].monto_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].ant_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].finan_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].fec_ope.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].fec_ven_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = document.forms['formIngDoc'].plazo_doc.value;
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = dif_precio.toFixed(0);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = com_cob_doc.toFixed(0);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = monto_ant.toFixed(0);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = exc_doc.toFixed(0);

  td = tr.insertCell(tr.cells.length);
  td.innerHTML ='<input type="button" value="X" onclick="deleteRow(this)" class="btn btn-outline-danger">';

 CalcularTotales();


  //document.getElementById("ModalDoc").reset();

$("#ModalDoc input").each(function() {
      this.value = "";
  })
}


function CalcularTotales()
{
var totals = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
 var $filas= $("#docs tr:not('.total, .encabezado')");

  $filas.each(function() {
    $(this).find('td').each(function(i) {
      if (i != 0 && i != 2 && i != 3 && i != 5 && i != 7 && i != 8 && i != 9)
        totals[i - 1] += parseInt($(this).html());
    });
  });
  $(".total td").each(function(i) {
    if (i != 0 && i != 2 && i != 3 && i != 5 && i != 7 && i != 8 && i != 9)
      $(this).html(totals[i - 1]);
     document.getElementById("monto_giro").value = totals[5];
  });

}


function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("docs").deleteRow(i);
     CalcularTotales()
}


function mod(cli) {
    
     $.ajax({
      url: '../controles/controlCargarDatosCli.php',
      type: 'POST',
      data: {"cli":cli},
      dataType:'json',
      success:function(result){
        $('#lin_fac').val(result[0].linea_cred_cli);
        $('#fec_ven').val(result[0].venc_lin_cred_cli);
        $('#tasa_ope').val(result[0].tasa_inicial);
        $('#com_cob').val(result[0].com_cob_inicial);
        $('#com_cur').val(result[0].com_cur_inicial);
        $('#ape_ope').val(result[0].apertura_inicial);
  }
  })
    
}

function calculo() {
    var monto = document.getElementById("monto_doc").value;
    var porc = document.getElementById("ant_doc").value;
    var finan = Math.floor(monto*porc)/100;
    document.getElementById("finan_doc").value=finan.toFixed(0);
}

function plazo(){
      console.log('entra_plazo');
      var fechaope = new Date(document.getElementById("fec_ope").value).getTime();
      var fechaven    = new Date(document.getElementById("fec_ven_doc").value).getTime();
      var dia_cli    = (document.getElementById("dia_ope").value);

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









function GuardarOpe()
        {
          console.log("entra");
        
            var TableData = new Array();
    
            $('#docs tr').each(function(row, tr){
                TableData[row]={
                  "nom_deudor" : $(tr).find('td:eq(0)').text()
                    ,"tipo_doc" : $(tr).find('td:eq(1)').text()
                    , "rut_deudor" :$(tr).find('td:eq(2)').text()
                    , "nro_doc" : $(tr).find('td:eq(3)').text()
                    , "monto_doc" : $(tr).find('td:eq(4)').text()
                    , "anticipo_porc" : $(tr).find('td:eq(5)').text()
                    , "financiado" : $(tr).find('td:eq(6)').text()
                    , "fec_ope" : $(tr).find('td:eq(7)').text()
                    , "fec_ven" : $(tr).find('td:eq(8)').text()
                    , "plazo" : $(tr).find('td:eq(9)').text()
                    , "dif_precio" : $(tr).find('td:eq(10)').text()
                    , "com_cob" : $(tr).find('td:eq(11)').text()
                    , "anticipo" : $(tr).find('td:eq(12)').text()
                    , "excedente" : $(tr).find('td:eq(13)').text()
                    
                }


            }); 

            TableData.shift();  // first row will be empty - so remove
            TableData.shift();
            TableData = JSON.stringify(TableData);
            $('#tbConvertToJSON').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));

            console.log(TableData);
            var cli = document.getElementById('cli').value;
            var fec_ope = document.getElementById('fec_ope').value;
            var tipo_ope = document.getElementById('ope').value;
            var tasa_ope = document.getElementById('tasa_ope').value;
            var com_cob = document.getElementById('com_cob').value;
            var com_cur = document.getElementById('com_cur').value;
            var ape_ope = document.getElementById('ape_ope').value;
            var dia_ope = document.getElementById('dia_ope').value;
            var otros_desc_ope = document.getElementById('otros_desc_ope').value;
            var monto_giro = document.getElementById('monto_giro').value;
            var not_gas = document.getElementById('not_gas').value;
            var env_gas = document.getElementById('env_gas').value;
            var proc_gas = document.getElementById('proc_gas').value;
            var copia_fac_gas = document.getElementById('copia_fac_gas').value;
            var cert_gas = document.getElementById('cert_gas').value;
            var obs_ope = document.getElementById('obs_ope').value;
            console.log(fec_ope);
                       
            //console.log(fec_rut);
            
            $.ajax({
                type: "POST",
                url: "../controles/controlGuardarOpe.php",
                data:   { "data" : TableData, "cli":cli,"fec_ope":fec_ope,"tipo_ope":tipo_ope,"tasa_ope":tasa_ope,"com_cob":com_cob,"com_cur":com_cur,"ape_ope":ape_ope,"dia_ope":dia_ope,"otros_desc_ope":otros_desc_ope,"monto_giro":monto_giro,"not_gas":not_gas,"env_gas":env_gas,"proc_gas":proc_gas,"copia_fac_gas":copia_fac_gas,"cert_gas":cert_gas, "obs_ope" :obs_ope},
                cache: false,
                success: function(respuesta){
            alert(respuesta);
            //window.location='carga_entrenamiento.php?cli='.concat(cli);
        }

            });
            
        }

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
    <h3>Ingreso de Operación  <i class="fa fa-file-text" aria-hidden="true"></i>
</h3>
    <hr>
  </div>
  </div>
  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>
  
  <form id="formIngDoc" name="formIngDoc" onsubmit="return false;">
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
            <label for="lin_fac">Linea Factoring:</label>
            <input type="text" class="form-control" id="lin_fac" name="lin_fac" readonly>
          </div>
          
          
             
    </div>
    <div class="col-6">   
    <div class="form-group">
                    <label for="monto">Linea Ocupada:</label>
                    <input type="number" class="form-control" id="ocu_cli" name="ocu_cli" readonly>
    </div>
    <div class="col-6">   
    <div class="form-group">
                    <label for="monto">Fecha Operación:</label>
                    <input type="date" class="form-control" id="fec_ope" name="fec_ope" onchange="plazo()" required>
    </div>
    </div>
    </div>
    
  
    </div>
    <hr> 
    <div class="col-12">
      
      <select class="form-control" id="ope" name="ope" style="width: 500px">
          <option value="" selected disabled>Seleccione Tipo de Operación</option>
                     <?php 
                      $re = $fun->cargar_tipo_ope(1);   
                      foreach($re as $row)      
                          {
                            ?>
                            
                             <option value="<?php echo $row['cod_item'] ?>"><?php echo $row['desc_item'] ?></option>
                                
                            <?php
                          }    
                      ?>  
      </select>
    </div>
    <hr>
    <div class="row" >
    <div class="col-12">
                <h5>Datos Financieros</h5>
    </div>
    <div class="col-4">
          <div class="form-group">
            <label for="tasa_ope">Tasa Operación:</label>
            <input type="number" class="form-control" id="tasa_ope" name="tasa_ope" min="0" step="any" required>
          </div>
          <div class="form-group">
            <label for="ape_ope">Apertura:</label>
            <input type="number" class="form-control" id="ape_ope" name="ape_ope" min="0" required>
          </div>
          
          
          
             
    </div>
    <div class="col-4">   
          <div class="form-group">
            <label for="com_cob">Comisión Cobranza:</label>
            <input type="number" class="form-control" id="com_cob" name="com_cob" min="0" step="any" required>
          </div>
          <div class="form-group">
            <label for="com_cur">Otros Descuentos:</label>
            <input type="number" class="form-control" id="otros_desc_ope" name="otros_desc_ope" min="0">
          </div>
          
    </div>
    <div class="col-4">   
          
    <div class="form-group">
            <label for="com_cur">Comisión Curse:</label>
            <input type="number" class="form-control" id="com_cur" name="com_cur" min="0" required>
          </div>
    <div class="form-group">
            <label for="dia_ope">Día Operación:</label>
            <input type="number" class="form-control" id="dia_ope" name="dia_ope" min="1" onchange="plazo()" required>
          </div>
    
  
    </div>

    </div>  
     <hr>
    <div class="row">

      <div class="col-12">
                <h5>Gastos Operacionales</h5>
    </div>
    <div class="col-4">   
          
    <div class="form-group">
            <label for="not_gas">Notificación:</label>
            <input type="number" class="form-control" id="not_gas" name="not_gas" min="0" required>
          </div>
    <div class="form-group">
            <label for="env_gas">Envío por correo:</label>
            <input type="number" class="form-control" id="env_gas" name="env_gas" min="0" required>
          </div>
    
  
    </div>
     <div class="col-4">   
          
    <div class="form-group">
            <label for="proc_gas">Gastos de Proceso:</label>
            <input type="number" class="form-control" id="proc_gas" name="proc_gas" min="0" required>
          </div>
    <div class="form-group">
            <label for="copia_fac_gas">Copia Factura:</label>
            <input type="number" class="form-control" id="copia_fac_gas" name="copia_fac_gas" min="0" required>
          </div>
    
  
    </div>
     <div class="col-4">   
          
    <div class="form-group">
            <label for="cert_gas">Certificado SII:</label>
            <input type="number" class="form-control" id="cert_gas" name="cert_gas" min="0" required>
          </div>
    </div>
    </div>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalDoc" id="btn-modal_doc" name="btn-modal_doc">Agregar Documento</button><br><br>   


            <table class="table table-sm table-dark" id="docs" name="docs">
  <thead>
    <tr class="encabezado">
      <th scope="col"  style="display: none">Nom Deudor</th>
      <th scope="col" style="display: none">Tipo Doc</th>
      <th scope="col" >Rut Deudor</th>
      <th scope="col" >Nro Documento</th>
      <th scope="col">Monto ($)</th>
      <th scope="col">Anticipo (%)</th>
      <th scope="col">Financiado</th>
      <th scope="col">Fecha Operación</th>
      <th scope="col">Fecha Vencimiento</th>
      <th scope="col">Plazo</th>
      <th scope="col">Dif Precio</th>
      <th scope="col">Com. Cobranza</th>
      <th scope="col">Anticipado</th>
      <th scope="col">Excedente</th>

    </tr>
  </thead>

  <tbody>
  </tbody>
  
    <tr class="total">
      <td style="display: none"></td>
      <td style="display: none"></td>
      <td>Total</td>
      <td></td>
      <td>0</td>
      <td></td>
      <td>0</td>
      <td></td>
      <td></td>
      <td></td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
      <td>0</td>
    </tr>
    
</table>

          


          
    <div class="col-12">
    <div class="form-group">
            <label for="monto_giro">Monto Giro:</label>
            <input type="number" class="form-control" id="monto_giro" name="monto_giro" style="width: 500px" required readonly>
          </div>
    </div>
    
    
                <div class="modal fade " id="ModalDoc" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel">Ingreso de Documento</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="col-12">
                           <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Rut Deudor:</label>
                            <div class="col-sm-2">
                            <input type="text" class="form-control" id="rut_deu" name="rut_deu" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}" maxlength="10" >
                            </div>
                            <label class="col-sm-3 col-form-label" >Nombre Deudor:</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" id="nom_deu" name="nom_deu" >
                            </div>
                          </div>
                          <hr>
                           <div class="form-group row">
                            <div class="col-sm-6">
                            <select class="form-control" id="tip_doc" name="tip_doc" >
                                  <option value="" selected disabled>Seleccione Tipo de Documento</option>
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
                            <br>
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Numero Doc:</label>
                            <div class="col-sm-3">
                            <input type="number" class="form-control" id="nro_doc" name="nro_doc" >
                            </div>
                            <label class="col-sm-3 col-form-label float-right" >Fecha Vencimiento:</label>
                            <div class="col-sm-3">
                            <input type="date" class="form-control" id="fec_ven_doc" name="fec_ven_doc" onchange="plazo()">
                            </div>
                          </div>
                           <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Monto ($):</label>
                            <div class="col-sm-3">
                            <input type="number" class="form-control" id="monto_doc" name="monto_doc" onchange="plazo()">
                            </div>
                            <label class="col-sm-2 col-form-label" >Anticipo (%):</label>
                            <div class="col-sm-3">
                            <input type="number" class="form-control" id="ant_doc"  name="ant_doc" min="0" maxlength="100" onchange="calculo()">
                            </div>
                            
                          </div>
                          <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Financiado ($):</label>
                            <div class="col-sm-3">
                            <input type="number" class="form-control" id="finan_doc"  name="finan_doc" readonly>
                            </div>
                            <label class="col-sm-2 col-form-label" >Plazo:</label>
                            <div class="col-sm-3">
                            <input type="number" class="form-control" id="plazo_doc"  name="plazo_doc">
                            </div>
                          </div>
                            <hr>
                            
                            <button type="button" class="btn btn-outline-dark" onclick="agregar()">Agregar</button><br><br>
                      
                      </div>
                    
                  </div>
                </div>
              </div>

          <textarea class="form-control" rows="5" id="obs_ope" name="obs_ope"></textarea>
          <input type="submit" class="btn btn-info" id="btnDoc" name="btnDoc" value="Guardar Operación" onclick="GuardarOpe()">
  </div>
  
</form>

</body>
</html>