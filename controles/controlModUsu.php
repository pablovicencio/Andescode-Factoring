<?php
session_start();

 if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) and isset($_POST['usu']) ){
  		//Si la sesión esta seteada no hace nada
  		$id = $_SESSION['id_fac'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}         
	     
	require_once '../clases/Funciones.php';
 	require_once '../clases/ClaseUsuario.php';

	try{
		$usu = $_POST['usu'];
		$nom1 = $_POST['nom1_usu'];
 		$nom2 = $_POST['nom2_usu'];
 		$apepat = $_POST['apepat_usu'];
 		$apemat = $_POST['apemat_usu'];
 		$mail = $_POST['mail_usu'];
 		$perfil = $_POST['perfil'];
 		$cargo = $_POST['cargo'];
 		$nick = $_POST['nick_usu'];



		if (isset($_POST['vig_usu'])) {
			$vig = 1;
		}else{
			$vig = 0;
		}
			
		$dao = new UsuarioDAO($usu,$nom1,$nom2, $apepat, $apemat, ' ',$mail,$perfil, ' ', $cargo, ' ', $vig, ' ');
 		
			$mod_usu = $dao->modificar_usuario();
			if (count($mod_usu)>0){
			
			echo "1";    
			} else {
			
			echo"Usuario ".$nick." Modificado, para aplicar los cambios el usuario debe re ingresar al sistema.";  
				
					}
	salir:
	} catch (Exception $e) {
		echo"1"; 
	}
?>