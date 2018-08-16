<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Crear Cliente</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">


function mod(cli) {
    
     $.ajax({
      url: '../controles/controlCargarDiaCli.php',
      type: 'POST',
      data: {"cli":cli},
      dataType:'html',
      success:function(result){
        $('#dia_cli').val(result);
        plazo();

  }
  })
    
}

function calculo() {
    var monto = document.getElementById("monto_doc").value;
    var porc = document.getElementById("ant_doc").value;
    document.getElementById("finan_doc").value=Math.floor(monto*porc)/100;
}

function plazo(){

      var fechaope = new Date(document.getElementById("fec_ope_doc").value).getTime();
      var fechaven    = new Date(document.getElementById("fec_ven_doc").value).getTime();
      var dia_cli    = (document.getElementById("dia_cli").value);

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


$(document).ready(function() {
  $("#formIngDoc").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlIngDoc.php',
      data:$("#formIngDoc").serialize(),
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '2':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                default:
                    swal("Documento Ingresado", msg, "success");
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




  <style type="text/css">
    #main{
      background: url('../recursos/img/logo/bg.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center; 
      border-radius: 25px;
      padding-top: 5px;
    }
    #btn-modal{
      display: none;
    }

    @media (max-width: 1000px) {
    
        body{font-size: 3.7vw;}

}

  </style>

 
</head>

<body>


      <nav class="navbar navbar-expand-sm ">
              <img class="img-fluid" src="../recursos/img/logo/logo_fa.png" alt="Viracocha" width="150" height="30">
              <ul class="navbar-nav ml-auto" >
               <li class="nav-item">Bienvenido: <br><b><?php echo $_SESSION['nom_fac']; ?></b> </li>
                <li class="nav-item"><a class="nav-link" href="../controles/logout.php" onclick="return confirm('¿Deseas finalizar sesión?');"><i style="font-size:24px" class="fa">&#xf08b;</i>Cerrar Sesión</a></li>
              </ul>
      </nav>

  
      
      <nav class="navbar navbar-expand-lg bg-info navbar-dark">
        <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navb" >
              <ul class="navbar-nav" >
                <li class="nav-item"><a class="nav-link" href="datos_pers.php">Mis Datos</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_cli.php">Crear Cliente</a>
                        <a class="dropdown-item" href="mod_cli.php">Modificar Cliente</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="#.php">Deudores</a></li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Documentos</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="ing_doc.php">Ingresar</a>
                        <a class="dropdown-item" href="mod_co.php">Operaciones</a>
                      </div>
                    </li>
                <li class="nav-item"><a class="nav-link" href="#">Informes</a></li>
                <!-- Dropdown -->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="crear_usu.php">Crear Usuario</a>
                        <a class="dropdown-item" href="mod_usu.php">Modificar Usuario</a>
                      </div>
                    </li>
              </ul>
            </div>
      </nav>

<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Ingreso de Documento</h3>
    <hr>
  </div>
  </div>
  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>
  
  <form id="formIngDoc" onsubmit="return false;">
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
             <label for="rut">Rut Deudor:</label>
             <input type="text"  class="form-control" id="rut_deu" name="rut_deu" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}"  required>
          </div>
          <div class="form-group">
            <label for="nom">Nombre Deudor:</label>
            <input type="text" class="form-control" id="nom_deu" name="nom_deu"  maxlength="100" required>
          </div>
          <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label for="tip_doc">Tipo de Documento:</label>
                   <select class="form-control" id="tip_doc" name="tip_doc" >
                        <option value="" selected disabled>Seleccione Tipo Doc</option>
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
                <div class="col-6">
                  <label for="num_doc">Número de Documento:</label>
                  <input type="number" class="form-control" id="num_doc" name="num_doc"  required>
                </div>
             </div>
          </div>

          <div class="row">
                  <div class="col-6">
                    <label for="fec_ope">Fecha de Operación:</label>
                    <input type="date" class="form-control" id="fec_ope_doc" name="fec_ope_doc" onchange="plazo()" required>
                  </div>
                  <div class="col-6">
                    <label for="fec_ven">Fecha de Vencimiento:</label>
                    <input type="date" class="form-control" id="fec_ven_doc" name="fec_ven_doc" onchange="plazo()" required>   
                  </div>
              </div><br>
          
             
  </div>
  <div class="col-6">   
  <div class="form-group">
              
                    <label for="monto">Monto ($):</label>
                    <input type="number" class="form-control" id="monto_doc" name="monto_doc" min="1" onkeyup="calculo()"  required>
              
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="anticipo">Anticipo (%):</label>
                    <input type="number" class="form-control" id="ant_doc" name="ant_doc" min="1" max="100" onkeyup="calculo()" required>   
                  </div>
                  <div class="col-6">
                    <label for="financiado">Financiado ($):</label>
                    <input type="number" class="form-control" id="finan_doc" name="finan_doc" readonly>    
                  </div>
              </div>
              </div>
              <div class="form-group">
              <div class="row">
                  <div class="col-6">
                    <label for="dia">Dia +/-:</label>
                    <input type="number" class="form-control" id="dia_cli" name="dia_cli" readonly>    
                  </div>
                  <div class="col-6">
                    <label for="plazo">Plazo:</label>
                    <input type="text" class="form-control" id="plazo_doc" name="plazo_doc" required>    
                  </div>
              </div>
              </div>
          
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Ingresar Documento">
          

                

          </form>
  </div>
  </div>



</div>

</body>
</html>