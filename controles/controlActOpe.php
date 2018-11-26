<?php
session_start();

 if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) and isset($_POST['numope']) ){
  		//Si la sesión esta seteada no hace nada
  		$id = $_SESSION['id_fac'];
  		$cargo = $_SESSION['cargo_fac'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}         
	     
	require_once '../clases/Funciones.php';
 	require_once '../clases/ClaseOperacion.php';

	try{

		$id_usu = $id;
		$id_ope = $_POST['numope'];

		if (isset($_POST['contratocesion'])) {
			$contratocesion = 1;
		}else {
			$contratocesion = 0;
		}

		if (isset($_POST['dicomdeudorescli'])) {
			$dicomdeudorescli = 2;
		}else {
			$dicomdeudorescli = 0;
		}

		if (isset($_POST['informeconfir'])) {
			$informeconfir = 3;
		}else {
			$informeconfir = 0;
		}

		if (isset($_POST['ivaform'])) {
			$ivaform = 4;
		}else {
			$ivaform = 0;
		}

		if (isset($_POST['cobrogastos'])) {
			$cobrogastos = 5;
		}else {
			$cobrogastos = 0;
		}

		if (isset($_POST['garantia'])) {
			$garantia = 6;
		}else {
			$garantia = 0;
		}




		if (isset($_POST['obs_2'])) {
			$obs = $_POST['obs_2'];
		}else if (isset($_POST['obs_3'])) {
			$obs = $_POST['obs_3'];
		}

		
		$forma_giro = $_POST['forma_giro'];
		$bco_giro = $_POST['bco_giro'];
		$bco_dep = $_POST['bco_dep'];
		$ctacte = $_POST['ctacte'];

		if ($cargo == 2) {
			$est_ope = 3;
		}elseif ($cargo == 3) {
			$est_ope = 4;
		}

		$est_act_ope = $_POST['estope'];;
		


		$fec_reg =  date("Y-m-d h:m:s", time());
		

			$dao = new OperacionDAO($id_ope, '',$id_usu, '',$obs,'','','','','','',$ctacte,'','',$bco_giro,$bco_dep, $fec_reg, $est_act_ope,'','',$forma_giro);
			$act_ope = $dao->act_ope( $contratocesion, $dicomdeudorescli, $informeconfir, $ivaform , $cobrogastos , $garantia, $cargo,$est_ope);
			if (count($act_ope)>0){
				echo "1";    
			} else {
			
			echo "Operación Actualizada Correctamente.";  
				
					}
	salir:
	
	} catch (Exception $e) {
		echo"1"; 
	}
?>