<?php
	require_once '../clases/ClasePersona.php';
	try{
		if (!empty($_POST['rut']) and !empty($_POST['pwd'])){ 
		$rut = $_POST['rut'];
		$pwd = md5($_POST['pwd']);
		
		$dao = PersonaDAO::login($rut,$pwd);
			
		}else{
		echo"<script type=\"text/javascript\">alert('Error, favor verifique sus datos e intente nuevamente.');       window.location='../index.html';</script>"
		;
		}
	} catch (Exception $e) {
		echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../index.html';</script>"; 
	}
?>