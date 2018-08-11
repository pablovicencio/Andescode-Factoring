<?php
 session_start();

 	if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0)and isset($_POST['rut_cli']) ){
 		//Si la sesión esta seteada no hace nada
 		$id = $_SESSION['id_fac'];
 	}
 	else{
		echo("0");
 		goto salir;
	}      
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClaseCliente.php';

	try{

		$nom = $_POST['nom_cli'];
        $gg = $_POST['gg_cli'];
        $gf = $_POST['gf_cli'];
        $rut = $_POST['rut_cli'];
        $mail = $_POST['mail_cli'];
		$tasa = $_POST['tasa_cli'];
		$com_cob = $_POST['comc_cli'];
		$com_cur = $_POST['comcu_cli'];
        $apertura = 2000;
        $fecha =  date("Y-m-d h:m:s", time());
        $dia = 1;
        $usu_creador = $_SESSION['id_fac'];
		$vig = 1;
        $otros = 0;
		
		
		$fun = new Funciones(); 

		if ($mail != '')
		{
			$val = $fun->validar_rut($rut,0); //1-usuario sistema/0-cliente sistema
			if ($val <> ""){
			echo"1";  
			
			
			}else{
			$contraseña = $fun->generaPass();

			$dao = new ClienteDAO('',$rut,$nom, $tasa, $com_cob, $com_cur,$apertura,$dia, $fecha, $usu_creador,$vig, md5($contraseña), $mail, $otros,$gg,$gf);
		
			$crear_cli = $dao->crear_cliente();
			
				if (count($crear_cli)>0){
				echo"2";    
				}else{
					//$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
				echo"Cliente ".$nom." Creado!, Su Contraseña Temporal es: ".$contraseña.", favor verifique la contraseña para ingresar en su correo  (Buzon de entrada, correos no deseados o spam) ";  
				}
			}
		}else{
		echo "3";
	}
	salir:
	} catch (Exception $e) {
		echo"2"; 

	}
?>