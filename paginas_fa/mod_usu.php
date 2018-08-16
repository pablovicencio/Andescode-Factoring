<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Modificar Usuario</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

function mod(usu) {
    
     $.ajax({
      url: '../controles/controlCargarDatosUsu.php',
      type: 'POST',
      data: {"usu":usu},
      dataType:'json',
      success:function(result){
        console.log(result);
        $('#nom1_usu').val(result[0].nom1_usu);
        $('#nom2_usu').val(result[0].nom2_usu);
        $('#apepat_usu').val(result[0].apepat_usu);
        $('#apemat_usu').val(result[0].apemat_usu);
        $('#rut_usu').val(result[0].rut_usu);
        $('#mail_usu').val(result[0].mail_usu);
        $('#fec_cre_usu').val(result[0].fec_cre_usu);
        $('#nick_usu').val(result[0].nick_usu);
        $("#perfil").val(result[0].id_perfil);
        $("#cargo").val(result[0].cargo_usu);

        if ((result[0].vig_usu)==1) {  
          $('#vig_usu').prop('checked', true);
              }else  {
                $('#vig_usu').prop('checked', false);
              }

  }
  })
    

}


$(document).ajaxStart(function() {
  $("#formCrearUsu").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formCrearUsu").show();
  });  


$(document).ready(function() {
  $("#formModUsu").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlModUsu.php',
      data:$("#formModUsu").serialize(),
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
                    swal("Usuario Modificado", msg, "success");
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




  <style type="text/css">
    #main{
      background: url('../recursos/img/logo/bg.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center; 
      border-radius: 25px;
      padding-top: 5px;
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
    <h3>Modificar Usuario</h3>
    <hr>
  </div>
  </div>

  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>
    <form id="formModUsu" onsubmit="return false;"  >
    <div class="col-12">
      <select class="form-control" id="usu" name="usu" style="width: 500px" onchange="mod(this.value)">
          <option value="" selected disabled>Seleccione Usuario</option>
                     <?php 
                      $re = $fun->cargar_usuarios(0);   
                      foreach($re as $row)      
                          {
                            ?>
                            
                             <option value="<?php echo $row['id_usu'] ?>"><?php echo $row['usuario'] ?></option>
                                
                            <?php
                          }    
                      ?>  
      </select><hr>
    </div>



  <div class="row" >
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombres:</label>
              <div class="row">
                <div class="col-6">
                  <input type="text" class="form-control" id="nom1_usu" name="nom1_usu"  maxlength="25" placeholder="Primer Nombre" required>
                </div>
                 <div class="col-6">
                   <input type="text" class="form-control" id="nom2_usu" name="nom2_usu"  maxlength="25" placeholder="Segundo Nombre" required>
                </div>
             </div>
          </div>
          <div class="form-group">
              <label for="ape">Apellidos:</label>
              <div class="row">
                <div class="col-6">
                  <input type="text" class="form-control" id="apepat_usu" name="apepat_usu"  maxlength="25" placeholder="Apellido Paterno" required>
                </div>
                <div class="col-6">
                  <input type="text" class="form-control" id="apemat_usu" name="apemat_usu"  maxlength="25" placeholder="Apellido Materno" required>
                </div>
             </div>
          </div>
          <div class="form-group">
             <label for="rut">Rut:</label>
             <input type="text"  class="form-control" id="rut_usu" name="rut_usu" maxlength="10" placeholder="xxxxxxxx-x"  readonly>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="text" class="form-control" id="mail_usu" name="mail_usu" maxlength="50"  required>
          </div>
          <div class="form-group">
            <label for="fec">Fecha de Creación:</label>
            <input type="text" class="form-control" id="fec_cre_usu" name="fec_cre_usu" readonly>
          </div>
           
  </div>
  <div class="col-6">
        <div class="form-group">
          <label for="ape">Perfil de Sistema:</label>
             <select class="form-control" name="perfil" id="perfil" required>
                          <option value="" selected disabled>Seleccione el perfil</option>
                                       <?php 
                                        $re = $fun->cargar_perfiles(1);   
                                        foreach($re as $row)      
                                            {
                                              ?>
                                               <option value="<?php echo $row['id_perfil']; ?>"><?php echo $row['perfil']; ?></option>
                                              <?php
                                            }
                                        ?></select>
          </div>
          <div class="form-group">
            <label for="ape">Cargo:</label>
               <select class="form-control" name="cargo" id="cargo" required>
                            <option value="" selected disabled>Seleccione el cargo</option>
                                         <?php 
                                          $re = $fun->cargar_cargos(1);   
                                          foreach($re as $row)      
                                              {
                                                ?>
                                                 <option value="<?php echo $row['id_cargo'] ?>"><?php echo $row['cargo'] ?></option>
                                                    <?php
                                              }
                                          ?></select>
            </div>
            <div class="form-group">
             <label for="mail">Nickname:</label>
             <input type="text" class="form-control" id="nick_usu" name="nick_usu" maxlength="20"  readonly>
          </div>

          <div class="form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="vig_usu" id="vig_usu"> Vigencia</label>
          </div>
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Modificar Usuario" >
          </form>
  </div>
  </div>



</div>
</body>
</html>