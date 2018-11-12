<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Modificar Usuario</title>
<?php
  include("../includes/recursosExternos.php");
?>

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






 
</head>

<body>

<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>


<div class="container" id="main">
  <div class="row">
  <div class="col-12 text-center">
    <h3>Modificar Usuario&nbsp;&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></h3>
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
          <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Ejecutivo&nbsp;&nbsp;</span>
                        <div class="input-group-text">
                        <input type="checkbox" aria-label="Checkbox for following text input" name="vig_usu" id="vig_usu">
                        </div>
                        <span class="input-group-text">Carlos Nelidow</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
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