<?php
 
 	  
	     
	require_once '../clases/Funciones.php';
	require_once '../clases/ClasePersona.php';
	

	try{

		if(isset($_POST['rut']) && isset($_POST['mail'])){
 		$rut = $_POST['rut'];
        $mail = $_POST['mail'];	
		
		
		$fun = new Funciones(); 

		
			$id = $fun->validar_usu($rut,$mail,1); //1-usuario sistema/0-cliente sistema

			if ($id === false ){
				//var_dump($id);
			echo"1";  
			}else{

							$contraseña = $fun->generaPass();
				
							$upd_pass = PersonaDAO::actualizar_contraseña($id,md5($contraseña),1);
							//var_dump($id);
							//$enviar_pass = $fun->correo_upd_pass($mail,$newpwd1);
							echo"Su Contraseña fue actualizada correctamente y enviada a su correo. Ingrese nuevamente con las credenciales nuevas"; 
							
			
		}
		 	}else{
				echo("0");
		 		goto salir;
			}    


		
	salir:
	} catch (Exception $e) {
		echo"3"; 

	}
?>