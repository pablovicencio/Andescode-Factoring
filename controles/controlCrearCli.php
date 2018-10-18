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
	//require_once '../clases/ClaseGastosOpe.php';

	try{

		$nom = $_POST['nom_cli'];
        $gg = $_POST['gg_cli'];
        $gf = $_POST['gf_cli'];
        $rut = $_POST['rut_cli'];
        $mail = $_POST['mail_cli'];
		$tasa_ini = $_POST['tasa_cli_ini'];
		$com_cob_ini = $_POST['comc_cli_ini'];
		$com_cur_ini = $_POST['comcu_cli_ini'];
        $apertura_ini = $_POST['aper_cli_ini'];
        $fecha =  date("Y-m-d h:m:s", time());
		$num_cta_cli = $_POST['num_cta_cli'];
        $usu_creador = $_SESSION['id_fac'];
		$vig = 1;
		$lin_cre_cli = $_POST['lin_cre_cli'];
		$bco_cli = $_POST['bco_cli'];
		$fec_ven = $_POST['fec_ven'];

		//
		/*
		$dia = $_POST['dias_cli'];
        $otros = $_POST['otros_desc_cli'];
		$not_deu = $_POST['not_deu'];
        $envio_correo = $_POST['envio_correo'];
        $proc_gas = $_POST['proc_gas'];
        $copia_fac = $_POST['copia_fac'];
        $sii_cert = $_POST['sii_cert'];
		*/

		$fun = new Funciones(); 

		if ($mail != '')
		{
			$val = $fun->validar_rut($rut,0); //1-usuario sistema/0-cliente sistema
			if ($val <> ""){
			echo"1";  
			
			
			}else{
			$contraseña = $fun->generaPass();

			$dao = new ClienteDAO('',$rut,$nom, $tasa_ini, $com_cob_ini, $com_cur_ini,$apertura_ini, $fecha,$num_cta_cli,$lin_cre_cli, $usu_creador,$vig, md5($contraseña), $mail,$gg,$gf);
		
			$crear_cli = $dao->crear_cliente();

			$id_cli = $fun->cargar_id_cli($rut);
			$cli =  new ClienteDAO($id_cli[0]['id_cli']);

			//$dao = new GastosOpeDAO ('',$not_deu, $envio_correo, $proc_gas, $copia_fac, $sii_cert, $vig);

			//$crear_gastos_ope = $dao->crear_GastosOpe($cli->getCli());

			
				if (count($crear_cli)>0){// and (count($crear_gastos_ope)>0))
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