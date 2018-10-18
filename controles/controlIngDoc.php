 <?php
  session_start();
 
  	if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0)and isset($_POST['cli']) ){
  		//Si la sesión esta seteada no hace nada
  		$id = $_SESSION['id_fac'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}      

 	require_once '../clases/ClaseDocumento.php';
 	require_once '../clases/ClaseCliente.php';
 	require_once '../clases/ClaseUsuario.php';
 
 	try{
 		$id_cli = $_POST['cli'];

 		$rut_deu = $_POST['rut_deu'];
 		$nom_deu = $_POST['nom_deu'];
 		$num_doc = $_POST['num_doc'];
 		$monto = $_POST['monto_doc'];
 		$ant = $_POST['ant_doc'];
 		$fec_ope = $_POST['fec_ope_doc'];
 		$fec_ven = $_POST['fec_ven_doc'];
 		$plazo = $_POST['plazo_doc'];
 		$fec_reg = date("Y-m-d h:m:s", time());
		$tipo_doc = $_POST['tip_doc'];
 		$est = 1;
 		
 			$cli = new ClienteDAO($id_cli);

 			$usu = new UsuarioDAO($id);

 			$dao = new DocumentoDAO('',$rut_deu, $nom_deu, $num_doc, $monto, $ant, $fec_ope, $fec_ven, $plazo, $fec_reg, $tipo_doc, $est);
 		
			$ing_doc = $dao->ing_doc($usu->getUsu(),$cli->getCli());
			
			if (count($ing_doc)>0){
			
			echo "2";    
			} else {
				//$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
			
			echo"Documento Nro. ".$num_doc." ingresado correctamente";  
				
					}
		
	
	salir:
 	} catch (Exception $e) {
		
		echo"2"; 
  	}
 ?>