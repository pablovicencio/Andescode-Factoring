<?php
 session_start();

 if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) ){
    //Si la sesión esta seteada no hace nada
    $id = $_SESSION['id_fac'];
  }
  else{
    //Si no lo redirige a la pagina index para que inicie la sesion 
    header("location: ../index.html");
  }  

	require_once '../clases/Funciones.php';

	try{

		$rut = stripcslashes ($_POST['rut']);

		 $fun = new Funciones();
		 $re = $fun->validar_rut_deudor($rut);


		 if ($re == 0 ) {
		 	echo ('0');
		 }else{
		 	echo ($re[0]['nom_deu_doc']);
		 }
		
		
	
	} catch (Exception $e) {
		//echo($e);
		echo"'Error, verifique los datos'",  $e->getMessage(); 

	}
?>