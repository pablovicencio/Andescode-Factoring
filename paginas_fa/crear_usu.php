<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Crear Usuario</title>
<?php
  include("../includes/recursosExternos.php");
?>

<script type="text/javascript">

$(document).ajaxStart(function() {
  $("#formCrearUsu").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#formCrearUsu").show();
  });  


$(document).ready(function() {
  $("#formCrearUsu").submit(function() {    
    $.ajax({
      type: "POST",
      url: '../controles/controlCrearUsu.php',
      data:$("#formCrearUsu").serialize(),
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '1':
                    swal("Rut Duplicado", "El RUT ya se encuentra en el sistema, puede encontrarse sin vigencia", "warning");
                    break;
                case '2':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                case '3':
                    swal("Error Mail", "Favor ingrese un correo electronico para enviar las credenciales", "warning");
                    break;
                default:
                    swal("Usuario Creado", msg, "success");
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



  </style>

 
</head>

<body>


<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>


<div class="container" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Nuevo Usuario&nbsp;&nbsp;<i class="fa fa-plus-square" aria-hidden="true"></i></h3>
    <hr>
  </div>
  </div>

  <div id="loading" style="display: none;">
    <center><img src="../recursos/img/load.gif"></center>
  </div>


  <form id="formCrearUsu" onsubmit="return false;"  >

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
             <input type="text"  class="form-control" id="rut_usu" name="rut_usu" maxlength="10" placeholder="xxxxxxxx-x" pattern="\d{3,8}-[\d|kK]{1}"  required>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="text" class="form-control" id="mail_usu" name="mail_usu" maxlength="50"  required>
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
                                               <option value="<?php echo $row['id_perfil'] ?>"><?php echo $row['perfil'] ?></option>
                                                  
                                              <?php
                                            }    
                                        ?>       
                        </select>
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
                                          ?>       
                          </select>
            </div>
            <div class="form-group">
             <label for="mail">Nickname:</label>
             <input type="text" class="form-control" id="nick_usu" name="nick_usu" maxlength="20"  required>
          </div>
          <input type="submit" class="btn btn-info" id="btnAc" name="btnAc" value="Crear Usuario" >
          </form>
  </div>
  </div>



</div>
</body>
</html>