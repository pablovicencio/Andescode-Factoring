<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Operaciones</title>
<?php
  include("../includes/recursosExternos.php");
?>

</head>

<body>

<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>
<!--CONTENEDOR DE TITULO-->
<div class="container text-center" id="main">
    <div class="row">
        <div class="col-12">
            <h3>
               Simulación&nbsp;&nbsp; <i class="fa fa-money" aria-hidden="true"></i>
            </h3>
        </div>
    </div>
</div>

<!--CONTENEDOR DE CLIENTE Y FECHA DE INGRESO-->
<div class="container" id="main">
    <div class="row">
        <div class="col-3">
            <div class="form-group">	
                <select class="form-control" id="cli" name="cli" onchange="mod(this.value)">
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
                <label for="fec_operacion">Fecha de la Operación</label>
                <input type="date">
            </div>
        </div>
    </div>
</div>
<!--CONTENEDOR DE DATOS DEL CLIENTE Y GASTOS-->
<div class="container" id="main">
    <div class="row">
<!--CONTENEDOR DE DATOS DEL CLIENTE-->
        <div class="col-6"></div>
<!--CONTENEDOR DE GASTOS DEL CLIENTE-->
        <div class="col-6"></div>
    </div>
</div>











