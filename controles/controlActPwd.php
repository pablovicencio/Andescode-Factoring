<?php
 session_start();

 	if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0)and isset($_POST['actpwd']) ){
 		//Si la sesión esta seteada no hace nada
 		$id = $_SESSION['id_fac'];
 	}
 	else{
		echo("0");
 		goto salir;
	}      
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClaseCliente.php';
	require_once '../clases/ClaseGastosOpe.php';

	try{

		$pwd = $_POST['actpwd'];
        $newpwd1 = $_POST['newpwd1'];
        $newpwd2 = $_POST['newpwd2'];
        
        $usu = $_SESSION['id_fac'];
		

		
		
		$fun = new Funciones(); 

		
			$val = $fun->validar_pwd($usu,1); //1-usuario sistema/0-cliente sistema
			if ($val <> ""){
			echo"1";  
			
			
			}else{
			$contraseña = $fun->generaPass();

			$dao = new ClienteDAO('',$rut,$nom, $tasa, $com_cob, $com_cur,$apertura,$dia, $fecha, $usu_creador,$vig, md5($contraseña), $mail, $otros,$gg,$gf);
		
			$crear_cli = $dao->crear_cliente();

			$id_cli = $fun->cargar_id_cli($rut);
			$cli =  new ClienteDAO($id_cli[0]['id_cli']);

			$dao = new GastosOpeDAO ('',$not_deu, $envio_correo, $proc_gas, $copia_fac, $sii_cert, $vig);

			$crear_gastos_ope = $dao->crear_GastosOpe($cli->getCli());

			
				if ((count($crear_cli)>0) and (count($crear_gastos_ope)>0)){
				echo"2";    
				}else{
					//$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
				echo"Cliente ".$nom." Creado!, Su Contraseña Temporal es: ".$contraseña.", favor verifique la contraseña para ingresar en su correo  (Buzon de entrada, correos no deseados o spam) ";  
				}
			}
		
	salir:
	} catch (Exception $e) {
		echo"2"; 

	}
?>