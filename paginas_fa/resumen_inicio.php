<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Resúmen General</title>

<?php
  include("../includes/recursosExternos.php");
?>

<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
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
        <div class="col-12 text-center">
        <h3>Resúmen General&nbsp;<i class="fa fa-pie-chart" aria-hidden="true"></i></h3>
        </div>
        <hr>
    </div>
    <hr>
    <h5>Operaciones Pendientes &nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i></i></h5>
    <br>
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="thead-dark">
      <tr>
        <th class="th-sm">N°<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Fecha<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Usuario<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Tipo<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Tasa<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Monto Girado<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Cliente<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Rut<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Estado<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
        <th class="th-sm">Cursar<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
      </tr>
    </thead>
    <tbody>

    <?php
      $re = $fun ->cargar_datos_ope(2);
      foreach($re as $row)
        {

        
      ?>
    
    <tr>
                  <td><?php echo $row['ope']?></td>
                  <td><?php echo $row['fecha']?></td>
                  <td><?php echo $row['usuario']?></td>
                  <td><?php echo $row['tipo']?></td>
                  <td><?php echo $row['tasa']?></td>
                  <td><?php echo $row['girado']?></td>
                  <td><?php echo $row['cliente']?></td>
                  <td><?php echo $row['rut']?></td>
                  <td><?php echo $row['estado']?></td>
                  <td><a style="text-decoration:none" href="check_cursatura.php?idope=<?php echo $row['ope']?>" name="" value="">Cursar</a>  <i class="fa fa-check-circle-o" aria-hidden="true"></i></td>
                

  
      </tr>

              </tr>

<?php } ?>  

    </tbody>
    <tfoot>
      <tr>
        <th>N°</th>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Tasa</th>
        <th>Monto Girado</th>
        <th>Cliente</th>
        <th>Rut</th>
        <th>Estado</th>
        <th>Cursar</th>
      </tr>
    </tfoot> 
  </table>


</div>

</body>
</html>