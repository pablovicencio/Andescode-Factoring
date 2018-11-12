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
            <div class="col-md-6">
                <label for="nom">Sucursal&nbsp;<i class="fa fa-building" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-md-6">
                <label for="fec">Fecha&nbsp;<i class="fa fa-calendar" aria-hidden="true">&nbsp;</i>:</label>
                <input type="date" class="form-control" id="fec_cre_cli" name="fec_cre_cli" >
            </div>
        </div>
        <hr>
        <!-- Cliente y RUT--> 
        <div class="row">
            <div class="col-md-6">
                <label for="nom">Cliente&nbsp;<i class="fa fa-handshake-o" aria-hidden="true"></i>&nbsp;:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-md-6">
                <label for="fec">Rut&nbsp;<i class="fa fa-id-card" aria-hidden="true"></i>&nbsp;:</label>
                <input type="text" class="form-control" id="fec_cre_cli" name="fec_cre_cli" readonly>
            </div>
        </div>
        <hr>
        <!-- Deudor y Rut--> 
        <div class="row">
            <div class="col-md-6">
                <label for="nom">Deudor&nbsp;<i class="fa fa-user-circle-o" aria-hidden="true">&nbsp;</i>:</label> 
                <input type="text" class="form-control" id="nom_cli" name="nom_cli"  maxlength="100" placeholder="Nombre o Razón Social" required readonly> 
            </div>
            <div class="col-md-6">
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
                <div class="col-md-6">
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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depósito del Deudor" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                        <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Banco">
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
                        <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Fecha de Pago">
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="col-12">
                    
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Depositará el Deudor" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                        <input type="number" class="form-control" id="inlineFormInputGroup" placeholder="Banco ">
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
                        <input type="date" class="form-control" id="inlineFormInputGroup" placeholder="Fecha de Pago">
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
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Observaciones</span>
                        </div>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
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
                        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="V° B° Gerente Adm." readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
                            <input type="checkbox" aria-label="Checkbox for following text input">
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
        
        
        
     
        

    </form>
</div>



</body>
</html>


