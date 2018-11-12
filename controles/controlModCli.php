<?php
session_start();

 if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) and isset($_POST['cli']) ){
  		//Si la sesión esta seteada no hace nada
  		$id = $_SESSION['id_fac'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}         
	     
	require_once '../clases/Funciones.php';
 	require_once '../clases/ClaseCliente.php';

	try{
		$cliente = $_POST['cli'];
		$nom_cli = $_POST['nom_cli'];
		$tasa_inicial = $_POST['tasa_cli'];
 		$com_cob_inicial = $_POST['com_cob_cli'];
 		$com_cur_inicial = $_POST['com_cur_cli'];
 		$apertura_inicial = $_POST['apertura_cli'];
 		$nro_cta_cli = $_POST['num_cta_cli'];
 		$linea_cred_cli = $_POST['lin_cre_cli'];
 		$mail = $_POST['mail_cli'];
        $gg_cli = $_POST['gg_cli'];
		$gf_cli = $_POST['gf_cli'];
		$bco_cli = $_POST['bco_cli'];
		$fec_ven = $_POST['fec_ven'];


		if (isset($_POST['vig_cli'])) {
			$vig = 1;
		}else{
			$vig = 0;
		}
			$dao = new ClienteDAO($cliente,'',$nom_cli, $tasa_inicial, $com_cob_inicial,  $com_cur_inicial,$apertura_inicial, $nro_cta_cli,$linea_cred_cli,'','','','',$mail,$gg_cli,$gf_cli,$bco_cli,$fec_ven); 		
			$mod_cli = $dao->modificar_cliente();
			if (count($mod_cli)>0){
				echo "1";    
			} else {
			
			echo "Cliente Actualizado Correctamente.";  
				
					}
	salir:
	
	} catch (Exception $e) {
		echo"1"; 
	}
?>