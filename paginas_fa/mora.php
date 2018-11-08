<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Mora</title>
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
                <h3>Mora&nbsp;&nbsp;<i class="fa fa-reply-all" aria-hidden="true"></i>


                <br>
            
            </div>
        </div>
        <hr>
        <!-- Sucursal y Fecha--> 
        <div class="row ">
            <div class="col-6">
                <label for="nom">Sucursal&nbsp;<i class="fa fa-building" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-6">
                <label for="fec">Fecha&nbsp;<i class="fa fa-calendar" aria-hidden="true">&nbsp;</i>:</label>
                <input type="date" class="form-control" id="fec_cre_cli" name="fec_cre_cli" >
            </div>
        </div>
        <hr>
        <!-- Cliente y RUT--> 
                <div class="row">
            <div class="col-6">
                <label for="nom">Cliente&nbsp;<i class="fa fa-handshake-o" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-6">
                <label for="fec">Rut&nbsp;<i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;:</label>
                <input type="text" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
            </div>
        </div>
        <hr>
        <!-- Deudor y Rut--> 
        <div class="row">
            <div class="col-6">
                <label for="nom">Deudor&nbsp;<i class="fa fa-user-circle-o" aria-hidden="true">&nbsp;</i>:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-6">
                <label for="fec">Rut&nbsp;<i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;:</label>
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
        
        <div class="row">
                <!-- SITUACION ACTUAL-->
                <div class="col-md-6 border-right">
                <br>
                    <div class="col-12">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-clone" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Tipo de Documento ( Cheque, Letra,..)">
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Número de Documento">
                        </div>

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;&nbsp;</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Monto">
                        </div>
                           
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-percent" aria-hidden="true"></i></i>&nbsp;</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Tasa">
                        </div>  

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i></i></div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Abono Capital">
                        </div>  
                        <hr>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-money" aria-hidden="true"></i></i></div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Total a Cobrar">
                        </div>                  
                    </div>
                </div>
                
                <!-- CONDICIONES MOROSAS -->
                <div class="col-md-6 border-right">
                     <div class="col-12">
                        <br>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <div class="input-group-text">Vencimiento Original</div>
                            </div>
                            <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Vencimiento Original">
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
                            <div class="input-group-text">Fecha de Pago</div>
                            </div>
                            <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Fecha de Pago">
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i></div>
                            </div>
                            <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Días de mora">
                        </div> 
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-exchange" aria-hidden="true"></i></div>
                            </div>
                            <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Intereses">
                        </div>                   
                    </div>
                </div>
        </div>
        <hr>
        
        <!-- DIV PARA PRUEBAS -->


        <!-- Detalle de la Operacion v.2--> 
        <div class="row">
            <div class="col-12 align-middle">
                <h5>Formas de Pago</h5>
            </div>  
        </div>

        <div class="row">
            



            <div class="col-6 ">
                <div class="col-12">
                    <!-- Contenido 1--> 
                    <br>
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depósito del Deudor" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depositará el Deudor" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Descontar al Cliente de Op o Exc." readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depósito del Cliente" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depositará el Cliente" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIN Contenido 1--> 
            </div>
            <div class="col-4">
                <div class="col-12">
                    <!--  Contenido 2--> 
                    <br>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-university" aria-hidden="true"></i></div>
                        </div>
                        <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Banco">
                    </div> <br><br><br>
                    <div class="input-group mb-2"></div> 
                 

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-university" aria-hidden="true"></i></div>
                        </div>
                        <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Banco">
                    </div> 
    
                </div>
                <!-- FIN Contenido 2--> 
            </div>
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
                <table class="table">
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


