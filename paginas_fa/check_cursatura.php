<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Cursatura de Factoring</title>
<?php
  include("../includes/recursosExternos.php");
?>

<script type="text/javascript">

$(document).ajaxStart(function() {
  $("#formActOpe").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formActOpe").show();
  });  


$(document).ready(function() {
  $("#formActOpe").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlActOpe.php',
      data:$("#formActOpe").serialize(),
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
                    swal("Operación Actualizada", msg, "success");
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

    $idope = $_GET["idope"];
 
    $cargo = $_SESSION['cargo_fac'];
?>

        <!-- CARGA DE GIF LOADING-->
        <div id="loading" style="display: none;">
            <center>
                <img src="../recursos/img/load.gif">
            </center>
        </div>


<!-- TABLA NUEVA PARA MODIFICACION CURSATURA-->

<div class="container" id="main" bg="light">  
    <form id="formActOpe" onsubmit="return false;">
        <!-- DIV PARA TITULO PRINCIPAL--> 
        <div class="row">
            <div class="col-12 text-center">
                <h3>CURSATURA OPERACIÓN N° <?php echo $idope ?>&nbsp;&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i>
                <br>
            </div>
        </div>
        <hr>
        <!-- Cliente y Fecha--> 
        <div class="row">
            <div class="col-6">
            <?php
  
                    $re = $fun ->cargar_datos_cli_ope($idope);
                    foreach($re as $row)
                        {   
            ?>
                <label for="nom">Nombre o Razón Social&nbsp;<i class="fa fa-user-circle-o" aria-hidden="true">&nbsp;</i>:</label> 
                <input type="text" value="<?php echo $row["nom_cli"]?>" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-6">
                <label for="fec">Fecha&nbsp;<i class="fa fa-calendar" aria-hidden="true">&nbsp;</i>:</label>
                <input type="text" value="<?php echo date('d-m-Y',strtotime($row["fec_ope"]));?>" class="form-control" id="fec_ope" name="fec_cre_cli" readonly>
            </div>
        </div>
        <hr>
        <!-- CARGA DE GIF LOADING-->
        <div id="loading" style="display: none;">
            <center>
                <img src="../recursos/img/load.gif">
            </center>
        </div>
        <!-- DIV 1 SITUACION ACTUAL - CONDICIONES MOROSAS - CONDICIONES VIGENTES V1-->
        <div class="row">
                <!-- SITUACION ACTUAL-->
                <div class="col-md-4 border-right">
                <br>
                    <div class="col-12">

                        <h5>Situación Actual de la Empresa <br></h5>
                        <br>
                           
                        <label for="lineafacnac">Linea Factoring Nacional:</label>
                        <input type="number" value="<?php echo $row["linea_cred_cli"]?>" class="form-control" id="lineafacnac" name="lineafacnac"  maxlength="100" placeholder="$0" required>

                        <label for="ocupaprod">Ocupada Producto:</label>
                        <input type="number" value="<?php echo $row["ocupada"]?>" class="form-control" id="ocupaprod" name="ocupaprod"  maxlength="100" placeholder="$0" required>
                        
                        <label for="lineatotal">Linea Total:</label>
                        <input type="number" value="<?php echo $row["linea_cred_cli"]?>" class="form-control" id="lineatotal" name="lineatotal"  maxlength="100" placeholder="$0" required>
                        
                        <label for="ocupatotal">Ocupada Total.:</label>
                        <input type="number" value="<?php echo $row["ocupada"]?>" class="form-control" id="ocupatotal" name="ocupatotal"  maxlength="100" placeholder="$0" required>
                <?php
                    }   
                ?>     
                    </div>
                </div>

                <!-- CONDICIONES MOROSAS -->
                <div class="col-md-4 border-right">
                     <div class="col-12">
                     <br>
                        <h5>Condiciones Cartera Morosa</h5>
                        <br>

                        <label for="ceroaquince">0 a 15 Días:</label>
                        <input type="number" class="form-control" id="ceroaquince" name="ceroaquince"  maxlength="100" placeholder="$0" required>

                        <label for="quinceatreinta">15 a 30 Días:</label>
                        <input type="number" class="form-control" id="quinceatreinta" name="quinceatreinta"  maxlength="100" placeholder="$0" required>

                        <label for="treintasesenta">30 a 60 Días:</label>
                        <input type="number" class="form-control" id="treintasesenta" name="treintasesenta"  maxlength="100" placeholder="$0" required>

                        <label for="masde60">Más de 60 Días:</label>
                        <input type="number" class="form-control" id="masde60" name="masde60"  maxlength="100" placeholder="$0" required>


                        <label for="deudaemprelac">Deuda Emp. Relac.:</label>
                        <input type="number" class="form-control" id="deudaemprelac" name="deudaemprelac"  maxlength="100" placeholder="$0" required>

                        <label for="deudatotalgrupo">Deuda Total Grupo:</label>
                        <input type="number" class="form-control" id="deudatotalgrupo" name="deudatotalgrupo"  maxlength="100" placeholder="$0" required>
                    <br>
                  
                    </div>
                </div>
                 <!-- CONDICIONES VIGENTES -->
                <div class="col-md-4">
                    <div class="col-12 ">
                        <br>
                        <h5>Condiciones Cartera Vigente</h5>
                        <br>

                        <label for="ceroauno">0 a 1 Día:</label>
                        <input type="number" class="form-control" id="ceroauno" name="ceroauno"  maxlength="100" placeholder="$0" required>
                        
                        <label for="dosaquince">2 a 15 Días:</label>
                        <input type="number" class="form-control" id="dosaquince" name="dosaquince"  maxlength="100" placeholder="$0" required>

                        <label for="diesiseisatreinta">16 a 30 Días:</label>
                        <input type="number" class="form-control" id="diesiseisatreinta" name="diesiseisatreinta"  maxlength="100" placeholder="$0" required>

                        <label for="masde60">31 a 60 Días:</label>
                        <input type="number" class="form-control" id="masde60" name="masde60"  maxlength="100" placeholder="$0" required>

                        <label for="sesentayunoanoventa">61 a 90 Días:</label>
                        <input type="number" class="form-control" id="sesentayunoanoventa" name="sesentayunoanoventa"  maxlength="100" placeholder="$0" required>

                        <label for="masdenoventa">Más de 90 Días:</label>
                        <input type="number" class="form-control" id="masdenoventa" name="masdenoventa"  maxlength="100" placeholder="$0" required>


                    </div>
                </div>   
        </div>
        <hr>
        
        <!-- DIV PARA PRUEBAS -->


        <!-- Detalle de la Operacion v.2--> 
        <div class="row">
            <div class="col-12 align-middle">
                <h5>Detalle de la Operación</h5>
            </div>  
        </div>

        <div class="row">
            <div class="col-4 border-right">
                <div class="col-12">
                    <!-- Contenido 1--> 
                    
                    <br>

                    <?php
  
                        $re1 = $fun ->cargar_datos_det_ope($idope);
                        foreach($re1 as $row1)
                            { }  
                    ?>
                    <input type="text" value="<?php echo $row1["est_ope"]?>" class="form-control" id="estope" name="estope"  style="display: none" required>

                    <label for="tipoope">Tipo de Operación:</label>
                    <input type="text" value="<?php echo $row1["tipo_ope"]?>" class="form-control" id="tipoope" name="tipoope"  maxlength="100" placeholder="Tipo operación" required>

                    <label for="numcesion">Número de Cesión:</label>
                    <input type="number" value="<?php echo $row1["id_ope"]?>" class="form-control" id="numope" name="numope"  maxlength="100" placeholder="0" required>
                    
                    <label for="fechope">Fecha de Operación:</label>
                    <input type="text" value="<?php echo date('d-m-Y',strtotime($row1["fec_ope"]));?>" class="form-control" id="fechope" name="fechope"  maxlength="100" placeholder="$0" required>

                    <label for="cantdoc">Cantidad de Documentos:</label>
                    <input type="number" value="<?php echo $row1["cant_doc"]?>" class="form-control" id="cantdoc" name="cantdoc"  maxlength="100" placeholder="0" required>

                    <label for="tipodoc">Tipo de Documento:</label>
                    <input type="text" value="<?php echo $row1["tipo_doc"]?>" class="form-control" id="tipodoc" name="tipodoc"  maxlength="100" placeholder="Tipo operación" required>
                    <hr>
                    <label for="plazoprom">Plazo Promedio:</label>
                    <input type="number" value="<?php echo $row1["plazo_prom"]?>" class="form-control" id="plazoprom" name="plazoprom"  maxlength="100" placeholder="0" required>

                    <label for="vencmas90">Vencimiento más de 90 días:</label>
                    <input type="number" class="form-control" id="vencmas90" name="vencmas90"  maxlength="100" placeholder="0" required>
                    
                    <label for="cantdocmasnoventa">Cant. doc. más de 90 días:</label>
                    <input type="number" class="form-control" id="cantdocmasnoventa" name="cantdocmasnoventa"  maxlength="100" placeholder="0" required>
                    
                    <label for="cantdocsinnoti">Cant. doc. sin notificar:</label>
                    <input type="number" class="form-control" id="cantdocsinnoti" name="cantdocsinnoti"  maxlength="100" placeholder="0" required>
                </div>
                <!-- FIN Contenido 1--> 
            </div>
            <div class="col-4 border-right">
                <div class="col-12">
                    <!--  Contenido 2--> 
                    <br>

                    <label for="porcenticipo">% Anticipo:</label>
                    <input type="number" value="<?php echo $row1["anticipo_prom"]?>" class="form-control" id="porcenticipo" name="porcenticipo"  maxlength="100" placeholder="%" required>

                    <label for="servfactoring">Servicio Factoring:</label>
                    <input type="number" value="<?php echo $row1["com_cob_ope"]?>" class="form-control" id="servfactoring" name="servfactoring"  maxlength="100" placeholder="0" required>

                    <label for="tasaope">Tasa de Operación:</label>
                    <input type="number" value="<?php echo $row1["tasa_ope"]?>" class="form-control" id="tasaope" name="tasaope"  maxlength="100" placeholder="0" required>
                    
                    <label for="mbssapertura">Margen Bru. Mens. s/apertura:</label>
                    <input type="number" class="form-control" id="mbssapertura" name="mbssapertura"  maxlength="100" placeholder="0" required>

                    <label for="ipocapertura">Ingresos por Operación c/apertura:</label>
                    <input type="number" value="<?php echo $row1["ing_por_ope"]?>" class="form-control" id="ipocapertura" name="ipocapertura"  maxlength="100" placeholder="0" required>     
                </div>
                <!-- FIN Contenido 2--> 
            </div>
            <div class="col-4">
            <br>
                <div class="col-12">
                <!--  Contenido 3-->
                    <label for="mondoc">Monto de Documentos:</label>
                    <input type="number" value="<?php echo $row1["monto_docs"]?>" class="form-control" id="mondoc" name="mondoc"  maxlength="100" placeholder="0" required>
                    
                    <label for="precompra">Precio de Compra:</label>
                    <input type="number" value="<?php echo $row1["monto_finan"]?>"  class="form-control" id="precompra" name="precompra"  maxlength="100" placeholder="0" required>
                   
                    <label for="difprecio">Diferencia de Precio:</label>
                    <input type="number" value="<?php echo $row1["dif_pre"]?>"  class="form-control" id="difprecio" name="difprecio"  maxlength="100" placeholder="0" required>
                   
                    <label for="monantici">Monto Anticipado:</label>
                    <input type="number" value="<?php echo $row1["ant_doc"]?>"  class="form-control" id="monantici" name="monantici"  maxlength="100" placeholder="0" required>
                   
                    <label for="servfactoring">Servicio Factoring c/IVA:</label>
                    <input type="number" value="<?php echo $row1["serv_fact"]?>"  class="form-control" id="servfactoring" name="servfactoring"  maxlength="100" placeholder="0" required>
                   
                    <label for="servadmin">Serv. Admin. c/IVA:</label>
                    <input type="number" value="<?php echo $row1["serv_adm"]?>"  class="form-control" id="servadmin" name="servadmin"  maxlength="100" placeholder="0" required>
                   
                    <label for="gastosope">Gastos Operacionales:</label>
                    <input type="number" value="<?php echo $row1["gasto_ope"]?>" class="form-control" id="gastosope" name="gastosope"  maxlength="100" placeholder="0" required>
                    <br><br><br><br>

                    <label for="giro">Giro Total:</label>
                    <input type="text" value="<?php echo $row1["monto_giro_ope"]?>" class="form-control" id="giro" name="giro"  maxlength="100" placeholder="0" required>
                    <div class="input-group"> 
                    <br>
                    <!--
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Diferencia de Precio:</span>
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                    -->

                </div>
                <br>           </div>
                      </div>


        <!--TABLA INFORMACION DEUDORES--> 
        <div class="row">
        
            <div class="col-12">
            
            <br>
                
                
            </div>
            <div class="col-12">
            <br>
                <div class="col-12">
               
                </div>

                </div>     
            </div>
        </div>
         

    <hr>
    <h5>Información Deudores &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i></i></h5>
    <br>
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="thead-dark">
      <tr>
        <th class="th-sm">Deudor</th>
        <th class="th-sm">Deuda Operación</th>
        <th class="th-sm">Deuda con Cliente</th>
        <th class="th-sm">% Conc. Cliente</th>
        <th class="th-sm">Mora con Cliente</th>
        <th class="th-sm">Deuda con Viracocha</i></th>
        <th class="th-sm">Mora con Viracocha</i></th>
       </tr>
    </thead>
    <tbody>

    <?php
  
      $re5 = $fun ->infodeudores($idope);
      foreach($re5 as $row5)
        {

        
      ?>
    
    <tr>
                  <td><?php echo $row5['nom_deu_doc']?></td>
                  <td><?php echo $row5['deuda_ope']?></td>
                  <td><?php echo $row5['deuda_cli']?></td>
                  <td><?php echo $row5['conc_cli']?></td>
                  <td><?php echo $row5['mora_cli']?></td>
                  <td><?php echo $row5['deuda_cli']?></td>
                  <td><?php echo $row5['mora_cli']?></td>
                  
                

  
      </tr>

              </tr>

<?php } ?>  

    </tbody>

  </table>




        <!--FIN TABLA INFORMACION DEUDORES--> 


        <!--COMENTARIOS-->
        <div class="row">
            <div class="col-12">
                <hr>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Comentarios</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea"><?php echo $row1["obs_ope"]?></textarea>
                </div>
            </div>
        </div>
        <!--FIN COMENTARIOS-->
        <!--Revisión de Documentos-->
        <hr>
        <div class="row">
            <div class="col-12">
                <h5>Revisión de Documentos</h5>
                <br>
            </div>
            <div class="col-4">
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="contratocesion" value="contratocesion">
                    <label class="form-check-label" for="contratocesion">Contrato de Cesión</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="dicomdeudorescli" value="dicomdeudorescli">
                    <label class="form-check-label" for="dicomdeudorescli">Dicom Deudores y Cliente</label>
                </div>
            </div>
            <div class="col-4">
            <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="informeconfir" value="informeconfir">
                    <label class="form-check-label" for="informeconfir">Informe de Confirmación</label>
                </div> 
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="ivaform" value="ivaform">
                    <label class="form-check-label" for="ivaform">Formulario IVA</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="cobrogastos" value="cobrogastos">
                    <label class="form-check-label" for="cobrogastos">Cobro de Gastos</label>
                </div>
                <div class="form-check form-check">
                    <input class="form-check-input" type="checkbox" id="garantia" value="garantia">
                    <label class="form-check-label" for="garantia">Garantías</label>
                </div>
            </div>



           



        </div>
        <!--FIN Revisión de Documentos-->
        <!--APROBACIONES-->
        <hr>
            <div class="row">
            <div class="col-12">
                <h5>Aprobaciónes</h5>
                <br>
            </div>
            <div class="col-12">

                <?php
                        
                        $re2 = $fun ->cargar_aprobaciones($idope);
                        for ($i=1; $i <= 3; $i++) {
                            $row2 = 0; 
                            foreach($re2 as $row2)
                            {  }
                                if ($row2['est_nue_ope'] == $i and !empty($re2)) {
                                    echo '<div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">'.$row2['desc_item'].'</span>
                                            <div class="input-group-text">
                                            <input type="checkbox" checked="true"  aria-label="Checkbox for following text input">
                                            </div>
                                            <span class="input-group-text">'.$row2['nom'].'</span>
                                        </div>
                                        <input type="text" class="form-control" value="'.$row2['obs_log_ope'].'" aria-label="Text input with checkbox">
                                    </div>';

                            }else if($i == 1){
                                echo '<div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Ejecutivo</span>
                                            <div class="input-group-text">
                                            <input type="checkbox"  aria-label="Checkbox for following text input">
                                            </div>
                                            <span class="input-group-text"> </span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with checkbox">
                                    </div>';
                            }else if($i == 2){
                                echo '<div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Finanzas</span>
                                            <div class="input-group-text">
                                            <input type="checkbox"  aria-label="Checkbox for following text input">
                                            </div>
                                            <span class="input-group-text"> </span>
                                        </div>
                                        <input type="text" id="obs_2" name="obs_2" class="form-control" aria-label="Text input with checkbox">
                                    </div>';
                            }
                            else if($i == 3){
                                echo '<div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Gerente General</span>
                                            <div class="input-group-text">
                                            <input type="checkbox"  aria-label="Checkbox for following text input">
                                            </div>
                                            <span class="input-group-text"> </span>
                                        </div>
                                        <input type="text" id="obs_3" name="obs_3" class="form-control" aria-label="Text input with checkbox">
                                    </div>';
                            }
                         
                        }
                         
                    ?>

            </div>
        </div>
        <br>


        <!--FIN APROBACIONES-->
        <!--DATOS DE GIRO-->
        <div class="row">
            <div class="col-12">
            <hr>
                <h5>Datos de Giro</h5>
            </div>
            <div class="col-6">
                     <label for="bancogiro">Forma de Giro:</label>
                     <select class="form-control" id="forma_giro" name="forma_giro" style="width: 500px" required>
                      <option value="" selected disabled>Seleccione Forma de Giro</option>
                                 <?php 
                                  $re3 = $fun->cargar_formas_giro(1);   
                                  foreach($re3 as $row3)      
                                      {
                                        ?>
                                        
                                         <option value="<?php echo $row3['cod_item'] ?>"><?php echo $row3['desc_item'] ?></option>
                                            
                                        <?php
                                      }    
                                  ?>  
                  </select>

                    <label for="bancogiro">Banco Giro:</label>
                    <select class="form-control" name="bco_giro" id="bco_giro" required>
                          <option value="" selected disabled>Seleccione el Banco</option>
                                       <?php 
                                        $re4 = $fun->cargar_bcos(1);   
                                        foreach($re4 as $row4)      
                                            {
                                              ?>
                                               <option value="<?php echo $row4['cod_item'] ?>"><?php echo $row4['desc_item'] ?></option>
                                                  
                                              <?php
                                            }    
                                        ?>       
                        </select>

                    <label for="montoagirar">Monto a Girar:</label>
                    <?php 
                                        $re6 = $fun->cargar_monto_giro($idope);   
                                        foreach($re6 as $row6)      
                                            {
                                            }  
                                            echo'<input type="number" class="form-control" id="montoagirar" name="montoagirar"  maxlength="100" value="'.$row6['monto'].'" required>' ;
                                        ?>       
                    
            </div>
            <div class="col-6">
                    <label for="bancodepo">Banco Depósito:</label>
                    <select class="form-control" name="bco_dep" id="bco_dep" required>
                          <option value="" selected disabled>Seleccione el Banco</option>
                                       <?php 
                                        $re4 = $fun->cargar_bcos(1);   
                                        foreach($re4 as $row4)      
                                            {
                                              ?>
                                               <option value="<?php echo $row4['cod_item'] ?>" 
                                                <?php if ($row4['cod_item'] == $row['bco_cli']) { echo "selected";} ?>
                                                ><?php echo $row4['desc_item'] ?></option>
                                                  
                                              <?php
                                            }    
                                        ?>       
                        </select>

                    <label for="ctacte">Cuenta Corriente:</label>
                    <input type="number" class="form-control" id="ctacte" name="ctacte"  maxlength="100" value="<?php echo $row["nro_cta_cli"]?>" required>

                    <label for="mail">Mail:</label>
                    <input type="text" class="form-control" id="mail" name="mail"  maxlength="100" value="<?php echo $row["mail_cli"]?>" required>
            </div>
            
        </div>
        <!--FIN DATOS DE GIRO-->
        <br><br>
        <div class="col-12 text-center">
            <?php 
                if ($cargo == 2) {
                    echo'<input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="'."Aprobar".'">';
                }else if ($cargo == 3) {
                    echo'<input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="'."Cursar".'">';
                }
            ?> 
                
        </div>
    </form>
</div>



</body>
</html>

