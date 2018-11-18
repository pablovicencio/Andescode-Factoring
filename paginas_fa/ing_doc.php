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

  $("#finan-gas :input").attr("disabled", true);
  $("#reing").attr("disabled", false);
  $("#reing").css("display", "block");

  if (document.forms['formIngDoc'].otros_desc_ope.value == "") {
    document.forms['formIngDoc'].otros_desc_ope.value = 0;
  }

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

  document.getElementById("divdoc").style.visibility = "hidden";
  document.getElementById("rut_deu").disabled = false;
  document.getElementById("val_rut").style.display = "block";

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

     document.getElementById("monto_financiar").value = totals[5];
     document.getElementById("dif_pre").value = totals[9];

     document.getElementById("com_cob_ope").value = totals[10];
     var iva_com_cob = Math.round(parseInt(totals[10]) * 0.19)
     document.getElementById("iva_com_cob").value = iva_com_cob;
     document.getElementById("com_cob_tot").value = Math.round(parseInt(totals[10]) + parseInt(iva_com_cob));

     document.getElementById("com_ape_ope").value = document.getElementById("ape_ope").value;
     document.getElementById("com_cur_ope").value = document.getElementById("com_cur").value;
     var iva_comi = Math.round((parseInt(document.getElementById("com_cur").value))* 0.19 );
     document.getElementById("iva_comi_tot").value = iva_comi;
     document.getElementById("comi_tot").value = Math.round(parseInt(document.getElementById("ape_ope").value) + parseInt(document.getElementById("com_cur").value) + parseInt(iva_comi));



                var TableData = new Array();

                 $('#docs tr').each(function(row, tr){
                TableData[row]={
                    "rut_deudor" :$(tr).find('td:eq(2)').text()
                }


            }); 

            TableData.shift();  // first row will be empty - so remove
            TableData.shift();

            var docs = TableData.length;
            //console.log(TableData);



            var deudores = eliminarObjetosDuplicados(TableData, 'rut_deudor');

            //console.log(deudores);
            var deudores = deudores.length;


  

               //console.log(document.getElementById('ope').value);
               //console.log(docs);
               //console.log(deudores);

            if (document.getElementById('ope').value == 1) {
                var ga_ope = Math.round(parseInt(deudores)*  parseInt(document.getElementById("not_gas").value) +   parseInt(deudores)*  parseInt(document.getElementById("env_gas").value) + 
                          parseInt(docs)*  parseInt(document.getElementById("proc_gas").value) + parseInt(docs)*  parseInt(document.getElementById("copia_fac_gas").value) + parseInt(deudores)*  parseInt(document.getElementById("cert_gas").value));
            }else {
                 var ga_ope = Math.round(parseInt(docs)*  parseInt(document.getElementById("proc_gas").value));
            }

    document.getElementById("ga_ope").value = ga_ope;

    document.getElementById("descu").value = document.getElementById("otros_desc_ope").value;

    document.getElementById("liqui_ope").value = Math.round(parseInt(totals[5])-parseInt(totals[9])-parseInt(document.getElementById("com_cob_tot").value) - parseInt(document.getElementById("comi_tot").value) - parseInt(ga_ope) - parseInt(document.getElementById("otros_desc_ope").value))
    document.getElementById("exc_ope").value = totals[12];

  });

}

function eliminarObjetosDuplicados(arr, prop) {
     var nuevoArray = [];
     var lookup  = {};
 
     for (var i in arr) {
         lookup[arr[i][prop]] = arr[i];
     }
 
     for (i in lookup) {
         nuevoArray.push(lookup[i]);
     }
 
     return nuevoArray;
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


function reIngFinanGas() {

    swal({
            title: "Reingresar Datos",
            text: "Para reingresar los Datos Financieros y Gastos Operacionales, se eliminaran los documentos ingresados\n¿Esta seguro que desea reingresar estos datos?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
       .then((willDelete) => {
          if (willDelete) {
            $("#docs tbody").remove();
            $("#resumen").find('input:text').val('');
            $("#monto_giro").val('');
            $("#finan-gas :input").attr("disabled", false);
            $("#reing").css("display", "none");


             var totales= "<tr class='total'>"+
          "<td style='display: none'></td>"+
          "<td style='display: none'></td>"+
          "<td>Total</td>"+
          "<td></td>"+
          "<td>0</td>"+
          "<td></td>"+
          "<td>0</td>"+
          "<td></td>"+
          "<td></td>"+
          "<td></td>"+
          "<td>0</td>"+
          "<td>0</td>"+
          "<td>0</td>"+
          "<td>0</td>"+
          "</tr>"
     
          $("#docs").append(totales)

            swal("Ahora puede reingresar los valores y Documentos", {
              icon: "success",
            });
          }
    });
}

function verificador() {
    //See notes about 'which' and 'key'
    //console.log("entra verificador");
  
      var cadena = document.forms['formIngDoc'].rut_deu.value;
      var separador = "-"; // un espacio en blanco
      var limite    = 2;
      arregloDeSubCadenas = cadena.split(separador, limite);
//console.log(arregloDeSubCadenas);
      var M=0,S=1;
        for(;arregloDeSubCadenas[0];arregloDeSubCadenas[0]=Math.floor(arregloDeSubCadenas[0]/10))
          S=(S+arregloDeSubCadenas[0]%10*(9-M++%6))%11;
        //return S?S-1:'k';
          
          var digito = (S?S-1:'k');
        
  

    if (arregloDeSubCadenas[1] != digito ) {
      swal("Error de Rut", "El digito verificador: " + arregloDeSubCadenas[1] + " no corresponde,  deberia ser " + digito, "error");
    }else{
      $.ajax({
                type: "POST",
                url: "../controles/controlValidarRutDeudor.php",
                data:   { "rut" : document.forms['formIngDoc'].rut_deu.value},
                cache: false,
                success: function(respuesta){
            console.log(respuesta);
            if (respuesta == 0) {
                    document.getElementById("rut_desc").style.display = "block";
                    document.getElementById("rut_deu").disabled = true;
                    document.getElementById("nom_deu").readOnly = false;
                    document.getElementById("divdoc").style.visibility = "visible";
                    document.getElementById("val_rut").style.display = "none";
                    document.getElementById("nom_deu").focus();
            }else{
                    document.getElementById("nom_deu").value = respuesta;
                    document.getElementById("rut_deu").disabled = true;
                    document.getElementById("divdoc").style.visibility = "visible";
                    document.getElementById("val_rut").style.display = "none";


            }
        }

            });
    }
}



function CambiaDeudor() {
          document.getElementById("rut_deu").value = '';
          document.getElementById("nom_deu").value = '';
          document.getElementById("divdoc").style.visibility = "hidden";
          document.getElementById("rut_deu").disabled = false;
          document.getElementById("val_rut").style.display = "block";

}




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
            var iva_com_cob = document.getElementById('iva_com_cob').value;
            var iva_comi_tot = document.getElementById('iva_comi_tot').value;
            var ga_ope = document.getElementById('ga_ope').value;
            console.log(fec_ope);
                       
            //console.log(fec_rut);
            
            $.ajax({
                type: "POST",
                url: "../controles/controlGuardarOpe.php",
                data:   { "data" : TableData, "cli":cli,"fec_ope":fec_ope,"tipo_ope":tipo_ope,"tasa_ope":tasa_ope,"com_cob":com_cob,"com_cur":com_cur,"ape_ope":ape_ope,"dia_ope":dia_ope,"otros_desc_ope":otros_desc_ope,
                "monto_giro":monto_giro,"not_gas":not_gas,"env_gas":env_gas,"proc_gas":proc_gas,"copia_fac_gas":copia_fac_gas,"cert_gas":cert_gas, "obs_ope" :obs_ope, "iva_com_cob" :iva_com_cob, "iva_comi_tot" :iva_comi_tot, "ga_ope" :ga_ope},
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
    <div id="finan-gas" name="finan-gas">
    <div class="row" >
    <div class="col-12">
                <h5>Datos Financieros</h5>
    </div>
    <div class="col-4">
          <div class="form-group" "row">
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
          <div class="form-group">
                <label for="cert_gas"> </label>
                <button type="button" class="btn btn-outline-danger" onclick="reIngFinanGas()" id="reing" name="reing" style="display: none">Reingresar</button>
          </div>
    </div>
    </div>
    </div>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalDoc" id="btn-modal_doc" name="btn-modal_doc">Agregar Documento</button><br><br>   


    <table class="table table-sm table-striped table-bordered" id="docs" name="docs">
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

<div id="resumen" name="resumen">
<div class="row">

    <div class="col-4">   
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Monto a Financiar</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="monto_financiar" id="monto_financiar" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Diferencia de precio</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="dif_pre" id="dif_pre" readonly>
        </div>
    </div>


       <div class="col-4">   
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Comisión Cobranza</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="com_cob_ope" id="com_cob_ope" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">IVA Com. Cobranza</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="iva_com_cob" id="iva_com_cob" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Total Com. Cobranza</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="com_cob_tot" id="com_cob_tot" readonly>
        </div>
    </div>


    <div class="col-4">   
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Comisión Apertura</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="com_ape_ope" id="com_ape_ope" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Comisión Curse</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="com_cur_ope" id="com_cur_ope" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">IVA Comisiones</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="iva_comi_tot" id="iva_comi_tot" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Total Comisiones</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="comi_tot" id="comi_tot" readonly>
        </div>
    </div>
</div>        


<div class="row">

    <div class="col-4">   
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Gastos Operacionales</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="ga_ope" id="ga_ope" readonly>
        </div>
        <div class="input-group input-group-sm mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Otros Descuentos</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="descu" id="descu" readonly>
        </div>
    </div>


       <div class="col-4">   
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Líquido</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="liqui_ope" id="liqui_ope" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Excedente a favor Cliente</span>
          </div>
          <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" name="exc_ope" id="exc_ope" readonly>
        </div>
        
    </div>


    
</div>        


          
    <div class="col-12">
    <div class="form-group">
            <label for="monto_giro">Monto Giro:</label>
            <input type="number" class="form-control" id="monto_giro" name="monto_giro" style="width: 500px" required readonly>
          </div>
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
                          <br>
                           <div class="form-group row">

                            <div class="col-4"> 
                                <div class="input-group input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rut Deudor</span>
                                  </div>
                                  <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="rut_deu" name="rut_deu" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}" maxlength="10">
                                </div>
                                <button type="button" class="btn btn-outline-info" onclick="verificador()" id="val_rut" name="val_rut">Validar</button>
                            </div>

                            <div class="col-7"> 
                                <div class="input-group input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nombre Deudor</span>
                                  </div>
                                  <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="nom_deu" name="nom_deu" readonly>
                                </div>
                                <h6><span id="rut_desc" name="rut_in" style="display: none" class="badge badge-info">El rut no fue encontrado, favor ingrese el nombre del deudor</span></h6>
                              </div>
                            </div>
                          <hr>
                          <div name="divdoc" id="divdoc" style="visibility: hidden">
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
                            
                            <button type="button" class="btn btn-outline-danger" onclick="CambiaDeudor()">Cambiar Deudor</button>
                             <button type="button" class="btn btn-outline-info float-right" onclick="agregar()">Agregar</button>
                            <br><br>
                      
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <textarea class="form-control" rows="5" id="obs_ope" name="obs_ope" placeholder="Observación"></textarea><br><br>
          <input type="submit" class="btn btn-info" id="btnDoc" name="btnDoc" value="Guardar Operación" onclick="GuardarOpe()">
  </div>
  
</form> 

</body>
</html>