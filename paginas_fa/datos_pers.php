<?php 
  include("../includes/validaSesion.php")
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Viracocha - Datos Personales</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
    #main{
      /*background: url('../recursos/img/logo/bg.jpg'); 
      
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center; 
      border-radius: 25px;
      padding-top: 5px;*/
      padding: 1em;
      margin-top: 2em;
      border-radius:0.5em;
    }
    body{
      background-color:#ddd;
      }/*
    @media (max-width: 1000px) {
    
        body{font-size: 3.7vw;}
        */
    </style>



 

 
</head>

<body>



<?php
  include("../includes/infoLog.php");
  include("../includes/menuUsuario.php");
?>


<div class="container bg-light" id="main">
  <div class="row">
  <div class="col-12">
    <h3>Mis Datos&nbsp&nbsp<i class="fa fa-address-card" aria-hidden="true"></i></h3>

    <hr>
  </div>
  </div>
                  <?php
                  $re = $fun->cargar_datos_usu($id,1);   
                  foreach($re as $row)      
                      {
                         
                      }    
                  ?>  
  <div class="row" >
  <div class="col-6">

          <div class="form-group">
            <label for="nom">Nombres:</label>
            <input type="text" class="form-control" id="nom_usu" name="nom_usu"  value="<?php echo $row['nom'] ?>" readonly>
          </div>
          <div class="form-group">
              <label for="ape">Apellidos:</label>
              <input type="text" class="form-control" name="ape_usu" id="ape_usu" value="<?php echo $row['ape'] ?>" readonly>
            </div>
          <div class="form-group">
             <label for="rut">Rut:</label>
             <input type="text"  class="form-control" id="rut_usu" name="rut_usu" value="<?php echo $row['rut'] ?>"  readonly>
          </div>
          <div class="form-group">
             <label for="mail">Mail:</label>
             <input type="text" class="form-control" id="mail_usu" name="mail_usu" value="<?php echo $row['mail'] ?>"  readonly>
          </div>
           <div class="form-group">
             <label for="perfil">Perfil de Sistema:</label>
             <input type="text" class="form-control" id="perfil_usu" name="perfil_usu" value="<?php echo $row['perfil'] ?>"  readonly>
          </div>
  </div>
  <div class="col-6">
        <div class="form-group">
            <label for="fec">Fecha de Creación:</label>
            <input type="text" class="form-control" id="fec_usu" name="fec_usu"  value="<?php echo date('d-m-Y', strtotime($row['fec'])) ?>" readonly>
          </div>
          <div class="form-group">
              <label for="cargo">Cargo:</label>
              <input type="text" class="form-control" name="cargo_usu" id="cargo_usu" value="<?php echo $row['cargo'] ?>" readonly>
            </div>
          <div class="form-group">
             <label for="vig">Vigencia:</label>
             <input type="text"  class="form-control" id="vig_usu" name="vig_usu" value="<?php echo $row['vig'] ?>"  readonly>
          </div>
          <div class="form-group">
             <label for="nick">Nickname:</label>
             <input type="text" class="form-control" id="nick_usu" name="nick_usu" value="<?php echo $row['nick'] ?>"  readonly>
          </div>
  </div>
  </div>



</div>
</body>
</html>