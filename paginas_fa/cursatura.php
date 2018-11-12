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


</head>

<body>


<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>

<!-- TABLA NUEVA PARA MODIFICACION CURSATURA-->

<div class="container" id="main" bg="light">  
    <form id="formCurFac" onsubmit="return false;">
        <!-- DIV PARA TITULO PRINCIPAL--> 
        <div class="row">
            <div class="col-12 text-center">
                <h3>CURSATURA DE FACTORING&nbsp;&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i>
                <br>
                <h4>OPERACIÓN N°:</h4>
            </div>
        </div>
        <hr>
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
        <!-- Cliente y Fecha--> 
        <div class="row">
            <div class="col-6">
                <label for="nom">Cliente&nbsp;<i class="fa fa-user-circle-o" aria-hidden="true">&nbsp;</i>:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-6">
                <label for="fec">Fecha&nbsp;<i class="fa fa-calendar" aria-hidden="true">&nbsp;</i>:</label>
                <input type="text" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
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
                        <input type="number" class="form-control" id="lineafacnac" name="lineafacnac"  maxlength="100" placeholder="$0" required>

                        <label for="ocupaprod">Ocupada Producto:</label>
                        <input type="number" class="form-control" id="ocupaprod" name="ocupaprod"  maxlength="100" placeholder="$0" required>
                        
                        <label for="lineatotal">Linea Total:</label>
                        <input type="number" class="form-control" id="lineatotal" name="lineatotal"  maxlength="100" placeholder="$0" required>
                        
                        <label for="ocupatotal">Ocupada Total.:</label>
                        <input type="number" class="form-control" id="ocupatotal" name="ocupatotal"  maxlength="100" placeholder="$0" required>
                        
                        <label for="linocupdeu">Linea Ocupada Deudor:</label>
                        <input type="number" class="form-control" id="linocupdeu" name="linocupdeu"  maxlength="100" placeholder="$0" required>
                        
                        <label for="deudaleasing">Deuda Leasing:</label>
                        <input type="number" class="form-control" id="deudaleasing" name="deudaleasing"  maxlength="100" placeholder="$0" required>
                        
                        <label for="venclinea">Vencimiento Linea:</label>
                        <input type="date" class="form-control" id="venclinea" name="venclinea"  maxlength="100" placeholder="$0" required>
                   
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

                        <label for="ctasxcobrar">Cuentas x cobrar:</label>
                        <input type="number" class="form-control" id="ctasxcobrar" name="ctasxcobrar"  maxlength="100" placeholder="$0" required>

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
                    
                    <label for="tipoope">Tipo de Operación:</label>
                    <input type="text" class="form-control" id="tipoope" name="tipoope"  maxlength="100" placeholder="Tipo operación" required>

                    <label for="numcesion">Número de Cesión:</label>
                    <input type="number" class="form-control" id="numcesion" name="numcesion"  maxlength="100" placeholder="0" required>
                    
                    <label for="fechope">Fecha de Operación:</label>
                    <input type="date" class="form-control" id="fechope" name="fechope"  maxlength="100" placeholder="$0" required>

                    <label for="cantdoc">Cantidad de Documentos:</label>
                    <input type="number" class="form-control" id="cantdoc" name="cantdoc"  maxlength="100" placeholder="0" required>

                    <label for="tipodoc">Tipo de Documento:</label>
                    <input type="text" class="form-control" id="tipodoc" name="tipodoc"  maxlength="100" placeholder="Tipo operación" required>
                    <hr>
                    <label for="plazoprom">Plazo Promedio:</label>
                    <input type="number" class="form-control" id="plazoprom" name="plazoprom"  maxlength="100" placeholder="0" required>

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
                    <input type="text" class="form-control" id="porcenticipo" name="porcenticipo"  maxlength="100" placeholder="%" required>

                    <label for="servfactoring">Servicio Factoring:</label>
                    <input type="number" class="form-control" id="servfactoring" name="servfactoring"  maxlength="100" placeholder="0" required>

                    <label for="tasaope">Tasa de Operación:</label>
                    <input type="number" class="form-control" id="tasaope" name="tasaope"  maxlength="100" placeholder="0" required>
                    
                    <label for="mbssapertura">Margen Bru. Mens. s/apertura:</label>
                    <input type="number" class="form-control" id="mbssapertura" name="mbssapertura"  maxlength="100" placeholder="0" required>

                    <label for="ipocapertura">Ingresos por Operación c/apertura:</label>
                    <input type="number" class="form-control" id="ipocapertura" name="ipocapertura"  maxlength="100" placeholder="0" required>     
                </div>
                <!-- FIN Contenido 2--> 
            </div>
            <div class="col-4">
            <br>
                <div class="col-12">
                <!--  Contenido 3-->
                    <label for="mondoc">Monto de Documentos:</label>
                    <input type="number" class="form-control" id="mondoc" name="mondoc"  maxlength="100" placeholder="0" required>
                    
                    <label for="precompra">Precio de Compra:</label>
                    <input type="number" class="form-control" id="precompra" name="precompra"  maxlength="100" placeholder="0" required>
                   
                    <label for="difprecio">Diferencia de Precio:</label>
                    <input type="number" class="form-control" id="difprecio" name="difprecio"  maxlength="100" placeholder="0" required>
                   
                    <label for="monantici">Monto Anticipado:</label>
                    <input type="number" class="form-control" id="monantici" name="monantici"  maxlength="100" placeholder="0" required>
                   
                    <label for="servfactoring">Servicio Factoring c/IVA:</label>
                    <input type="number" class="form-control" id="servfactoring" name="servfactoring"  maxlength="100" placeholder="0" required>
                   
                    <label for="servadmin">Serv. Admin. c/IVA:</label>
                    <input type="number" class="form-control" id="servadmin" name="servadmin"  maxlength="100" placeholder="0" required>
                   
                    <label for="gastosope">Gastos Operacionales:</label>
                    <input type="number" class="form-control" id="gastosope" name="gastosope"  maxlength="100" placeholder="0" required>
                    <br><br><br><br>

                    <label for="giro">Giro Total:</label>
                    <input type="text" class="form-control" id="giro" name="giro"  maxlength="100" placeholder="0" required>
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
                <div class="col-12">
                <hr>
                <h5>Información Deudores</h5>
                </div>
                
            </div>
            <div class="col-12">
            <br>
                <div class="col-12">
                <table class="display" id="table_id">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Deudor</th>
                                <th scope="col">Deuda Operación</th>
                                <th scope="col">Deuda con Cliente</th>
                                <th scope="col">% Conc. Cliente</th>
                                <th scope="col">Mora con Cliente</th>
                                <th scope="col">Deuda con Viracocha</th>
                                <th scope="col">Mora con Viracocha</th>
                            </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Ejemplo #1</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Ejemplo #2</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Ejemplo #3</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                </tbody>
                </table>
                </div>

                </div>     
            </div>
        </div>
        <!--FIN TABLA INFORMACION DEUDORES--> 


        <!--COMENTARIOS-->
        <div class="row">
            <div class="col-12">
                <hr>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Comentarios</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
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
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Ejecutivo&nbsp;&nbsp;</span>
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                        <span class="input-group-text">Carlos Nelidow</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Finanzas &nbsp; </span>
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                        <span class="input-group-text">Aline Bravo</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                </div>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Gerente General</span>
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input">
                        </div>
                        <span class="input-group-text">Rene Ponce</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                </div>

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
                    <label for="formagiro">Forma de Giro:</label>
                    <input type="text" class="form-control" id="formagiro" name="formagiro"  maxlength="100" placeholder="" required>

                    <label for="bancogiro">Banco Giro:</label>
                    <input type="text" class="form-control" id="bancogiro" name="bancogiro"  maxlength="100" placeholder="" required>

                    <label for="montoagirar">Monto a Girar:</label>
                    <input type="number" class="form-control" id="montoagirar" name="montoagirar"  maxlength="100" placeholder="" required>
            </div>
            <div class="col-6">
                    <label for="bancodepo">Banco Depósito:</label>
                    <input type="text" class="form-control" id="bancodepo" name="bancodepo"  maxlength="100" placeholder="" required>

                    <label for="ctacte">Cuenta Corriente:</label>
                    <input type="number" class="form-control" id="ctacte" name="ctacte"  maxlength="100" placeholder="" required>

                    <label for="mail">Mail:</label>
                    <input type="text" class="form-control" id="mail" name="mail"  maxlength="100" placeholder="" required>
            </div>
            
        </div>
        <!--FIN DATOS DE GIRO-->
    </form>
</div>



</body>
</html>


