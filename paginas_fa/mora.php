<?php 
  include("../includes/validaSesion.php");
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
  $idope = $_GET["idope"];
  $num_fac = $_GET["numfac"];
  $fec_actual = date("d-m-Y", time()); 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Mora</title>
<?php
  include("../includes/recursosExternos.php");
  
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="http://momentjs.com/downloads/moment.js"></script>

<script type="text/javascript">

window.onload = mod(<?php echo $num_fac ?>);



//RELLENO DE DATOS DEL DOCUMENTO
function mod(doc) {
    
    $.ajax({
     url: '../controles/controlCargarDatosDoc.php', 
     type: 'POST',
     data: {"numfac":doc},
     dataType:'json',
     success:function(result)
     {
       console.log(result);

        $('#abonocapital').val(result[0].abono_capital);
        $('#forma_pago_doc').val(result[0].tipo_depo);
        $('#bco_depo_deu').val(result[0].bco_deposito);
        $('#fec_depo').val(result[0].fec_depo_);
        $('#obs_doc').val(result[0].obs_doc);
        $('#total_cobrar').val(result[0].total_cobrar_mora);
        $('#dias_mora').val(result[0].dias_mora);
        $('#monto').val(result[0].monto_finan_doc);
        if ((result[0].vb_admin)==1){$('#vba').prop('checked', true);}else{$('#vba').prop('checked', false);}
        if ((result[0].vb_comercial)==1){$('#vbc').prop('checked', true);}else{$('#vbc').prop('checked', false);}
        if ((result[0].vb_general)==1){$('#vbg').prop('checked', true);}else{$('#vbg').prop('checked', false);}
    }
 })
   

}

function revisar(){

}
//FIN DE LECTURA DE DOCUMENTO

$(document).ajaxStart(function() {
  $("#formCurFac").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formCurFac").show();
  });  


$(document).ready(function() {
  $("#formCurFac").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlModDoc.php',
      data:$("#formCurFac").serialize(),
      success:function (result) 
      { 
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
                    swal("Documento Modificado.", msg, "success");
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














function calculomora(){
var fecha1 = new Date(document.getElementById("fec_venc").value).getTime();
var fecha2 = new Date(document.getElementById("fec_pag").value).getTime();
var diff = fecha2 - fecha1;
diff = (diff/(1000*60*60*24));
document.getElementById("dias_mora").value = diff;
}


function calculartotales(){

    var monto = (document.getElementById("monto").value);
    var tasa = (document.getElementById("tasa").value);
    var abonocapital = (document.getElementById("abonocapital").value);
    var diasmora = (document.getElementById("dias_mora").value);
    var total = ((monto-abonocapital)*tasa);
    total = total * (parseInt(diasmora)+parseInt(2));
    total = Math.round(((total/30)/100));
    document.getElementById("total_cobrar").value = total;
    document.getElementById("intereses").value = total;


}



</script>


</head>

<body>


<!-- TABLA NUEVA PARA MODIFICACION CURSATURA-->

<div class="container" id="main" bg="light">  
    <form id="formCurFac" onsubmit="return false;">
        <!-- DIV PARA TITULO PRINCIPAL--> 
        <div class="row">
            <div class="col-12 text-center">
                <h3>Mora Operación:&nbsp;&nbsp;<?php echo $idope ?><i class="fa fa-reply-all" aria-hidden="true"></i>
                <h4 id="num_fac" name="num_fac">N° de Documento: &nbsp;&nbsp;<?php echo $num_fac ?></h4>
                <br>
            </div>
        </div>
        <hr>
        <!-- Sucursal y Fecha--> 
        <div class="row ">
            <div class="col-md-6">
                <label for="nom">Sucursal&nbsp;<i class="fa fa-building" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Principal" required readonly> 
            </div>
            <div class="col-md-6">
                <label for="fec">Fecha&nbsp;<i class="fa fa-calendar" aria-hidden="true">&nbsp;</i>:</label>
                <input type="text" class="form-control" id="fec_cre_cli" name="fec_cre_cli" value="<?php echo $fec_actual?> " readonly>
            </div>
        </div>
        <hr>
        <!-- Cliente y RUT--> 
        <div class="row">
                    <?php
            
            $re = $fun ->cargar_facturas(2,$num_fac);
            foreach($re as $row)
                {   
            ?>
            <div class="col-md-6">
                <label for="nom">Cliente&nbsp;<i class="fa fa-handshake-o" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" value = "<?php echo $row['nom_cli']?>" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-md-6">
                <label for="fec">Rut&nbsp;<i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;:</label>
                <input type="text" value = "<?php echo $row['rut_cli']?>" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
            </div>
        </div>
        <hr>
        <!-- Deudor y Rut--> 
        <div class="row">
            <div class="col-md-6">
                <label for="nom">Deudor&nbsp;<i class="fa fa-user-circle-o" aria-hidden="true">&nbsp;</i>:</label> 
                <input type="text" value = "<?php echo $row['nom_deu_doc']?>" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-md-6">
                <label for="fec">Rut&nbsp;<i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;:</label>
                <input type="text" value ="<?php echo $row['rut_deu_doc']?>" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
            </div>
        </div>
        <hr>

        
   

        <!-- CARGA DE GIF LOADING-->
        <div id="loading" style="display: none;">
            <center>
                <img src="../recursos/img/load.gif">
            </center>
        </div>
        
        <div class="row">
                <!-- SITUACION ACTUAL-->
                <div class="col-md-6 border-right">
                <br>
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-clone" aria-hidden="true"></i>&nbsp;&nbsp;Tipo Documento</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" value ="<?php echo $row['desc_item']?>" readonly placeholder="Tipo de Documento ( Cheque, Letra,..)">
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i>&nbsp;&nbsp;N°Documento</div>
                            </div>
                            <input type="text" class="form-control" id="num_doc" name="num_doc" value ="<?php echo $num_fac?>" readonly placeholder="Número de Documento">
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;Monto</div>
                            </div>
                            <input type="text" class="form-control" id="monto" value ="" readonly placeholder="Monto">
                        </div>
                           
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></i>&nbsp;Tasa</div>
                            </div>
                            <input type="text" class="form-control" id="tasa" value ="<?php echo $row['tasa_ope']?>" placeholder="Tasa" readonly>
                        </div>  

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i></i>&nbsp;Abono Capital</div>
                            </div>
                            <input type="text" class="form-control" id="abonocapital" name ="abonocapital" placeholder="Abono Capital" onchange="calculartotales()">
                        </div>  
                        <hr>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i></i>&nbsp;Total a Cobrar</div>
                            </div>
                            <input type="text" class="form-control" id="total_cobrar" name="total_cobrar"placeholder="Total a Cobrar" readonly>
                        </div>                  
                    </div>

                    
        
                </div>
                
                <!-- CONDICIONES MOROSAS -->
                <div class="col-md-6">
                     <div class="col-12">
                        <br>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <div class="input-group-text">Venc. Original</div>
                            </div>
                            <input type="date" class="form-control" value ="<?php echo $row['fec_ven_doc']?>" id="fec_venc" readonly placeholder="Venc. Original">
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
                            <div class="input-group-text">Fecha de Pago</div>
                            </div>
                            <input type="date" class="form-control" id="fec_pag" name="fec_pag" value="<?php echo $row['fec_pago_final']?>" placeholder="Fecha de Pago" onchange="calculomora()" >
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>&nbsp;Dias de Mora</div>
                            </div>
                            <input type="number" class="form-control" id="dias_mora" name="dias_mora" value="" placeholder="Días de mora" readonly >
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Intereses</div>
                            </div>
                            <input type="number" class="form-control" id="intereses"  name="intereses" value= "<?php echo $row['intereses']?>"placeholder="Intereses" readonly>
                        </div>                   
                    </div>
                </div>
                
        </div>
    
        
        <!-- DIV PARA PRUEBAS -->


        <!-- Detalle de la Operacion v.2--> 
        <div class="row">
            <div class="col-12 text-center">
                
                <div class="col-12">
                    <hr>
                    <h5>Formas de Pago</h5>
                </div>  
            </div>
        </div>

        <br>
        <!-- FORMA DE PAGO-->
        <div class="row">
            <div class="col-md-4">
                <div class="col-12">

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i></div>
                        </div>
                        <select class="form-control" name="forma_pago_doc" id="forma_pago_doc">
                          <option value="" selected disabled>Forma de Pago</option>
                                       <?php 
                                        $re = $fun->formas_pago_doc(1);   
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
            <div class="col-md-4">
                <div class="col-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-university" aria-hidden="true"></i></div>
                        </div>
                        <select class="form-control" name="bco_depo_deu" id="bco_depo_deu">
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
            <div class="col-md-4">
                <div class="col-12">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
                        <div class="input-group-text">Fecha</div>
                        </div>
                        <input type="date" class="form-control" id="fec_depo"  name="fec_depo" value="<?php echo $row['fec_depo_']?>" placeholder="Fecha de Pago">
                    </div> 
                </div>
            </div>
        </div>
         <!--       
        <div class="row">
            <div class="col-md-4">
                <div class="col-12">
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depositará el Deudor" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="depositara_deu" name="depositara_deu" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <div class="col-12">
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Descontar al Cliente de Op o Exc." readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="desc_cli" name="desc_cli" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depósito del Cliente" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">

                            <input type="checkbox" id="depo_cli" name="depo_cli" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-university" aria-hidden="true"></i></div>
                        </div>
                        <select class="form-control" name="bco_depo_cli" id="bco_depo_cli">
                          <option value="" selected disabled>Seleccione el Banco</option>
     
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-12">
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
                        <div class="input-group-text">Fecha</div>
                        </div>
                        <input type="date" class="form-control" id="fec_depo_cli" name="fec_depo_cli" placeholder="Fecha de Pago">
                    </div> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 ">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depositará el Cliente" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="depositara_cli" name="depositara_cli" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN FORMA DE PAGO-->



        <!--COMENTARIOS-->
        <div class="row">
        
            <div class="col-md-12">
                <div class="col-12">
                <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Observaciones</span>
                        </div>
                        <textarea class="form-control" id="obs_doc" name="obs_doc" aria-label="With textarea"></textarea>
                    </div><br><hr>
                </div>
            </div>
        </div>
        <!--FIN COMENTARIOS-->
        <br>
        <!--VISTOS BUENOS-->
        <div class="row">
            <div class="col-md-4">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="V° B° Gerente Adm."  readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="vba" name="vba" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="V° B° Gerente Comercial." readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="vbc" name="vbc" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            

            
            <div class="col-md-4">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="V° B° Gerente General." readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" id="vbg" name="vbg" aria-label="Checkbox for following text input">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--FIN VISTOS BUENOS-->
      <hr>
        <div class="row">
            <div class="col-12 text-center">
                <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Guardar Cambios">
            </div>
        </div>
        
        
        

                    <?php
                }
        ?> 
        
    </form>
</div>


</body>
</html>


