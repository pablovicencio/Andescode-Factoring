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
	require_once '../clases/ClaseUsuario.php';

	try{
		$nom1 = $_POST['nom1_usu'];
		$nom2 = $_POST['nom2_usu'];
		$apepat = $_POST['apepat_usu'];
		$apemat = $_POST['apemat_usu'];
		$rut = $_POST['rut_usu'];
		$mail = $_POST['mail_usu'];
		$perfil = $_POST['perfil'];
		$fec_cre = date("Y-m-d h:m:s", time());
		$cargo = $_POST['cargo'];
		$vig = 1;
		$nick = $_POST['nick_usu'];
		
		
		$fun = new Funciones(); 

		if ($mail != ''){
		$val = $fun->validar_rut($rut,1); //1-usuario sistema/0-cliente sistema
		if ($val <> ""){
			echo"<script type=\"text/javascript\">alert('El RUT ya se encuentra en el sistema, puede encontrarse sin vigencia'); window.location='../paginas_fa/crear_usu.php';</script>";  
			
			
		}else{
			$contraseña = $fun->generaPass();

			$dao = new UsuarioDAO('',$nom1,$nom2, $apepat, $apemat, $rut,$mail,$perfil, $fec_cre, $cargo, md5($contraseña), $vig, $nick);
		
			$crear_usu = $dao->crear_usuario();
			
			if (count($crear_usu)>0){
			echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_fa/crear_usu.php';</script>";    
			} else {
				//$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
			echo"<script type=\"text/javascript\">alert('Usuario ".$nick." Creado ".$contraseña.", favor verifique en su correo (Buzon de entrada, correos no deseados o spam) la contraseña para ingresar.'); window.location='../paginas_fa/crear_usu.php';</script>";  
					}
		}}else{
		echo"Error";
	}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/crear_co.php';</script>"; 



	}
?>