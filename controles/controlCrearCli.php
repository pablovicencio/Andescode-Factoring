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
        $apertura = date("Y-m-d h:m:s", time());
        $fecha =  date("Y-m-d h:m:s", time());
        $dia = 1;
        $usu_creador = $_SESSION['id_fac'];
		$vig = 1;
        $otros = 0;
		
		
		$fun = new Funciones(); 

		if ($mail != '')
		{
			$val = $fun->validar_rut($rut,1); //1-usuario sistema/0-cliente sistema
			if ($val <> ""){
			echo"<script type=\"text/javascript\">alert('El RUT ya se encuentra en el sistema, puede encontrarse sin vigencia'); window.location='../paginas_fa/crear_usu.php';</script>";  
			
			
			}else{
			$contraseña = $fun->generaPass();

			$dao = new ClienteDAO('',$rut,$nom, $tasa, $com_cob, $com_cur,$apertura,$dia, $fecha, $usu_creador,$vig, md5($contraseña), $mail, $otros,$gg,$gf);
		
			$crear_cli = $dao->crear_cliente();
			
				if (count($crear_cli)>0){
				echo"<script type=\"text/javascript\">alert('Error de base de datos, comuniquese con el administrador'); window.location='../paginas_fa/crear_usu.php';</script>";    
				}else{
					//$enviar_pass = $fun->enviar_correo_pass($nom,$correo,$nueva_pass);
				echo"<script type=\"text/javascript\">alert('Cliente Creado!, Su Contraseña Temporal es: ".$contraseña.", favor verifique la contraseña para ingresar en su correo  (Buzon de entrada, correos no deseados o spam).'); window.location='../paginas_fa/crear_cli.php';</script>";  
				}
			}
		}else{
		echo "Error";
	}

	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_co/crear_co.php';</script>"; 



	}
?>