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
    <?php 
          $cargo = $_SESSION['cargo_fac'];
          if ($cargo <> 1) {
                if ($cargo == 2) {
                  $est_nuevo = 'Aprobar';
                }elseif ($cargo == 3) {
                  $est_nuevo = 'Cursar';
                }
                $re = $fun->contador_ope($cargo); 

                if ($re != 0) {
                     foreach($re as $row)      {
                      if ($row['ope'] <> 0) {
                        echo "<h6>Hola ".$_SESSION['nom_fac'].", actualmente hay ".$row['ope']." operaciones esperando por ".$est_nuevo."</h6>"; 
                      }else{
                              echo "<h6>Hola ".$_SESSION['nom_fac'].", actualmente no hay operaciones pendientes</h6>";
                            }                                             
                     }
                      
                  } else{
                      echo "<h6>Hola ".$_SESSION['nom_fac'].", actualmente no hay operaciones pendientes</h6>";
                  }                                             

          }
          


    ?>
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
        <th class="th-sm">Acción<i class="fa fa-sort float-right" aria-hidden="true"></i></th>
      </tr>
    </thead>
    <tbody>

    <?php
      $re = $fun ->cargar_datos_ope($cargo);

      if ($re != 0) {
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
                  <?php 
                  if($cargo <> 1){
                       echo '<td><a style="text-decoration:none" href="check_cursatura.php?idope='.$row['ope'].'" name="" value="">'.$est_nuevo.'</a>  <i class="fa fa-check-circle-o" aria-hidden="true"></i></td>';

                  }


                  ?>
                 
                

  
      </tr>

              </tr>

<?php }} ?>  

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


  <h5>Estado de Facturas Morosas&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i></i></h5>
    <br>
  <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead class="thead-dark">
      <tr>
        <th class="th-sm">N°</th>
        <th class="th-sm">Deudor</th>
        <th class="th-sm">Rut</th>
        <th class="th-sm">N° Documento</th>
        <th class="th-sm">Monto Documento</th>
        <th class="th-sm">Financiado</th>
        <th class="th-sm">Tasa</th>
        <th class="th-sm">Vencimiento</th>
        <th class="th-sm">Plazo</th>
        <th class="th-sm">Dias en Mora</th>
        <th class="th-sm">Gestionar</th>
      </tr>
    </thead>
    <tbody>

    <?php
      
      $re = $fun ->cargar_facturas(1,"");
      foreach($re as $row)
        {

        
      ?>
    
    <tr>
                  <td><?php echo $row['id_ope']?></td>
                  <td><?php echo $row['nom_deu_doc']?></td>
                  <td><?php echo $row['rut_deu_doc']?></td>
                  <td><?php echo $row['nro_doc']?></td>
                  <td><?php echo $row['monto_doc']?></td>
                  <td><?php echo $row['monto_finan_doc']?></td>
                  <td><?php echo $row['tasa_ope']?></td>
                  <td><?php echo $row['vencimiento']?></td>
                  <td><?php echo $row['plazo_doc']?></td>
                  <td><?php 
                      $fec_actual = date("d-m-Y", time());
                      $fec_venc = $row['vencimiento'];
                      $datetime1 = date_create($fec_actual);
                      $datetime2 = date_create($fec_venc);
                      $interval = date_diff($datetime2, $datetime1);
                      echo $interval->format('%R%a días');
                      ?>
                  </td>
                  <td><a style="text-decoration:none" href="mora.php?idope=<?php echo $row['id_ope']?>&numfac=<?php echo $row['nro_doc']?>" name="" value="">Gestionar Mora</a>  <i class="fa fa-check-circle-o" aria-hidden="true"></i></td>
                

  
      </tr>

              </tr>

<?php } ?>  

    </tbody>
    
  </table>


</div>

</body>
</html>